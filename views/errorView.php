<?php $title = 'Erreur!';?>

<?php ob_start(); ?>

    <p>Erreur: <?= $errorMessage; ?></p>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>