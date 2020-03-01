<?php

require_once('controller/postsController.php');

try
{
    if (isset($_GET['action'])) 
    {
        if ($_GET['action'] == 'listPosts')
        {
            listPosts('false');
        }   
        elseif ($_GET['action'] == 'displayPost') 
        {
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                displayPost($_GET['id'], 'false');
            } 
            else 
            {
                throw new Exception('Aucun identifiant de billet valide.');
            }
        }
    } 
    else 
    {
        listPosts('false');
    }
    
}

catch (Exception $e) 
{
    $errorMessage = $e->getMessage();
}
