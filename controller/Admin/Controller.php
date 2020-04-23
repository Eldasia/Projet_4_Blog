<?php

namespace MaureenBruihier\Projet4\controller\Admin;

class Controller
{   
    public function __construct()
    {
        if (empty($_SESSION['pseudo'])) {
            header('Location: /login');
            exit;
        }
    }
}
