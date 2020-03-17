<?php $title = 'Administration des commentaires'?>

<?php ob_start(); ?>

<p><a href="admin.php">Retour à l'interface d'administration</a></p>

<p><a href="admin.php?action=displayComments">Tous les commentaires</a> <a href="admin.php?action=displayComments&reportValue=2">Commentaires validés</a> <a href="admin.php?action=displayComments&reportValue=3">Commentaires en attente</a> <a href="admin.php?action=displayComments&reportValue=1">Commentaires refusés</a></p>

<?php
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
    </div>

<?php
}

$content = ob_get_clean();

require('template.php'); ?>