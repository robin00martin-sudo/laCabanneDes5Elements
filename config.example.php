<?php
// Copiez ce fichier en « config.local.php » et renseignez vos valeurs.
// config.local.php est ignoré par Git : identifiants et adresses ne sont jamais publiés.
return [
    'host'   => 'localhost',
    'port'   => 3306,
    'dbname' => 'cabane',
    'user'   => 'votre_identifiant',
    'pass'   => 'votre_mot_de_passe',

    // E-mails (formulaire de contact et notification des rendez-vous)
    'mail_to'   => 'adresse-de-la-praticienne@example.com',
    'mail_from' => 'no-reply@votre-domaine.fr',   // une adresse de VOTRE domaine (délivrabilité)
];
