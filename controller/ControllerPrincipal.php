<?php
/*
  Ce fichier définit le CONTROLEUR PRINCIPAL du site.

  Son rôle :
  - recevoir la demande de l’utilisateur (via l’URL)
  - décider quelle partie du site doit être affichée
  - déléguer le travail au bon fichier

  On peut le comparer à un standard téléphonique :
  il reçoit l’appel et le redirige vers la bonne personne.
*/


/*
  On charge les fichiers nécessaires au fonctionnement du site.

  - mainPageController.php :
    gère l’affichage de la page principale du site

  - RendezVousController.php :
    gère tout ce qui concerne les rendez-vous
    (formulaire, enregistrement, etc.)
*/
require_once __DIR__ . '/mainPageController.php';
require_once __DIR__ . '/RendezVousController.php';


/*
  Déclaration du contrôleur principal
*/
class ControleurPrincipal
{
    /*
      Cette fonction est appelée à chaque fois qu’une page est demandée.

      Elle reçoit une "action" sous forme de texte (ex : "RDV", "enregistrer", "defaut")
      et décide quoi faire en fonction de cette valeur.
    */
    public function executerAction(string $action): void
    {
        /*
          On analyse la valeur de l’action demandée
          et on oriente vers le bon traitement.
        */
        switch ($action) {

            /*
              Cas : l’utilisateur veut prendre un rendez-vous
              → on affiche le formulaire de rendez-vous
            */
            case 'RDV':
                $controller = new RendezVousController();
                $controller->afficherFormulaireRdv();
                break;

            /*
              Cas : l’utilisateur a envoyé le formulaire de rendez-vous
              → on enregistre les informations
            */
            case 'enregistrer':
                $controller = new RendezVousController();
                $controller->enregistrer();
                break;

            /*
              Cas par défaut (aucune action précisée ou action inconnue)
              → on affiche la page principale du site
            */
            case 'defaut':
            default:
                $controller = new mainPageController();
                $controller->afficherFormulaire();
                break;
        }
    }
}
