<?php

require_once('controller/PostsController.php');

try
{
    $postsController = new PostsController();

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
                $postsController->displayPost($_GET['id'], 'false');
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
