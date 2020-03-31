<?php
require "vendor/autoload.php";

//use 
//use MaureenBruihier\Projet4\controller\CommentsController;

$router = new Akibatech\Router;

$router->get('/', 'MaureenBruihier\Projet4\controller\PostsController@listPosts');
$router->get('/{:num}', 'MaureenBruihier\Projet4\controller\PostsController@listPosts');
$router->post('/post/{:num}/comment', 'MaureenBruihier\Projet4\controller\CommentsController@addComment');
$router->get('/post/{:num}', 'MaureenBruihier\Projet4\controller\PostsController@displayPost');

$router->get('/post/{:num}/{:any}/{:num}', 'MaureenBruihier\Projet4\controller\CommentsController@moderateComment');

$router->whenNotFound(function () {
   var_dump($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
});

$router->listen();

exit;

/*try
{
    $postsController = new PostsController();
    $commentsController = new CommentsController();

    if (!isset($_GET['page']) OR empty($_GET['page'])) {
        $_GET['page'] = 1;
    }

    $firstPost = (intval($_GET['page'])-1)*5;

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
    
}

catch (Exception $e) 
{
    $errorMessage = $e->getMessage();
    require('views/errorView.php');
}
*/