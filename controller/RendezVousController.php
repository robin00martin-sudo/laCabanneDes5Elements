<?php
/*
  Ce fichier gère TOUT ce qui concerne les rendez-vous.

  Il a deux rôles principaux :
  1) Afficher le formulaire de prise de rendez-vous
  2) Enregistrer un rendez-vous lorsque le formulaire est envoyé

  Ce fichier ne s’occupe PAS de l’affichage visuel (HTML),
  ni de la base de données directement.
*/


/*
  On charge les fichiers qui permettent de communiquer avec la base de données.

  - RendezVousDAO.php :
    s’occupe de lire et enregistrer les rendez-vous

  - ServiceDAO.php :
    s’occupe de lire les prestations proposées (shiatsu, réflexologie, etc.)
*/
require_once __DIR__ . "\..\model\dao\RendezVousDAO.php";
require_once __DIR__ . "\..\model\dao\ServiceDAO.php";


/*
  Contrôleur des rendez-vous
*/
class RendezVousController
{
    /*
      ============================
      AFFICHAGE DU FORMULAIRE RDV
      ============================

      Cette fonction est appelée quand l’utilisateur
      veut PRENDRE un rendez-vous.
    */
    public function afficherFormulaireRdv(): void {

        /*
          On crée les objets qui permettent d’accéder aux données
        */
        $serviceDAO = new ServiceDAO();
        $rdvDAO     = new RendezVousDAO();

        /*
          Récupération de TOUS les services disponibles
          (pour les afficher dans une liste déroulante)
        */
        $services = $serviceDAO->findAll();

        /*
          On regarde si un service a déjà été sélectionné dans l’URL.

          Exemple :
          index.php?action=RDV&service=2

          Si aucun service n’est choisi, la valeur reste à null.
        */
        $idService = isset($_GET['service']) && $_GET['service'] !== '' 
                     ? (int)$_GET['service'] 
                     : null;

        /*
          Récupération de la date choisie dans l’URL.

          - Si une date est fournie → on l’utilise
          - Sinon → on prend la date du jour
        */
        $date = $_GET['date'] ?? date('Y-m-d');

        /*
          On récupère les heures déjà réservées pour cette date.

          - Si un service est choisi → on filtre par service
          - Sinon → aucune heure n’est bloquée
        */
        $heuresPrises = $idService 
            ? $rdvDAO->findHeuresPrises($date, $idService) 
            : [];

        /*
          Création de tous les créneaux horaires possibles.

          Ici :
          - de 09h00 à 18h00
          - toutes les 30 minutes
        */
        $horaires = [];
        $start = new DateTime("09:00");
        $end   = new DateTime("18:00");

        while ($start <= $end) {
            $horaires[] = $start->format("H:i");
            $start->modify("+30 minutes");
        }

        /*
          On affiche le formulaire HTML.

          Le fichier form.php va utiliser :
          - $services
          - $date
          - $horaires
          - $heuresPrises
        */
        require __DIR__ . '/../view/rdv/form.php';

        /*
          On stoppe l’exécution du script ici,
          pour éviter que du code s’exécute après l’affichage.
        */
        exit;
    }


    /*
      ============================
      ENREGISTREMENT DU RENDEZ-VOUS
      ============================

      Cette fonction est appelée quand l’utilisateur
      VALIDE le formulaire de rendez-vous.
    */
    public function enregistrer(): void
    {
        /*
          Accès aux rendez-vous dans la base de données
        */
        $rdvDAO = new RendezVousDAO();

        /*
          Récupération de l’identifiant du service choisi
          depuis le formulaire
        */
        $idService = $_POST['service'];

        /*
          Chargement du service correspondant
        */
        $serviceDAO = new ServiceDAO();
        $service = $serviceDAO->findById($idService);

        /*
          Sécurité :
          si le service n’existe pas, on arrête tout
        */
        if (!$service) {
            throw new Exception("Service introuvable");
        }

        /*
          Création de l’objet RendezVous.

          Contient :
          - la date
          - l’heure
          - le service choisi
          - le statut (ici : en attente)
        */
        $rdv = new RendezVous(
            0,                    // ID (créé automatiquement par la base)
            $_POST['date'],       // Date choisie
            $_POST['heure'],      // Heure choisie
            $service,             // Service sélectionné
            "en_attente"          // Statut du rendez-vous
            // message optionnel (commenté pour le moment)
        );

        /*
          Enregistrement du rendez-vous dans la base de données
        */
        $rdvDAO->create($rdv);

        /*
          Message simple de confirmation (temporaire)
          Peut être remplacé par une vraie page de confirmation
        */
        echo "le rdv a bien été enregistrer";

        /*
          Page de confirmation possible (désactivée pour le moment)
        */
        // require __DIR__ . '\..\view\rdv\confirmation.php';
    }
}
