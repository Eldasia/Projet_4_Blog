<?php

$router = new Akibatech\Router;

// Routes publiques
$router->get('/', 'MaureenBruihier\Projet4\controller\PostsController@list', 'home');
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
$router->get('/adm/comments', 'MaureenBruihier\Projet4\controller\Admin\CommentsController@list');

// Route par défaut
$router->whenNotFound(function () {
    require('views/404.php');
});