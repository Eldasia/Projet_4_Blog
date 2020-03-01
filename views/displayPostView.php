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
</div>