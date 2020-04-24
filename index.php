<?php

session_start();

require 'vendor/autoload.php';
require 'router.php';

try {
    $router->listen();
} catch (\Exception $e) {
    require 'views/error.php';
}
/*
use MaureenBruihier\Projet4\controller\PostsController;
use MaureenBruihier\Projet4\controller\CommentsController;

    if (isset($_GET['action'])) 
    {
        if ($_GET['action'] == 'listPosts')
        {
            $postsController->listPosts($firstPost, 'false');
        }   
        elseif ($_GET['action'] == 'displayPost') 
        {
            if (isset($_GET['id']) && ($_GET['id'] > 0))
            {
                if(isset($_GET['commentId']) && ($_GET['commentId'] > 0))
                {
                    if (isset($_GET['actionComment']) && !empty($_GET['actionComment']))
                    {
                        $commentsController->moderateComment($_GET['actionComment'], $_GET['commentId'], $_GET['id']);
                    }
                    else
                    {
                        throw new Exception('Aucune action valide.');
                    }
                }
                else
                {$postsController->displayPost($_GET['id'], 'false');}
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
                $commentsController->addCommment($_GET['id'], $_POST['author'], $_POST['content']);
            }
            else
            {
                throw new Exception('Aucun identifiant de billet valide.');
            }
        }
    } 
    else 
    {
        $postsController->listPosts($firstPost, 'false');
    }
    $errorMessage = $e->getMessage();
    require('views/errorView.php');
