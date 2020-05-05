<p><a class="btn btn-primary mt-4" href="/adm/dashboard">Retour à l'interface d'administration</a></p>

<h1 class="text-center mb-4">Les commentaires</h1>

<div class="row">
  <div class="col-md-12 text-center">
    <div class="mb-2">
        <a type="button" class="m-1 btn btn-outline-info <?php if(!isset($_GET['reportValue']) || (empty($_GET['reportValue']))){echo "active";}?>" href="/adm/comments">Tous les commentaires</a>
        <a type="button" class="m-1 btn btn-outline-info <?php if(isset($_GET['reportValue']) && ($_GET['reportValue']) == 2){echo "active";}?>" href="/adm/comments?reportValue=2">Commentaires validés</a>
        <a type="button" class="m-1 btn btn-outline-info <?php if(isset($_GET['reportValue']) && ($_GET['reportValue']) == 3){echo "active";}?>" href="/adm/comments?reportValue=3">Commentaires en attente</a>
        <a type="button" class="m-1 btn btn-outline-info <?php if(isset($_GET['reportValue']) && ($_GET['reportValue']) == 1){echo "active";}?>" href="/adm/comments?reportValue=1">Commentaires refusés</a>
    </div>
  </div>
</div>

<div class="table-responsive-sm">
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
          <td><a href="/adm/comments/<?= $comment->getId()?>/validate" class="btn <?php if($comment->getReporting() == 2){echo "disabled btn-outline-secondary";}else{echo "btn-outline-success";}?>">Valider</a></td>
          <td><a href="/adm/comments/<?= $comment->getId()?>/refuse" class="btn <?php if($comment->getReporting() == 1){echo "disabled btn-outline-secondary";}else{echo "btn-outline-danger";}?>">Refuser</a></td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>