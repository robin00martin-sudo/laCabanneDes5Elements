<?php
/*
  RENDEZ-VOUS : affichage du formulaire, enregistrement, page de confirmation.
  Toutes les règles (horaires, durée, créneau libre, champs obligatoires) sont
  vérifiées ICI, côté serveur : l'interface ne fait que les rendre visibles.
*/
require_once __DIR__ . '/../model/dao/RendezVousDAO.php';
require_once __DIR__ . '/../model/dao/ServiceDAO.php';
require_once __DIR__ . '/../config/Config.php';

class RendezVousController
{
    /* ===== Formulaire de prise de rendez-vous ===== */
    public function afficherFormulaireRdv(array $erreurs = [], array $saisie = []): void
    {
        $erreurBase = null;
        $services = [];
        $creneaux = [];
        $ferme = false;

        $idService = isset($_GET['service']) && $_GET['service'] !== '' ? (int) $_GET['service'] : null;
        $date = $_GET['date'] ?? date('Y-m-d');
        if (!Horaires::dateValide($date) || $date < date('Y-m-d')) {
            $date = date('Y-m-d');
        }

        try {
            $services = (new ServiceDAO())->findAll();
            if ($idService) {
                $service = (new ServiceDAO())->findById($idService);
                if ($service) {
                    $creneaux = $this->creneauxAvecDisponibilite($date, $service->getDuree());
                    $ferme = empty(Horaires::plagesDuJour($date));
                } else {
                    $idService = null;
                }
            }
        } catch (PDOException $e) {
            error_log('[Cabane] ' . $e->getMessage());
            $erreurBase = "Le service de rendez-vous est momentanément indisponible. Merci de réessayer plus tard.";
        }

        require __DIR__ . '/../view/rdv/form.php';
        exit;
    }

    /**
     * Créneaux possibles du jour, chacun marqué disponible ou non
     * (passé, ou chevauchant un rendez-vous existant).
     */
    private function creneauxAvecDisponibilite(string $date, int $duree): array
    {
        $existants = (new RendezVousDAO())->findDuJour($date);
        $maintenant = new DateTime('now');
        $resultat = [];
        foreach (Horaires::creneauxPossibles($date, $duree) as $heure) {
            $passe = new DateTime("$date $heure") <= $maintenant;
            $pris  = Horaires::chevauche($heure, Horaires::heureFin($heure, $duree), $existants);
            $resultat[] = ['heure' => $heure, 'dispo' => !$passe && !$pris];
        }
        return $resultat;
    }

    /* ===== Enregistrement ===== */
    public function enregistrer(): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            header('Location: index.php?action=RDV');
            exit;
        }

        $idService = (int) ($_POST['service'] ?? 0);
        $date      = trim($_POST['date'] ?? '');
        $heure     = trim($_POST['heure'] ?? '');
        $nom       = trim($_POST['nom'] ?? '');
        $email     = trim($_POST['email'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $message   = trim($_POST['message'] ?? '');
        $consent   = isset($_POST['consentement']);

        $saisie = compact('nom', 'email', 'telephone', 'message');
        $_GET['service'] = (string) $idService;   // le formulaire réaffiché garde le service…
        $_GET['date']    = $date;                 // …et la date choisis

        $erreurs = [];
        $service = null;

        try {
            $service = $idService ? (new ServiceDAO())->findById($idService) : null;
            if (!$service) {
                $erreurs[] = "Veuillez choisir une prestation.";
            }

            if (!Horaires::dateValide($date) || $date < date('Y-m-d')) {
                $erreurs[] = "La date choisie est invalide ou passée.";
            } elseif ($service) {
                if (!in_array($heure, Horaires::creneauxPossibles($date, $service->getDuree()), true)) {
                    $erreurs[] = "Ce créneau n'est pas proposé (jour de fermeture ou horaire hors ouverture).";
                } elseif (new DateTime("$date $heure") <= new DateTime('now')) {
                    $erreurs[] = "Ce créneau est déjà passé.";
                }
            }

            if ($nom === '' || strlen($nom) > 100)                  $erreurs[] = "Indiquez votre nom (100 caractères maximum).";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) $erreurs[] = "Indiquez une adresse e-mail valide.";
            if ($telephone !== '' && !preg_match('/^[0-9+().\s-]{6,20}$/', $telephone)) $erreurs[] = "Le numéro de téléphone n'est pas valide.";
            if (strlen($message) > 1000)                            $erreurs[] = "Le message est limité à 1000 caractères.";
            if (!$consent)                                          $erreurs[] = "Vous devez accepter l'utilisation de vos informations pour traiter votre demande.";

            if (empty($erreurs)) {
                $rdv = new RendezVous(0, $date, $heure, $service, RendezVous::STATUT_EN_ATTENTE, $message, $nom, $email, $telephone);
                try {
                    (new RendezVousDAO())->create($rdv);
                } catch (CreneauIndisponibleException $e) {
                    http_response_code(409);
                    $this->afficherFormulaireRdv(["Ce créneau vient d'être réservé par quelqu'un d'autre : choisissez-en un autre."], $saisie);
                }

                $this->notifier($rdv);
                $_SESSION['dernier_rdv'] = [
                    'service' => $service->getNomService(), 'date' => $date, 'heure' => $heure,
                    'nom' => $nom, 'email' => $email,
                ];
                header('Location: index.php?action=confirmation');
                exit;
            }
        } catch (PDOException $e) {
            error_log('[Cabane] ' . $e->getMessage());
            http_response_code(500);
            $erreurs[] = "Le rendez-vous n'a pas pu être enregistré : service momentanément indisponible.";
        }

        http_response_code(http_response_code() === 200 ? 422 : http_response_code());
        $this->afficherFormulaireRdv($erreurs, $saisie);
    }

    /* ===== Page de confirmation (lue en session : aucune donnée personnelle dans l'URL) ===== */
    public function afficherConfirmation(): void
    {
        $rdv = $_SESSION['dernier_rdv'] ?? null;
        if (!$rdv) {
            header('Location: index.php?action=RDV');
            exit;
        }
        unset($_SESSION['dernier_rdv']);
        require __DIR__ . '/../view/rdv/confirmation.php';
        exit;
    }

    /** Prévient la praticienne par e-mail (si « mail_to » est configuré). Un échec n'annule jamais la réservation. */
    private function notifier(RendezVous $rdv): void
    {
        $to = Config::get('mail_to');
        if ($to === '') {
            return;
        }
        $corps = "Nouvelle demande de rendez-vous (statut : en attente)\n\n"
               . "Prestation : " . $rdv->getService()->getNomService() . "\n"
               . "Date : " . $rdv->getDateRdv() . " à " . $rdv->getHeureRdv() . "\n"
               . "Nom : " . $rdv->getNomClient() . "\n"
               . "E-mail : " . $rdv->getEmailClient() . "\n"
               . "Téléphone : " . ($rdv->getTelephone() ?: '—') . "\n\n"
               . "Message :\n" . ($rdv->getMessage() ?: '—');
        $entetes = ["From: " . (Config::get('mail_from') ?: 'no-reply@localhost'),
                    "Reply-To: " . $rdv->getEmailClient(),
                    "Content-Type: text/plain; charset=UTF-8"];
        if (!@mail($to, 'Nouvelle demande de rendez-vous', $corps, implode("\r\n", $entetes))) {
            error_log('[Cabane] Notification de rendez-vous non envoyée.');
        }
    }
}
