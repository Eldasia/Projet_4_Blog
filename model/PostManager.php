<?php

namespace MaureenBruihier\Projet4\model;

require_once("Manager.php");

class PostManager extends Manager
{
    protected $db;

    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    public function getPosts()
    {
        $req = $this->db->query('SELECT id, author, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(change_date, \'%d/%m/%Y à %Hh%imin%ss\') AS change_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId)
    {
        $req = $this->db->prepare('SELECT id, author, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(change_date, \'%d/%m/%Y à %Hh%imin%ss\') AS change_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function addPost($title, $author, $content)
    {
        $req = $this->db->prepare('INSERT INTO posts(title, author, content, creation_date) VALUES(?, ?, ?, now())');
        $req->execute(array($title, $author, $content));

        return $req;
    }

    public function updatePost($postId, $title, $content)
    {
        $req = $this->db->prepare('UPDATE posts SET title = ?, content = ?, change_date = now() WHERE id = ?');
        $req->execute(array($title, $content, $postId));

        return $req;
    }

    public function deletePost($postId) {
        $req = $this->db->prepare('DELETE FROM posts WHERE id = ?');
        $req->execute(array($postId));

        return $req;
    }
}