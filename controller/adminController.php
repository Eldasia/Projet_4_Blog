<?php

namespace MaureenBruihier\Projet4\controller;

use \MaureenBruihier\Projet4\model\AdminManager;

class AdminController {
    protected $adminManager;

    public function __construct()
    {
        $this->adminManager = new AdminManager();
    }

    public function login($pseudo, $password) {

        $resultat = $this->adminManager->login($pseudo);
        $isPasswordCorrect = password_verify($password, $resultat['password']);

        if (!$resultat) {
            throw new \Exception('Identifiant ou mot de passe incorect');
        } else {
            if ($isPasswordCorrect) {
                $_SESSION['pseudo'] = $pseudo;
                header('Location: admin.php');
            }
            else {
                throw new \Exception('Identifiant ou mot de passe incorect');
            }
        }
    }
}   