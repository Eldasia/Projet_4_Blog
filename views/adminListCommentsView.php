<?php $title = 'Administration des commentaires'?>

<?php ob_start(); ?>

<a class="btn btn-primary my-3" href="admin.php">Retour à l'interface d'administration</a>

<p><a href="admin.php?action=displayComments">Tous les commentaires</a> <a href="admin.php?action=displayComments&reportValue=2">Commentaires validés</a> <a href="admin.php?action=displayComments&reportValue=3">Commentaires en attente</a> <a href="admin.php?action=displayComments&reportValue=1">Commentaires refusés</a></p>

<table class="table mt-3">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Auteur</th>
      <th scope="col">Contenu</th>
      <th scope="col">Date de création</th>
      <th scope="col" colspan=2>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listComments as $comment) : ?>
        <tr>
        <td><?=$comment->getAuthor()?></td>
        <td><?=$comment->getContent()?></td>
        <td><?=$comment->getCreationDate()?></td>
        <td><a href="admin.php?action=displayComments&commentId=<?= $comment->getId()?>&actionComment=validate" class="btn <?php if($comment->getReporting() == 2){echo "disabled btn-outline-secondary";}else{echo "btn-outline-success";}?>">Valider</a></td>
        <td><a href="admin.php?action=displayComments&commentId=<?= $comment->getId()?>&actionComment=refuse" class="btn <?php if($comment->getReporting() == 1){echo "disabled btn-outline-secondary";}else{echo "btn-outline-danger";}?>">Refuser</a></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
$content = ob_get_clean();

require('template.php'); ?>