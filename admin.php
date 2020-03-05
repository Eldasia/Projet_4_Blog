<?php

require_once('controller/PostsController.php');

try
{
    $postsController = new PostsController();

    if (isset($_GET['action']))
    {

        if ($_GET['action'] == 'delete')
        {
            if (isset($_GET['id']) && $_GET['id'] >0) 
            {
                $postsController->deletePost($_GET['id']);
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
            $postsController->addPost(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['author']), htmlspecialchars($_POST['content']));
        }

        if ($_GET['action'] == 'update')
        {
            if (isset($_GET['id']) && $_GET['id'] >0) 
            {
                $postsController->displayPost($_GET['id'], 'true');
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet valide.');
            }
        }

        if ($_GET['action'] == 'save')
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                $postsController->UpdatePost($_GET['id'], htmlspecialchars($_POST['title']), htmlspecialchars($_POST['content']));
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet valide.');
            }
        }
    }
    else 
    {
        $postsController->listPosts('true');
    }
}
catch (Exception $e)
{
    $errorMessage->getMessage();
}