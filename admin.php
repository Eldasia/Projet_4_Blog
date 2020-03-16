<?php

require "vendor/autoload.php";

use \MaureenBruihier\Projet4\controller\PostsController;
use \MaureenBruihier\Projet4\controller\CommentsController;

try
{
    $postsController = new PostsController();
    $commentsController = new CommentsController();

    if (isset($_GET['action']))
    {
        if ($_GET['action'] == 'displayPosts')
        {
            $postsController->listPosts('true');
        }
        if ($_GET['action'] == 'displayComments')
        {
            $commentsController->listComments(1);
        }
        if ($_GET['action'] == 'deletePost')
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

        if ($_GET['action'] == 'createPost')
        {
            require('views/addPostView.php');
        }

        if ($_GET['action'] == 'addPost')
        {
            $postsController->addPost(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['author']), htmlspecialchars($_POST['content']));
        }

        if ($_GET['action'] == 'updatePost')
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
        require('views/adminView.php');
    }
}
catch (Exception $e)
{
    $errorMessage->getMessage();
}