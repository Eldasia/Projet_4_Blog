<?php $title = "Blog de Jean Forteroche"; ?>

<?php ob_start(); ?>
<h1>Bienvenue sur mon blog !</h1>
<p><a href="admin.php">Interface administrateur</a></p>
<p>Derniers billets du blog :</p>


<?php
foreach ($listPosts as $post)
{
?>
    <div>
        <h3>
            <a href="index.php?action=displayPost&id=<?= $post->getId() ?>"><?= htmlspecialchars($post->getTitle()) ?> </a>
            <em>le <?= $post->getCreationDate() ?> par <?= $post->getAuthor()?></em>
        </h3>
        
        <p>
            <?= substr(nl2br(htmlspecialchars($post->getContent())), 0, 400) ?> ...
            <br />
            <em>
                <?php if (!empty($post->getChangeDate())) 
                { 
                    ?>
                    Modifié le <?= $post->getChangeDate(); ?>
                    <?php 
                } 
                ?> 
            </em>
            <br />
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>