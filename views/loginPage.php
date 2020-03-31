<?php $title = "Connexion"; ?>

<?php ob_start(); ?>

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2>Connexion</h2>
    <a class="btn btn-primary" href="index.php">Retour à la page d'accueil</a>
  </div>
  <div class="card-body">
    <form action="admin.php?action=login" method='post'>
      <div class="form-group">
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" required/>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe :</label> 
        <input type="password" name="password" required/>
      </div>
      <button class="btn btn-primary" type="submit">Connexion</button>
    </form>
  </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>