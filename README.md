# laCabanneDes5Elements
Projet réalisé pour une cliente particulière lors d'un stage : site vitrine présentant la praticienne, son lieu, ses prestations, ses tarifs, ses horaires et son parcours.

Structure en MVC avec PHP, HTML, CSS et JavaScript.

## Modules
- **Page vitrine** (`view/mainPage.php`) : accueil, présentation, parcours, prestations, tarifs, contact.
- **Formulaire de contact** : envoi d'un e-mail à la praticienne, avec jeton anti-CSRF, champ piège anti-robot et limitation de fréquence ; retour visuel après envoi.
- **Prise de rendez-vous** (développée à la demande, mais **désactivée** sur le site à la demande de la cliente) :
  créneaux calculés d'après les horaires d'ouverture et la durée du soin, contrôle serveur, réservation atomique (pas de double réservation), coordonnées du client avec consentement, page de confirmation et notification par e-mail.
  Pour l'activer : décommenter la ligne 28 de `view/mainPage.php` (lien `index.php?action=RDV`).

## Installation
1. Importer `bdd.sql` (script rejouable : crée la base `cabane`, les tables `service` et `rendezvous`, 4 prestations).
2. Copier `config.example.php` en `config.local.php` (ignoré par Git) et renseigner la base de données **et** les adresses e-mail
   (`mail_to` : destinataire ; `mail_from` : expéditeur, une adresse de votre domaine). Sans `mail_to`, le formulaire de contact affiche une erreur.
3. Le serveur doit pouvoir envoyer des e-mails (`mail()`).

## Organisation
- `index.php` : point d'entrée (session, CSRF, routage `?action=`).
- `config/` : `Config.php` (lecture de la configuration) et `Database.php` (connexion PDO).
- `controller/` : `ControllerPrincipal`, `mainPageController`, `RendezVousController`, `ContactController`, `securite.php`.
- `model/metier/` : `RendezVous`, `Service`, `Horaires` (horaires d'ouverture et créneaux), `CreneauIndisponibleException`.
- `model/dao/` : accès à la base de données.
- `view/` : page vitrine, formulaires de rendez-vous (`rdv/`), CSS et JavaScript.
- `images/` : médias du site (optimisés).

## À fournir par la cliente
Les **mentions légales** et la **politique de confidentialité** (identité, statut / SIRET, hébergeur) ne sont pas incluses : elles nécessitent des informations qui n'étaient pas dans le projet.
