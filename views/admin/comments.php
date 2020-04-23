<?php $title = 'Administration des commentaires'?>

<?php ob_start(); ?>

<p><a class="btn btn-primary mt-4" href="admin.php">Retour à l'interface d'administration</a></p>

<p class="text-center m-4 display-3">Les commentaires</p>

<div class="row">
  <div class="col-md-12 text-center">
    <div class="btn-group mb-2" role="group">
        <a type="button" class="btn btn-outline-info <?php if(!isset($_GET['reportValue']) || (empty($_GET['reportValue']))){echo "active";}?>" href="admin.php?action=displayComments">Tous les commentaires</a>
        <a type="button" class="btn btn-outline-info <?php if(isset($_GET['reportValue']) && ($_GET['reportValue']) == 2){echo "active";}?>" href="admin.php?action=displayComments&reportValue=2">Commentaires validés</a>
        <a type="button" class="btn btn-outline-info <?php if(isset($_GET['reportValue']) && ($_GET['reportValue']) == 3){echo "active";}?>" href="admin.php?action=displayComments&reportValue=3">Commentaires en attente</a>
        <a type="button" class="btn btn-outline-info <?php if(isset($_GET['reportValue']) && ($_GET['reportValue']) == 1){echo "active";}?>" href="admin.php?action=displayComments&reportValue=1">Commentaires refusés</a>
    </div>
  </div>
</div>

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