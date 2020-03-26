<?php $title = "Interface administrateur"?>

<?php ob_start(); ?>

<h1>Interface administrateur</h1>

<?php
    if (isset($_GET['result'])) 
    {
        if ($_GET['result'] == 1)
        {
            $messageResult = 'Votre article a bien été modifié.';
        }
        elseif ($_GET['result'] == 2)
        {
            $messageResult = 'Votre article a bien été supprimé.';
        }
        elseif ($_GET['result'] == 3)
        {
            $messageResult = 'Votre article a bien été ajouté.';
        }
        else
        {
            throw new Exception('Aucun message ne correspond à ce résultat.');
        }
        ?><p><?=$messageResult?></p><?php
    }
?>

<p><a href="index.php">Retour à la liste des billets</a></p>

<h2><a href="admin.php?action=displayPosts">Les articles</a></h2><h2><a href="admin.php?action=displayComments">Les commentaires</a></h2>

<?php $content = ob_get_clean();

require('template.php'); ?>