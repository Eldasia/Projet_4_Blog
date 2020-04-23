<?php $title = "Blog de Jean Forteroche"; ?>

<?php ob_start(); ?>
<p class="text-center m-5 display-2">Bienvenue sur le blog de Jean Forteroche</p>
<p>Derniers billets du blog :</p>

<div class="row row-cols-1 row-cols-md-2">
<?php foreach ($listPosts as $post): ?>
    <div class="col mb-4">
        <div class="card" style="height: 300px;">
            <div class="card-header"><a href="/post/<?= $post->getId() ?>"><?= htmlspecialchars($post->getTitle()) ?> </a></div>
            <div class="card-body">
            <?= substr(nl2br($post->getContent()), 0, 400) ?> ...
            </div>
            <div class="card-footer">
                <em>le <?= $post->getCreationDate() ?></em>
            </div>
        </div>
    </div>

<?php endforeach; ?>
</div>

<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group mr-2" role="group">
    <?php for ($i = 1; $i <= $nb_page_posts; $i++): ?>
        <a type="button" href="/<?= $i ?>" class="btn btn-secondary"><?= $i ?></a>
    <?php endfor; ?>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>