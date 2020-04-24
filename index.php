<?php

session_start();

require 'vendor/autoload.php';
require 'router.php';

try {
    $router->listen();
} catch (\Exception $e) {
    require 'views/error.php';
}