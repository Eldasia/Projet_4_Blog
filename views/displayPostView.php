<?php $title = htmlspecialchars($postToDisplay->getTitle()) ;?>

<p><a href="index.php?action=listPosts">Retour à la page d'accueil</a></p>
<div class="news">
    <h3>
        <?= htmlspecialchars($postToDisplay->getTitle()) ?>
        <em>le <?= $postToDisplay->getCreationDate() ?> par <?= $postToDisplay->getAuthor()?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($postToDisplay->getContent())) ?>
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

    <form action="index.php?action=addComment&id=<?=$postToDisplay->getId();?>" method='post'>
            <label for="author">Auteur : </label><input type="text" name="author" id="author" required/> <br />
            <label for="title">Titre : </label><input type="text" name="title" id="title" required/> <br />
            <label for="content">Commentaire : </label><textarea name="content" id="content" cols="30" rows="10" required></textarea> <br />
            <input type="submit" value="Ajouter" />
    </form>
</div>