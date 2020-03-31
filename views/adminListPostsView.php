<?php $title = "Interface administrateur"; ?>

<?php ob_start(); ?>

<a class="btn btn-primary mt-4" href="admin.php">Retour à l'interface d'administration</a>

<p class="text-center m-4 display-3">Les articles</p>

<div class="d-flex flex-row-reverse">
  <a class="btn btn-outline-success" href="admin.php?action=createPost">Ajouter un article</a>
</div>

<table class="table mt-3">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Date de création</th>
      <th scope="col">Date de modification</th>
      <th scope="col" colspan=2>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listPosts as $post) : ?>
        <tr>
            <td><?=$post->getTitle()?></td>
            <td><?=$post->getCreationDate()?></td>
            <td><?=$post->getChangeDate()?></td>
            <td><a class="btn btn-outline-primary" href="admin.php?action=updatePost&id=<?=$post->getId()?>">Modifier</a></td>
            <td><a class="btn btn-outline-danger" href=# onclick="AreYouSure('delete', 'admin.php?action=deletePost&id=<?=$post->getId()?>')">Supprimer</a></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group mr-2" role="group">
    <?php for ($i = 1; $i <= $nb_page_posts; $i++): ?>
        <a type="button" href="admin.php?action=displayPosts&page=<?= $i ?>" class="btn btn-secondary"><?= $i ?></a>
    <?php endfor; ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>