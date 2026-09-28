<?php
/*
  Ce fichier gère les SERVICES (prestations) côté base de données.

  Un service correspond par exemple à :
  - Shiatsu
  - Réflexologie
  - Massage spécifique, etc.

  Ce fichier permet :
  - de récupérer les services existants
  - d’en ajouter
  - d’en modifier
  - d’en supprimer

  Il ne gère ni l’affichage, ni la navigation sur le site.
*/


/*
  On charge :
  - la classe Service (représente une prestation)
  - la connexion à la base de données
*/
require_once __DIR__ . '/../metier/Service.php';
require_once __DIR__ . '/../../config/Database.php';


/*
  DAO = Data Access Object
  → classe dédiée aux échanges avec la base de données
*/
class ServiceDAO
{
    /*
      ============================
      RÉCUPÉRER TOUS LES SERVICES
      ============================

      Cette fonction récupère toutes les prestations
      enregistrées dans la base de données.

      Elle retourne une liste d’objets Service.
    */
    public function findAll(): array
    {
        /*
          Connexion à la base
        */
        $pdo = Database::getConnexion();

        /*
          Requête pour récupérer tous les services
        */
        $sql = "SELECT * FROM service";
        $stmt = $pdo->query($sql);

        /*
          Tableau qui contiendra tous les services
        */
        $services = [];

        /*
          Pour chaque ligne trouvée en base,
          on crée un objet Service
        */
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $services[] = new Service(
                $data['idService'],
                $data['nomService'],
                $data['description'],
                $data['duree']
            );
        }

        return $services;
    }


    /*
      ============================
      RÉCUPÉRER UN SERVICE PAR ID
      ============================

      Sert par exemple :
      - lors de la prise de rendez-vous
      - pour vérifier qu’un service existe
    */
    public function findById(int $idService): ?Service
    {
        $pdo = Database::getConnexion();

        /*
          Recherche du service correspondant à l’ID
        */
        $sql = "SELECT * FROM service WHERE idService = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idService]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        /*
          Si aucun service n’est trouvé,
          on retourne null
        */
        if (!$data) {
            return null;
        }

        /*
          Création de l’objet Service
        */
        $s = new Service(
            $data['idService'],
            $data['nomService'],
            $data['description'],
            (int)$data['duree']
        );

        return $s;
    }


    /*
      ============================
      AJOUTER UN SERVICE
      ============================

      Utilisé pour créer une nouvelle prestation
      dans la base de données.
    */
    public function create(Service $service): void
    {
        $pdo = Database::getConnexion();

        $sql = "INSERT INTO service (nomService, description, duree)
                VALUES (?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $service->getNomService(),
            $service->getDescription(),
            $service->getDuree()
        ]);

        /*
          On récupère l’ID créé automatiquement
          et on l’associe à l’objet Service
        */
        $service->setIdService((int)$pdo->lastInsertId());
    }


    /*
      ============================
      METTRE À JOUR UN SERVICE
      ============================

      Permet de modifier :
      - le nom
      - la description
      - la durée
      d’un service existant.
    */
    public function update(Service $service): void
    {
        $pdo = Database::getConnexion();

        $sql = "UPDATE service
                SET nomService = ?, description = ?, duree = ?
                WHERE idService = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $service->getNomService(),
            $service->getDescription(),
            $service->getDuree(),
            $service->getIdService()
        ]);
    }


    /*
      ============================
      SUPPRIMER UN SERVICE
      ============================

      Supprime définitivement une prestation
      de la base de données.
    */
    public function delete(int $idService): void
    {
        $pdo = Database::getConnexion();

        $sql = "DELETE FROM service WHERE idService = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idService]);
    }
}
