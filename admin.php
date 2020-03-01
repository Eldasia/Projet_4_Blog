<?php

require_once('controller/postsController.php');

try
{
    if (isset($_GET['action']))
    {

        if ($_GET['action'] == 'delete')
        {
            if (isset($_GET['id']) && $_GET['id'] >0) 
            {
                deletePost($_GET['id']);
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet valide.');
            }
        }

        if ($_GET['action'] == 'create')
        {
            require('views/addPostView.php');
        }

        if ($_GET['action'] == 'add')
        {
            addPost(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['author']), htmlspecialchars($_POST['content']));
        }

        if ($_GET['action'] == 'update')
        {
            if (isset($_GET['id']) && $_GET['id'] >0) 
            {
                displayPost($_GET['id'], 'true');
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet valide.');
            }
        }

        if ($_GET['action'] == 'save')
        {
            if (isset($_GET['id']) && $_GET['id'] >0) 
            {
                UpdatePost($_GET['id'], htmlspecialchars($_POST['title']), htmlspecialchars($_POST['content']));
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet valide.');
            }
        }
    }
    else 
    {
        listPosts('true');
    }
}
catch (Exception $e)
{
    $errorMessage->getMessage();
}