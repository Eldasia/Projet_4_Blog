<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2>Modifier un article :</h2>
    <p><a class="btn btn-primary" href="/adm/dashboard">Retour à l'interface administrateur</a></p>
  </div>

  <div class="card-body">
    <form action="/adm/updatePost/<?=$postToUpdate->getId()?>" method='post'>
        <label for="title">Titre :</label>
        <input type="text" name="title" required value="<?=$postToUpdate->getTitle()?>"/> <br />
        <label for="content">Contenu :</label> <br />
        <textarea name="content" id="updateMytextarea"><?=$postToUpdate->getContent()?></textarea> <br />
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