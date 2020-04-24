<?php

namespace MaureenBruihier\Projet4\model;

class Manager
{
    protected $db;

    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog_maureen;charset=utf8', 'root', 'root');
        return $db;
    }
}