<?php $title = "Interface administrateur"; ?>

<?php ob_start(); ?>
<<<<<<< HEAD
=======
<h1>Bienvenue sur mon blog !</h1>
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
>>>>>>> d2c8a812fa308b9d3bd580449199b192881496c0

<p><a href="admin.php">Retour à l'interface d'administration</a></p>
<p><a href="admin.php?action=createPost">Ajouter un article</a></p>
<table>
    <tr>
        <th>Titre</td>
        <th>Auteur</td>
        <th>Date de création</td>
        <th>Date de modification</td>
        <th colspan = 2>Action</td>
    </tr>
    <?php
    foreach ($listPosts as $post) 
    {
    ?>
        <tr>
            <td><?=$post->getTitle()?></td>
            <td><?=$post->getAuthor()?></td>
            <td><?=$post->getCreationDate()?></td>
            <td><?=$post->getChangeDate()?></td>
            <td><a href="admin.php?action=updatePost&id=<?=$post->getId()?>">Modifier</a></td>
            <td><a href=# onclick="AreYouSure('delete', 'admin.php?action=deletePost&id=<?=$post->getId()?>')">Supprimer</a></td>
        </tr>
    <?php
    }
    ?>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>