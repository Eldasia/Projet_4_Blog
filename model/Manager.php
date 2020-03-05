<?php

namespace MaureenBruihier\Projet4\model;

class Manager
{
    protected $db;

    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog_ecrivain;charset=utf8', 'root');
        return $db;
    }
}