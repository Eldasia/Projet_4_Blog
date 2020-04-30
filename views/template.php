<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdn.tiny.cloud/1/72khf6of521084hk0sf61yrrmljnp9bboh7cfh2p6u33p3g4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    </head>
        
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3 shadow-lg">
        <div class="container d-flex justify-space-between">
            <a href="/" class="navbar-brand">Jean Forteroche</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['pseudo'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/adm/dashboard">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Déconnexion</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Connexion</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
        <div class="container">
            <?= $content ?>
        </div>
        <script src="../public/js/AreYouSure.js"></script>
    </body>
</html>