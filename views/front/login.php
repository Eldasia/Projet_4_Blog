<div class="card mt-5">
  <div class="card-header d-flex justify-content-between">
    <h2>Connexion</h2>
    <a class="btn btn-primary ml-3" href="/">Retour à la page d'accueil</a>
  </div>
  <div class="card-body">
    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
    <?php endif; ?>

    <form action="/login" method="POST">
      <div class="row">
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" class="form-control" required/>
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label for="password">Mot de passe :</label> 
            <input type="password" name="password" class="form-control" required/>
          </div>
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Connexion</button>
    </form>
  </div>
</div>