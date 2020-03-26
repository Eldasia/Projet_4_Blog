<?php $title = htmlspecialchars($postToDisplay->getTitle()) ;?>

<?php ob_start(); ?>
<p><a href="index.php?action=listPosts">Retour à la page d'accueil</a></p>
<div>
    <h3>
        <?= htmlspecialchars($postToDisplay->getTitle()) ?>
        <em>le <?= $postToDisplay->getCreationDate() ?> par <?= $postToDisplay->getAuthor()?></em>
    </h3>
    
    <p>
        <?= $postToDisplay->getContent() ?>
        <br />
        <em>
            <?php if (!empty($postToDisplay->getChangeDate())) 
            { 
                ?>
                Modifié le <?= $postToDisplay->getChangeDate(); ?>
                <?php 
            } 
            ?> 
        </em>
    </p>
</div>

<p><a href="index.php?action=displayPost&id=<?=$postToDisplay->getId();?>&form=true">Ajouter un commentaire</a></p>

<?php
    if (!isset($_GET['form']))
    {
        foreach ($listComments as $comment)
        {
?>
            <div>
                <h3>
                    <?= htmlspecialchars($comment->getTitle()) ?>
                    <em>le <?= $comment->getCreationDate() ?> par <?= $comment->getAuthor()?></em>
                </h3>
                
                <p>
                    <?= nl2br(htmlspecialchars($comment->getContent())) ?>
                    <br />
                </p>
                <p><a href = "#" onclick="AreYouSure('report', 'index.php?action=displayPost&id=<?=$postToDisplay->getId();?>&commentId=<?= $comment->getId()?>&actionComment=report')">Signaler</a></p>
            </div>

<?php
        }
    }
    elseif (isset($_GET['form']) && ($_GET['form'] == true))
    {
    ?>
        <form action="index.php?action=addComment&id=<?=$postToDisplay->getId();?>" method='post'>
            <label for="author">Auteur : </label><input type="text" name="author" id="author" required/> <br />
            <label for="title">Titre : </label><input type="text" name="title" id="title" required/> <br />
            <label for="content">Commentaire : </label><textarea name="content" id="content" cols="30" rows="10" required></textarea> <br />
            <input type="submit" value="Ajouter" />
        </form>
    <?php
    }

    $content = ob_get_clean();

    require('template.php'); ?>