<?php

session_start();

require 'vendor/autoload.php';
require 'routes.php';

try {
    $reponse = $router->listen();
    echo $reponse;
} catch (\Exception $e) {
    echo MaureenBruihier\Projet4\lib\View::make('error', [ 
        'title' => 'Erreur serveur',
        'e' => $e,
        ]);
}