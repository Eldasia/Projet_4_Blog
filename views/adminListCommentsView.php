<?php $title = 'Administration des commentaires'?>

<?php ob_start(); ?>

<p><a href="admin.php">Retour à l'interface d'administration</a></p>

<p><a href="admin.php?action=displayComments">Tous les commentaires</a> <a href="admin.php?action=displayComments&reportValue=2">Commentaires validés</a> <a href="admin.php?action=displayComments&reportValue=3">Commentaires en attente</a> <a href="admin.php?action=displayComments&reportValue=1">Commentaires refusés</a></p>
<table>
<?php
foreach ($listComments as $comment)
{
?>
    <tr>
        <td><?=$comment->getTitle()?></td>
        <td><?=$comment->getAuthor()?></td>
        <td><?=$comment->getContent()?></td>
        <td><?=$comment->getCreationDate()?></td>
        <td><?=$comment->getReporting()?></td>
        <td><a href="admin.php?action=displayComments&commentId=<?= $comment->getId()?>&actionComment=validate" class="<?php if($comment->getReporting() == 2){echo "disabled";}?>">Valider</a></td>
        <td><a href="admin.php?action=displayComments&commentId=<?= $comment->getId()?>&actionComment=refuse" class="<?php if($comment->getReporting() == 1){echo "disabled";}?>">Refuser</a></td>
    </tr>

<?php
}
?>
</table>
<?php
$content = ob_get_clean();

require('template.php'); ?>