<?php
/** Protection CSRF : jeton aléatoire en session, renvoyé par chaque formulaire POST. */
function csrfToken(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrfChamp(): string
{
    return '<input type="hidden" name="csrf" value="' . htmlspecialchars(csrfToken()) . '">';
}

function verifierCsrf(): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
        return;
    }
    $envoye  = $_POST['csrf'] ?? '';
    $attendu = $_SESSION['csrf'] ?? '';
    if ($attendu === '' || !is_string($envoye) || !hash_equals($attendu, $envoye)) {
        http_response_code(403);
        echo 'Requête refusée : jeton de sécurité invalide ou expiré. Rechargez la page et réessayez. <a href="index.php">Retour</a>';
        exit;
    }
}

/** Échappement HTML court pour les vues. */
function h($texte): string
{
    return htmlspecialchars((string) $texte, ENT_QUOTES, 'UTF-8');
}
