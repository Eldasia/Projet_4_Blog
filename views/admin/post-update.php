<?php $title = "Modifier un article"; ?>

<?php ob_start(); ?>
<h1>Ajouter un article :</h1>
<p><a href="admin.php">Retour à l'interface administrateur</a></p>

<form action="/adm/updatePost/<?=$postToDisplay->getId()?>" method='post'>
    <label for="title">Titre :</label>
    <input type="text" name="title" required value="<?=$postToDisplay->getTitle()?>"/> <br />
    <label for="content">Contenu :</label> <br />
    <textarea name="content" id="updateMytextarea"><?=$postToDisplay->getContent()?></textarea> <br />
    <input type="submit" value="Modifier"/>
</form>

<script>
    tinymce.init({
      selector: '#updateMytextarea',
      menubar: 'hidden'
    });
</script>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>