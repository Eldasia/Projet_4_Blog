<?php

namespace MaureenBruihier\Projet4\model;

use MaureenBruihier\Projet4\model\Manager;

class AdminManager extends Manager
{
    public function login($pseudo)
    {
        $req = $this->db->prepare('SELECT password FROM admin WHERE pseudo = :pseudo LIMIT 1');
        $req->execute(array('pseudo' => $pseudo));
        $resultat = $req->fetch();

        return $resultat;
    }
}