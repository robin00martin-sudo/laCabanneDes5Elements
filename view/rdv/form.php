<?php
/*
  PAGE DE PRISE DE RENDEZ-VOUS.
  Ce fichier se contente d'AFFICHER ce que prépare RendezVousController :
    $services, $idService, $date, $creneaux (['heure' => 'HH:MM', 'dispo' => bool]),
    $ferme (jour de fermeture), $erreurs, $erreurBase, $saisie.
  Toutes les règles sont revérifiées côté serveur au moment de la validation.
*/
$saisie = $saisie ?? [];
$erreurs = $erreurs ?? [];
$nomService = '';
foreach ($services as $s) {
    if ($idService == $s->getIdService()) { $nomService = $s->getNomService() . ' (' . $s->getDuree() . ' min)'; }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un rendez-vous</title>
    <link rel="stylesheet" href="view/css/styleForm.css">
    <link rel="icon" href="images/la-cabane-des-5-elements-Logo.png">
</head>
<body>
<h2>Prendre un rendez-vous</h2>

<?php if ($erreurBase): ?>
    <p class="erreurs" role="alert"><?= h($erreurBase) ?></p>
<?php endif; ?>

<!-- Étape 1 : choix de la prestation et de la date (le formulaire se recharge à chaque changement) -->
<form method="get">
    <input type="hidden" name="action" value="RDV">

    <label for="service">Service :</label>
    <select name="service" id="service" onchange="this.form.submit()">
        <option value="">-- Choisir un service --</option>
        <?php foreach ($services as $service): ?>
            <option value="<?= (int) $service->getIdService() ?>"
                <?= ($idService == $service->getIdService()) ? 'selected' : '' ?>>
                <?= h($service->getNomService()) ?> (<?= (int) $service->getDuree() ?> min)
            </option>
        <?php endforeach; ?>
    </select>

    <label for="date">Date :</label>
    <input type="date" name="date" id="date" value="<?= h($date) ?>" min="<?= date('Y-m-d') ?>"
           onchange="this.form.submit()">
</form>
<hr>

<?php if ($idService && !$erreurBase): ?>
    <h3>Disponibilités du <?= h(date('d/m/Y', strtotime($date))) ?></h3>

    <?php if (!empty($erreurs)): ?>
        <div class="erreurs" role="alert">
            <?php foreach ($erreurs as $erreur): ?><div>⚠ <?= h($erreur) ?></div><?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($ferme): ?>
        <p class="info">Le cabinet est fermé ce jour-là. Choisissez une autre date.</p>
    <?php elseif (!array_filter($creneaux, fn($c) => $c['dispo'])): ?>
        <p class="info">Aucun créneau disponible ce jour-là pour cette prestation. Essayez une autre date.</p>
    <?php else: ?>
        <form method="post" action="index.php?action=enregistrer">
            <?= csrfChamp() ?>
            <input type="hidden" name="date" value="<?= h($date) ?>">
            <input type="hidden" name="service" value="<?= (int) $idService ?>">

            <p><strong><?= h($nomService) ?></strong></p>
            <div class="horaires-grid">
                <?php foreach ($creneaux as $c): ?>
                    <?php if ($c['dispo']): ?>
                        <label class="horaire-dispo">
                            <input type="radio" name="heure" value="<?= h($c['heure']) ?>" required
                                <?= (($_POST['heure'] ?? '') === $c['heure']) ? 'checked' : '' ?>>
                            <?= h($c['heure']) ?>
                        </label>
                    <?php else: ?>
                        <div class="horaire-indispo"><?= h($c['heure']) ?></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <label for="nom">Nom et prénom</label>
            <input type="text" id="nom" name="nom" maxlength="100" required autocomplete="name"
                   value="<?= h($saisie['nom'] ?? '') ?>">

            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" maxlength="150" required autocomplete="email"
                   value="<?= h($saisie['email'] ?? '') ?>">

            <label for="telephone">Téléphone (facultatif)</label>
            <input type="tel" id="telephone" name="telephone" maxlength="20" autocomplete="tel"
                   value="<?= h($saisie['telephone'] ?? '') ?>">

            <label for="message">Message (facultatif)</label>
            <textarea id="message" name="message" rows="3" maxlength="1000"><?= h($saisie['message'] ?? '') ?></textarea>

            <label class="consentement">
                <input type="checkbox" name="consentement" value="1" required>
                J'accepte que ces informations soient utilisées uniquement pour traiter ma demande de rendez-vous.
            </label>

            <button type="submit">Envoyer ma demande</button>
        </form>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
