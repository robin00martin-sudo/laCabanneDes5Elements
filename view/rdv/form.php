<?php
/*
  Ce fichier est la PAGE DU FORMULAIRE DE PRISE DE RENDEZ-VOUS.

  Son rôle :
  - afficher les services disponibles
  - permettre de choisir une date
  - afficher les créneaux horaires disponibles
  - empêcher de choisir une date passée ou déjà réservée

  Ce fichier ne décide rien :
  il affiche uniquement les informations reçues du contrôleur.
*/


/*
  Date du jour (utilisée pour bloquer les dates passées)
*/
$today = date('Y-m-d');

/*
  Sécurité :
  si la variable $idService n’existe pas encore,
  on lui donne la valeur "null"
*/
$idService = $idService ?? null;
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <!-- Titre affiché dans l’onglet du navigateur -->
    <title>Prendre un rendez-vous</title>

    <!-- Feuille de style dédiée au formulaire -->
    <link rel="stylesheet" href="view/css/styleForm.css">

    <!-- Icône du site -->
    <link rel="icon" href="images/la-cabane-des-5-elements-Logo.png">
</head>

<body>

<h2>Prendre un rendez-vous</h2>

<!-- ========================================= -->
<!-- FORMULAIRE : CHOIX DU SERVICE ET DE LA DATE -->
<!-- ========================================= -->

<form method="get">
    <!-- 
      On précise l’action "RDV" pour rester
      sur la page de prise de rendez-vous
    -->
    <input type="hidden" name="action" value="RDV">

    <!-- Choix du service -->
    <label for="service">Service :</label>
    <select name="service" id="service" onchange="this.form.submit()">
        <!-- 
          À chaque changement de service,
          le formulaire est envoyé automatiquement
          pour recharger les disponibilités
        -->
        <option value="">-- Choisir un service --</option>

        <?php foreach ($services as $service): ?>
            <!-- 
              Chaque option correspond à une prestation
            -->
            <option value="<?= (int)$service->getIdService(); ?>"
                <?= ($idService == $service->getIdService()) ? "selected" : "" ?>>
                <?= htmlspecialchars($service->getNomService()); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Choix de la date -->
    <label for="date">Date :</label>
    <input
        type="date"
        name="date"
        value="<?= htmlspecialchars($date) ?>"
        min="<?= date('Y-m-d') ?>"
        onchange="this.form.submit()">
    <!-- 
      min = aujourd’hui → empêche de choisir une date passée
      Le formulaire se recharge automatiquement au changement
    -->
</form>

<hr>

<!-- ========================================= -->
<!-- AFFICHAGE DES CRENEAUX HORAIRES -->
<!-- ========================================= -->

<?php if ($idService): ?>
    <!-- 
      Les horaires ne sont affichés
      que si un service est sélectionné
    -->

    <h3>Disponibilités pour le <?= htmlspecialchars($date) ?></h3>

    <form method="post" action="index.php?action=enregistrer">
        <!-- Données cachées envoyées au moment de la validation -->
        <input type="hidden" name="date" value="<?= htmlspecialchars($date) ?>">
        <input type="hidden" name="service" value="<?= $idService ?>">

        <div class="horaires-grid">
            <?php
            /*
              Gestion du fuseau horaire (France)
            */
            $timezone = new DateTimeZone('Europe/Paris');

            /*
              Date et heure actuelles
            */
            $maintenant = new DateTime('now', $timezone);

            /*
              Boucle sur tous les créneaux possibles
            */
            foreach ($horaires as $heure):

                /*
                  Création d’un objet date/heure pour le créneau
                */
                $creneau = DateTime::createFromFormat(
                    'Y-m-d H:i:s',
                    "$date $heure:00",
                    $timezone
                );

                /*
                  Vérifie si le créneau est déjà passé
                */
                $estPassee = $creneau <= $maintenant;

                /*
                  Vérifie si le créneau est déjà réservé
                */
                $estPrise = in_array(
                    $creneau->format('H:i:s'),
                    $heuresPrises
                );
            ?>

                <?php if (!$estPassee && !$estPrise): ?>
                    <!-- Créneau DISPONIBLE -->
                    <label class="horaire-dispo">
                        <input type="radio" name="heure" value="<?= $heure ?>" required>
                        <?= $heure ?>
                    </label>
                <?php else: ?>
                    <!-- Créneau INDISPONIBLE -->
                    <div class="horaire-indispo">
                        <?= $heure ?>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>

        <br>

        <!-- Validation du rendez-vous -->
        <button type="submit">Valider le créneau</button>
    </form>
<?php endif; ?>

</body>
</html>
