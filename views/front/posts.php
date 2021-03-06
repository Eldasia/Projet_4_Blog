<div class="container-sm">
    <h1 class="text-center m-5">Bienvenue sur le blog de Jean Forteroche</h1>
    <p>Derniers billets du blog :</p>
</div>

<div class="row row-cols-1 row-cols-md-2">
<?php foreach ($listPosts as $post): ?>
    <div class="col mb-4">
        <div class="card" style="min-height: 250px;">
            <div class="card-header"><a href="/post/<?= $post->getId() ?>"><?= htmlspecialchars($post->getTitle()) ?> </a></div>
            <div class="card-body">
            <?= substr(nl2br($post->getContent()), 0, 300) ?> ...
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
    <?php foreach (range(1, $nbPage) as $i): ?>
        <a type="button" href="/<?= $i ?>" class="btn btn-secondary"><?= $i ?></a>
    <?php endforeach; ?>
    </div>
</div>