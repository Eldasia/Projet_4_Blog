<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2 class="mr-1">Modifier un article :</h2>
    <p><a class="btn btn-primary m-1" style="max-height: 100px;" href="/adm/dashboard">Retour à l'interface administrateur</a></p>
  </div>

  <div class="card-body">
    <form action="/adm/updatePost/<?=$postToUpdate->getId()?>" method='post'>

        <label for="title">Titre :</label>
        <input type="text" name="title" required value="<?=$postToUpdate->getTitle()?>"/> <br />
        <?php if ($validation->hasError('title')) : ?>
          <span class="text-danger"><?= $validation->getError('title'); ?></span> </br>
        <?php endif; ?>

        <label for="content">Contenu :</label> <br />
        <textarea name="content" id="updateMytextarea"><?=$postToUpdate->getContent()?></textarea> <br />
        <?php if ($validation->hasError('content')) : ?>
          <span class="text-danger"><?= $validation->getError('content'); ?></span> </br>
        <?php endif; ?>

        <?= $token->input() ?>
        <?php if ($validation->hasError('_token')) : ?>
            <span class="text-danger"><?= $validation->getError('_token'); ?></span> </br>
        <?php endif; ?>

        <input type="submit" value="Modifier"/>
    </form>
  </div>
</div>

<script>
    tinymce.init({
      selector: '#updateMytextarea',
      menubar: 'hidden'
    });
</script>