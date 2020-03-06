<?php

use MaureenBruihier\Projet4\controller\PostsController;
use MaureenBruihier\Projet4\controller\CommentsController;

require_once('controller/PostsController.php');
require_once('controller/CommentsController.php');

try
{
    $postsController = new PostsController();
    $commentsController = new CommentsController();

    if (isset($_GET['action'])) 
    {
        if ($_GET['action'] == 'listPosts')
        {
            $postsController->listPosts('false');
        }   
        elseif ($_GET['action'] == 'displayPost') 
        {
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                $commentsController->listComments($_GET['id']);
                $postsController->displayPost($_GET['id'], 'false');
            } 
            else 
            {
                throw new Exception('Aucun identifiant de billet valide.');
            }
        }
        else if ($_GET['action'] == 'addComment')
        {
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                $commentsController->addCommment($_GET['id'], $_POST['title'], $_POST['author'], $_POST['content']);
            }
            else
            {
                throw new Exception('Aucun identifiant de billet valide.');
            }
        }
    } 
    else 
    {
        $postsController->listPosts('false');
    }
    
}

catch (Exception $e) 
{
    $errorMessage = $e->getMessage();
}
