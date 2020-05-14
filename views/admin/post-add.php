<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mr-1">Ajouter un article :</h2>
    <a class="btn btn-primary m-1" style="max-height: 90px;" href="/adm/dashboard">Retour à l'interface administrateur</a>
  </div>
  
  <div class="card-body">
    <form action="/adm/addPost" method='post'>
      <div class="form-group">
        <label for="title">Titre :</label>
        <input type="text" name="title" class="form-control" value="<?= $validation->getOldValue('title') ?>" required/>
        <?php if ($validation->hasError('title')) : ?>
          <span class="text-danger"><?= $validation->getError('title'); ?></span>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="content">Contenu :</label> <br />
        <textarea name="content" id="addMytextarea"><?= $validation->getOldValue('content') ?></textarea> <br />
        <?php if ($validation->hasError('content')) : ?>
          <span class="text-danger"><?= $validation->getError('content'); ?></span>
        <?php endif; ?>
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