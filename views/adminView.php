<?php $title = "Interface administrateur"?>

<?php ob_start(); ?>

<p class="text-center m-5 display-2">Interface administrateur</p>

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

<a class="btn btn-primary" href="index.php">Retour à la liste des billets</a>
<div class="card my-4">
    <div class="card-body">
        <a class="btn btn-lg btn-outline-info btn-block" href="admin.php?action=displayPosts">Les articles</a>
        <a class="btn btn-lg btn-outline-info btn-block" href="admin.php?action=displayComments">Les commentaires</a>
    </div>
</div>

<?php $content = ob_get_clean();

require('template.php'); ?>