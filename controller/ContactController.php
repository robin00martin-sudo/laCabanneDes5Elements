<?php
require_once __DIR__ . '/../config/Config.php';

/**
 * Formulaire de contact : validation, anti-spam, envoi d'un e-mail à la praticienne,
 * puis redirection vers la page d'accueil avec un message (jamais de page blanche).
 */
class ContactController
{
    private const DELAI_MIN_SECONDES = 30;   // un visiteur ne peut pas envoyer 2 messages en moins de 30 s

    public function envoyer(): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            http_response_code(405);
            exit;
        }

        // Anti-spam n°1 : champ « piège » invisible que seuls les robots remplissent
        if (trim($_POST['site_web'] ?? '') !== '') {
            $this->retour('ok');           // on fait croire au robot que c'est passé
        }

        // Anti-spam n°2 : limitation de fréquence
        if (isset($_SESSION['dernier_contact']) && time() - $_SESSION['dernier_contact'] < self::DELAI_MIN_SECONDES) {
            $this->retour('trop_rapide');
        }

        $nom     = trim($_POST['name'] ?? '');
        $email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $message = trim($_POST['message'] ?? '');

        if ($nom === '' || !$email || $message === ''
            || strlen($nom) > 100 || strlen($message) > 5000) {
            $this->retour('invalide');
        }

        $destinataire = Config::get('mail_to');
        if ($destinataire === '') {
            error_log('[Cabane] Formulaire de contact : « mail_to » n\'est pas configuré.');
            $this->retour('erreur');
        }

        $expediteur = Config::get('mail_from') ?: 'no-reply@localhost';
        $corps = "Nom : $nom\n\nEmail de l'utilisateur : $email\n\nMessage :\n$message";
        // Seul l'e-mail (validé : il ne peut pas contenir de saut de ligne) figure dans les en-têtes
        $entetes = [
            "From: $expediteur",
            "Reply-To: $email",
            "Content-Type: text/plain; charset=UTF-8",
        ];

        if (!@mail($destinataire, 'Message depuis le site', $corps, implode("\r\n", $entetes))) {
            error_log('[Cabane] mail() a échoué pour le formulaire de contact.');
            $this->retour('erreur');
        }

        $_SESSION['dernier_contact'] = time();
        $this->retour('ok');
    }

    private function retour(string $statut): void
    {
        header('Location: index.php?contact=' . $statut . '#contact');
        exit;
    }
}
