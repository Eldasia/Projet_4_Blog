<?php $title = 'Erreur!';?>

<?php ob_start(); ?>

    <h2>Erreur 404</h2>
    <p class="lead">La page demandée n'existe pas</p>
    <a href="/" class="btn btn-primary">Retour à l'accueil</a>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>