<?php

namespace MaureenBruihier\Projet4\controller;

use \MaureenBruihier\Projet4\model\AdminManager;

class AuthController {
    protected $adminManager;

    public function __construct()
    {
        $this->adminManager = new AdminManager();
    }

    public function loginForm()
    {
        require('views/front/login.php');
    }

    public function loginPost()
    {
        $pseudo = $_POST['pseudo'];
        $pass = $_POST['password'];

        $resultat = $this->adminManager->login($pseudo);
        $isPasswordCorrect = password_verify($pass, $resultat['password']);

        if (!$resultat || false === $isPasswordCorrect) {
            $_SESSION['error'] = 'Identifiant ou mot de passe incorrect';
            header('Location: /login');
            exit;
        }
        
        unset($_SESSION['error']);
        $_SESSION['pseudo'] = $pseudo;
        header('Location: /admin/dashboard');
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
    }
}   