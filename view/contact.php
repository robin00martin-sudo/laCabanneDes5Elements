<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$message = trim($_POST['message'] ?? '');

if ($name === '' || !$email || $message === '' ) {
    http_response_code(400);
    exit("Champs invalides");
}

$to = "heartston550@gmail.com";
$sujet = "Message depuis le site";

$body = 
    "Nom : $name\n\n" .
    "Email de l'utilisateur : $email\n\n" .
    "Message :\n$message";

$headers = [
    "From: no-reply@tonsite.com",
    "Reply-To: $email",
    "Content-Type: text/plain; charset=UTF-8"
];

mail($to, $sujet, $body, implode("\r\n", $headers));
