<?php
/*
  POINT D'ENTRÉE du site : décide quoi afficher selon l'« action » de l'adresse
  (index.php?action=RDV, index.php?action=contact…). Sans action : page vitrine.
*/
date_default_timezone_set('Europe/Paris');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'Lax');
session_start();

require_once __DIR__ . '/controller/securite.php';
require_once __DIR__ . '/controller/ControllerPrincipal.php';

verifierCsrf();   // tout formulaire POST doit porter le jeton de la session

$action = $_GET['action'] ?? 'defaut';
$controleurPrincipal = new ControleurPrincipal();
$controleurPrincipal->executerAction($action);
