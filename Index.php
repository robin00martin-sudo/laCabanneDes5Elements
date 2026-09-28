<?php
/*
  Ce fichier est le POINT D’ENTRÉE du site.

  Concrètement :
  - C’est ce fichier qui est appelé quand quelqu’un arrive sur le site
  - Il décide QUOI afficher en fonction de l’action demandée
  - Il fait le lien entre l’URL et le bon traitement à effectuer

  Aucune connaissance en développement n’est nécessaire pour comprendre
  la logique générale décrite ci-dessous.
*/


/*
  On charge le fichier "ControllerPrincipal.php".

  Ce fichier contient le "chef d’orchestre" du site :
  c’est lui qui sait quelle page afficher et quoi faire selon les cas
  (page d’accueil, formulaire, rendez-vous, etc.).

  "__DIR__" signifie : le dossier dans lequel se trouve CE fichier.
  Cela évite les erreurs si le site change d’emplacement.
*/
require_once __DIR__ . '/controller/ControllerPrincipal.php';


/*
  On regarde si une "action" est demandée dans l’adresse du site (URL).

  Exemple d’URL :
  - index.php?action=contact
  - index.php?action=RDV

  Si aucune action n’est précisée,
  on utilise l’action par défaut : "defaut".
*/
$action = $_GET['action'] ?? 'defaut';


/*
  On crée le contrôleur principal du site.

  On peut le voir comme :
  → la personne qui reçoit la demande
  → qui comprend ce que l’utilisateur veut
  → et qui décide quelle page ou quel traitement afficher
*/
$controleurPrincipal = new ControleurPrincipal();


/*
  On demande au contrôleur d’exécuter l’action demandée.

  Selon la valeur de "$action", le site pourra par exemple :
  - afficher la page d’accueil
  - afficher un formulaire
  - traiter un envoi de message
  - afficher une page d’erreur

  Toute la logique se trouve dans le fichier ControllerPrincipal.php
*/
$controleurPrincipal->executerAction($action);
