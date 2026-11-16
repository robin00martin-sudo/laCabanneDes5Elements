<?php
/*
  RENDEZ-VOUS côté base de données (DAO = couche qui parle à la base).
  - create()      : enregistre un rendez-vous, en vérifiant ATOMIQUEMENT que le créneau est libre
  - findAll()     : tous les rendez-vous (futur tableau d'administration)
  - findDuJour()  : rendez-vous non annulés d'un jour (pour griser les créneaux pris)
*/
require_once __DIR__ . '/../metier/RendezVous.php';
require_once __DIR__ . '/../metier/Horaires.php';
require_once __DIR__ . '/../metier/CreneauIndisponibleException.php';
require_once __DIR__ . '/../../config/Database.php';

class RendezVousDAO
{
    /**
     * Enregistre le rendez-vous. Le contrôle « créneau libre » et l'insertion sont faits
     * sous un verrou : deux visiteurs ne peuvent pas réserver le même créneau en même temps.
     *
     * @throws CreneauIndisponibleException si le créneau chevauche un rendez-vous existant
     */
    public function create(RendezVous $rdv): void
    {
        $pdo = Database::getConnexion();

        $idService = $rdv->getService()->getIdService();
        if ($idService === null) {
            throw new LogicException("Impossible d'insérer le rendez-vous : service non persisté");
        }

        $debut = $rdv->getHeureRdv();
        $fin   = Horaires::heureFin($debut, $rdv->getService()->getDuree());

        $verrou = (int) $pdo->query("SELECT GET_LOCK('cabane_rdv', 10)")->fetchColumn();
        if ($verrou !== 1) {
            throw new RuntimeException("Impossible d'obtenir le verrou de réservation.");
        }

        try {
            $pdo->beginTransaction();

            if (Horaires::chevauche($debut, $fin, $this->findDuJour($rdv->getDateRdv()))) {
                $pdo->rollBack();
                throw new CreneauIndisponibleException("Créneau déjà réservé.");
            }

            $stmt = $pdo->prepare(
                "INSERT INTO rendezvous
                    (date_rdv, heure_rdv, heure_fin, statut, nom_client, email_client, telephone, message, idService)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $rdv->getDateRdv(), $debut, $fin, $rdv->getStatut(),
                $rdv->getNomClient(), $rdv->getEmailClient(), $rdv->getTelephone() ?: null,
                $rdv->getMessage(), $idService,
            ]);
            $rdv->setIdRdv((int) $pdo->lastInsertId());

            $pdo->commit();
        } catch (Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            throw $e;
        } finally {
            $pdo->query("SELECT RELEASE_LOCK('cabane_rdv')")->fetchColumn();
        }
    }

    public function findAll(): array
    {
        return Database::getConnexion()->query("SELECT * FROM rendezvous ORDER BY date_rdv, heure_rdv")->fetchAll();
    }

    /**
     * Rendez-vous non annulés d'une date : lignes ['heure_rdv' => 'HH:MM:SS', 'heure_fin' => 'HH:MM:SS'].
     */
    public function findDuJour(string $date): array
    {
        $stmt = Database::getConnexion()->prepare(
            "SELECT heure_rdv, heure_fin FROM rendezvous WHERE date_rdv = ? AND statut <> ?");
        $stmt->execute([$date, RendezVous::STATUT_ANNULE]);
        return $stmt->fetchAll();
    }
}
