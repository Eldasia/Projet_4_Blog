<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2>Ajouter un article :</h2>
    <a class="btn btn-primary" href="/adm/dashboard">Retour à l'interface administrateur</a>
  </div>
  
  <div class="card-body">
    <form action="/adm/addPost" method='post'>
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