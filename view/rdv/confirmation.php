<?php
/* Page de confirmation. Variable fournie : $rdv (service, date, heure, nom, email). */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande enregistrée</title>
    <link rel="stylesheet" href="view/css/styleForm.css">
    <link rel="icon" href="images/la-cabane-des-5-elements-Logo.png">
</head>
<body>
<h2>Votre demande est enregistrée</h2>
<div class="recap">
    <p><strong><?= h($rdv['service']) ?></strong></p>
    <p>le <?= h(date('d/m/Y', strtotime($rdv['date']))) ?> à <?= h($rdv['heure']) ?></p>
    <p>Au nom de <?= h($rdv['nom']) ?> (<?= h($rdv['email']) ?>)</p>
    <p class="info">Statut : <em>en attente de confirmation</em>. La praticienne vous répondra par e-mail.</p>
</div>
<p><a href="index.php">← Retour au site</a></p>
</body>
</html>
