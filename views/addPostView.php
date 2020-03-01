<?php $title = "Ajouter un article"; ?>

<?php ob_start(); ?>
<h1>Ajouter un article :</h1>
<p><a href="admin.php">Retour à l'interface administrateur'</a></p>

<form action="admin.php?action=add" method='post'>
    <label for="title">Titre :</label>
    <input type="text" name="title" required/> <br />
    <label for="author">Auteur :</label>
    <input type="text" name="author" required /> <br />
    <label for="content">Contenu :</label> <br />
    <textarea name="content" required></textarea> <br />
    <input type="submit" value="Ajouter"/>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>