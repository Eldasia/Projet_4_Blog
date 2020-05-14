<?php
use MaureenBruihier\Projet4\lib\View;

$router = new MaureenBruihier\Projet4\lib\Router;

// Routes publiques
$router->get('/', 'MaureenBruihier\Projet4\controller\PostsController@list', 'home');
$router->get('/{:num}', 'MaureenBruihier\Projet4\controller\PostsController@list');
$router->get('/post/{:num}', 'MaureenBruihier\Projet4\controller\PostsController@show', 'post.show');
$router->get('/post/{:num}/report/{:num}', 'MaureenBruihier\Projet4\controller\CommentsController@report', 'comment.report');
$router->post('/post/{:num}/addComment', 'MaureenBruihier\Projet4\controller\CommentsController@add', 'comment.add');

// Routes connexion / déconnexion
$router->get('/login', 'MaureenBruihier\Projet4\controller\AuthController@loginForm');
$router->post('/login', 'MaureenBruihier\Projet4\controller\AuthController@loginPost');
$router->get('/logout', 'MaureenBruihier\Projet4\controller\AuthController@logout');

// Routes admins
$router->get('/adm/dashboard', 'MaureenBruihier\Projet4\controller\Admin\AdminController@dashboard');

$router->get('/adm/posts', 'MaureenBruihier\Projet4\controller\Admin\PostsController@list');
$router->get('/adm/posts/{:num}', 'MaureenBruihier\Projet4\controller\Admin\PostsController@list');
$router->get('/adm/addPost', 'MaureenBruihier\Projet4\controller\Admin\PostsController@addForm');
$router->post('/adm/addPost', 'MaureenBruihier\Projet4\controller\Admin\PostsController@add');
$router->get('/adm/updatePost/{:num}', 'MaureenBruihier\Projet4\controller\Admin\PostsController@updateForm');
$router->post('/adm/updatePost/{:num}', 'MaureenBruihier\Projet4\controller\Admin\PostsController@update');
$router->get('/adm/deletePost/{:num}', 'MaureenBruihier\Projet4\controller\Admin\PostsController@delete');

$router->get('/adm/comments', 'MaureenBruihier\Projet4\controller\Admin\CommentsController@list');
$router->get('/adm/comments?reportValue={:num}', 'MaureenBruihier\Projet4\controller\Admin\CommentsController@list');
$router->get('/adm/comments/{:num}/validate', 'MaureenBruihier\Projet4\controller\Admin\CommentsController@validate');
$router->get('/adm/comments/{:num}/refuse', 'MaureenBruihier\Projet4\controller\Admin\CommentsController@refuse');

// Route par défaut
$router->whenNotFound(function () {
    return View::make('404', [ 'title' => 'Erreur 404']);
});