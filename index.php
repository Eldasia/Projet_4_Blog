<?php

session_start();

require 'vendor/autoload.php';
require 'routes.php';

try {
    $reponse = $router->listen();
    echo $reponse;
} catch (\Exception $e) {
    require 'views/error.php';
}