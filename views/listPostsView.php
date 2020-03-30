<?php $title = "Blog de Jean Forteroche"; ?>

<?php ob_start(); ?>
<h1 id="titleBlog">Bienvenue sur le blog de Jean Forteroche !</h1>
<p>Derniers billets du blog :</p>

<div class="card-columns">
<?php foreach ($listPosts as $post): ?>
    
        <div class="card mb-3">
            <div class="card-header"><a href="index.php?action=displayPost&id=<?= $post->getId() ?>"><?= htmlspecialchars($post->getTitle()) ?> </a></div>
            <div class="card-body">
            <?= substr(nl2br($post->getContent()), 0, 400) ?> ...
            </div>
            <div class="card-footer">
                <em>le <?= $post->getCreationDate() ?></em>
            </div>
        </div>

<?php endforeach; ?>
</div>
<nav aria-label="Page navigation example">
    <ul class="pagination">
    <?php for ($i = 1; $i <= $nb_page_posts; $i++): ?>
        <li class="page-item"><a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
    <?php endfor; ?>
    </ul>
</nav>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>