<?php

$router = new Akibatech\Router;

// Routes publiques
$router->get('/', 'MaureenBruihier\Projet4\controller\PostsController@list', 'home');
$router->get('/post/{:num}', 'MaureenBruihier\Projet4\controller\PostsController@show', 'post.show');

// Routes connexion / déconnexion
$router->get('/login', 'MaureenBruihier\Projet4\controller\AuthController@loginForm');
$router->post('/login', 'MaureenBruihier\Projet4\controller\AuthController@loginPost');
$router->get('/logout', 'MaureenBruihier\Projet4\controller\AuthController@logout');

// Routes admins
$router->get('/admin/dashboard', 'MaureenBruihier\Projet4\controller\Admin\AdminController@dashboard');

// Route par défaut
$router->whenNotFound(function () {
    require('views/404.php');
});