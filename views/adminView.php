<?= $title = 'Interface administrateur' ?>

<?php ob_start(); ?>

<p><a href="index.php">Retour à la liste des billets</a></p>

<h1><a href="admin.php?action=displayPosts">Les articles</a></h1><h1><a href="admin.php?action=displayComments">Les commentaires</a></h1>

<?php $content = ob_get_clean();

    require('template.php'); ?>