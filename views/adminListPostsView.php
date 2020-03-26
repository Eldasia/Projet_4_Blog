<?php $title = "Interface administrateur"; ?>

<?php ob_start(); ?>

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