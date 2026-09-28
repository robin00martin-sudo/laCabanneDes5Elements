<?php
/*
  Ce fichier gère les RENDEZ-VOUS côté base de données.

  Son rôle :
  - enregistrer un rendez-vous dans la base
  - récupérer des rendez-vous existants
  - empêcher qu’un même créneau soit réservé plusieurs fois

  Il ne s’occupe PAS de l’affichage,
  ni de la logique de navigation du site.
*/


/*
  On charge :
  - la classe RendezVous (représente un rendez-vous)
  - la configuration de la base de données
*/
require_once __DIR__ . '/../metier/RendezVous.php';
require_once __DIR__ . '/../../config/Database.php';


/*
  DAO = Data Access Object
  → c’est la couche qui communique directement avec la base de données
*/
class RendezVousDAO
{
    /*
      ============================
      ENREGISTREMENT D’UN RENDEZ-VOUS
      ============================

      Cette fonction enregistre un rendez-vous
      dans la base de données.
    */
    public function create(RendezVous $rdv): void
    {
        /*
          Connexion à la base de données
        */
        $pdo = Database::getConnexion();

        /*
          Vérification de sécurité :
          on s’assure que le service existe bien en base
        */
        $idService = $rdv->getService()->getIdService();

        if ($idService === null) {
            throw new LogicException(
                "Impossible d'insérer le rendez-vous : service non persisté"
            );
        }

        /*
          Requête SQL d’insertion du rendez-vous
        */
        $sql = "INSERT INTO rendezvous
                (date_Rdv, heure_Rdv, statut, message, idService)
                VALUES (?, ?, ?, ?, ?)";

        /*
          Préparation de la requête
          (sécurise contre les injections SQL)
        */
        $stmt = $pdo->prepare($sql);

        /*
          Exécution de la requête avec les données du rendez-vous
        */
        $stmt->execute([
            $rdv->getDateRdv(),                 // Date du rendez-vous
            $rdv->getHeureRdv(),                // Heure du rendez-vous
            $rdv->getStatut(),                  // Statut (ex : en_attente)
            $rdv->getMessage(),                 // Message éventuel
            $rdv->getService()->getIdService()  // Service choisi
        ]);

        /*
          Récupération de l’ID généré automatiquement
          et affectation à l’objet rendez-vous
        */
        $rdv->setIdRdv((int)$pdo->lastInsertId());
    }


    /*
      ============================
      RÉCUPÉRATION DE TOUS LES RENDEZ-VOUS
      ============================

      Utile pour :
      - un tableau d’administration
      - des statistiques
    */
    public function findAll(): array
    {
        $pdo = Database::getConnexion();

        /*
          Récupère toutes les lignes de la table rendezvous
        */
        $stmt = $pdo->query("SELECT * FROM rendezvous");

        return $stmt->fetchAll();
    }


    /*
      ============================
      HEURES DÉJÀ RÉSERVÉES
      ============================

      Cette fonction empêche la réservation
      de deux rendez-vous au même créneau.
    */
    public function findHeuresPrises(string $date): array
    {
        $pdo = Database::getConnexion();

        /*
          On récupère uniquement les heures
          pour une date donnée,
          en excluant les rendez-vous annulés
        */
        $sql = "SELECT heure_rdv FROM rendezvous
                WHERE date_rdv = ? AND statut != 'annulé'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$date]);

        /*
          On retourne un tableau simple des heures prises
          (ex : ['09:00:00', '10:30:00'])
        */
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
