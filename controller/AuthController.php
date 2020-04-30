<?php

namespace MaureenBruihier\Projet4\controller;

use \MaureenBruihier\Projet4\model\AdminManager;
use \MaureenBruihier\Projet4\lib\View;

class AuthController {
    protected $adminManager;

    public function __construct()
    {
        $this->adminManager = new AdminManager();
    }

    public function loginForm()
    {
        return View::make('front/login', [
            'title' => 'Connexion',
        ]);
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
        header('Location: /adm/dashboard');
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
    }
}   