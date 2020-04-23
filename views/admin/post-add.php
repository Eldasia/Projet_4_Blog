<?php $title = "Ajouter un article"; ?>

<?php ob_start(); ?>

<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2>Ajouter un article :</h2>
    <a class="btn btn-primary" href="admin.php">Retour à l'interface administrateur</a>
  </div>
  <div class="card-body">
    <form action="admin.php?action=addPost" method='post'>
      <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" name="title" required/> <br />
      </div>
      <div class="form-group">
        <label for="content">Contenu :</label> <br />
        <textarea name="content" id="addMytextarea"></textarea> <br />
      </div>
      <button class="btn btn-primary" type="submit">Ajouter</button>
    </form>
  </div>
</div>

<script>
    tinymce.init({
      selector: '#addMytextarea',
      menubar: 'hidden'
    });
  </script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>