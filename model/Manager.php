<?php

namespace MaureenBruihier\Projet4\model;

class Manager
{
    protected $db;

    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    public function db()
    {
        return $this->db;
    }

    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog_ecrivain;charset=utf8', 'root');
        return $db;
    }
}