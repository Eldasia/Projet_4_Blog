<?php $title = 'Erreur!';?>

<?php ob_start(); ?>

    <h2>Erreur du serveur</h2>
    <pre><?= $e->getMessage(); ?></pre>
    <a href="/" class="btn btn-primary">Retour à l'accueil</a>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>