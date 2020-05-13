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

            <p><a href = "#" onclick="AreYouSure('report', '/post/<?=$postToDisplay->getId();?>/report/<?= $comment->getId()?>')">Signaler</a></p>
        <?php endforeach;?>
    </div>
    
    <div class="card-footer">        
        <form action="/post/<?=$postToDisplay->getId();?>/addComment" method='post'>
            <div class="form-group">
                <label for="author">Auteur : </label>
                <input class="form-control" type="text" name="author" id="author" value="<?= $validation->getOldValue('content') ?>"required/>
                <?php if ($validation->hasError('author')) : ?>
                    <span class="text-danger"><?= $validation->getError('author'); ?></span> </br>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="content">Commentaire : </label>
                <textarea class="form-control" name="content" id="content" rows="5" required><?= $validation->getOldValue('content') ?></textarea>
                <?php if ($validation->hasError('content')) : ?>
                    <span class="text-danger"><?= $validation->getError('content'); ?></span> </br>
                <?php endif; ?>
            </div>
            <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
    </div>
</div>