<?php $title = htmlspecialchars($postToDisplay->getTitle()) ;?>

<?php ob_start(); ?>

<div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
        <h3><?= htmlspecialchars($postToDisplay->getTitle()) ?></h3>
        <a class="btn btn-primary" href="/">Retour à la page d'accueil</a>
    </div>
    
    <div class="card-body">
        <?= $postToDisplay->getContent() ?>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <em>Ajouté le <?= $postToDisplay->getCreationDate() ?></em>
        <em>
            <?php if (!empty($postToDisplay->getChangeDate())) :
                ?>
                Modifié le <?= $postToDisplay->getChangeDate(); ?>
                <?php 
            endif; ?> 
        </em>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">Commentaires</div>
    <div class="card-body">
        <?php if (count($listComments) === 0): ?>
            <div class="alert alert-info">Aucun commentaire</div>
        <?php endif; ?>

        <?php foreach ($listComments as $comment): ?>   
            <blockquote class="blockquote">
                <p class="mb-0"><?= nl2br(htmlspecialchars($comment->getContent())) ?></p>
                <footer class="blockquote-footer"><?= $comment->getAuthor()?></footer>
            </blockquote>

            <p><a href = "#" onclick="AreYouSure('report', 'index.php?action=displayPost&id=<?=$postToDisplay->getId();?>&commentId=<?= $comment->getId()?>&actionComment=report')">Signaler</a></p>
        <?php endforeach;?>
    </div>
    
    <div class="card-footer">        
        <form action="index.php?action=addComment&id=<?=$postToDisplay->getId();?>" method='post'>
            <div class="form-group">
                <label for="author">Auteur : </label>
                <input class="form-control" type="text" name="author" id="author" required/>
            </div>
            <div class="form-group">
                <label for="content">Commentaire : </label>
                <textarea class="form-control" name="content" id="content" rows="5" required></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
    </div>
</div>

    <?php

    $content = ob_get_clean();

    require('views/template.php'); ?>