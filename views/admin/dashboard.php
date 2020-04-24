<?php $title = "Interface administrateur"?>

<?php ob_start(); ?>

<div class="d-flex justify-content-between">
    <h2 class="mb-0">Interface admin</h2>
    <a href="/" class="btn btn-primary">Retour au site</a>
</div>

<div class="card my-4">
    <div class="card-body">
        <a class="btn btn-lg btn-outline-info btn-block" href="/adm/posts">Les articles</a>
        <a class="btn btn-lg btn-outline-info btn-block" href="/adm/comments">Les commentaires</a>
    </div>
</div>

<?php $content = ob_get_clean();

require('views/template.php'); ?>