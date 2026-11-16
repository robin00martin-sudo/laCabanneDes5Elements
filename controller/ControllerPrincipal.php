<?php
/*
  CONTROLEUR PRINCIPAL : le « standard téléphonique » du site.
  Il reçoit l'action demandée et la confie au bon contrôleur.
*/
require_once __DIR__ . '/mainPageController.php';
require_once __DIR__ . '/RendezVousController.php';
require_once __DIR__ . '/ContactController.php';

class ControleurPrincipal
{
    public function executerAction(string $action): void
    {
        switch ($action) {
            case 'RDV':            // formulaire de prise de rendez-vous
                (new RendezVousController())->afficherFormulaireRdv();
                break;

            case 'enregistrer':    // envoi du formulaire de rendez-vous (POST)
                (new RendezVousController())->enregistrer();
                break;

            case 'confirmation':   // page « votre demande a bien été enregistrée »
                (new RendezVousController())->afficherConfirmation();
                break;

            case 'contact':        // envoi du formulaire de contact (POST)
                (new ContactController())->envoyer();
                break;

            case 'defaut':
            default:               // page vitrine
                (new mainPageController())->afficherFormulaire();
                break;
        }
    }
}
