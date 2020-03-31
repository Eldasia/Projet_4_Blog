<?php

namespace MaureenBruihier\Projet4\model;

use MaureenBruihier\Projet4\model\Manager;

class PostManager extends Manager
{

    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    public function getPosts($firstPost)
    {

        $req = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(change_date, \'%d/%m/%Y à %Hh%imin%ss\') AS change_date_fr FROM posts ORDER BY creation_date DESC LIMIT :firstPost, 5');
        $req->bindParam(':firstPost', $firstPost, \PDO::PARAM_INT);
        $req->execute();
        
        return $req;
    }

    public function getPost($postId)
    {
        $req = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(change_date, \'%d/%m/%Y à %Hh%imin%ss\') AS change_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function addPost($title, $content)
    {
        $req = $this->db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, now())');
        $req->execute(array($title, $content));

        return $req;
    }

    public function updatePost($postId, $title, $content)
    {
        $req = $this->db->prepare('UPDATE posts SET title = ?, content = ?, change_date = now() WHERE id = ?');
        $req->execute(array($title, $content, $postId));

        return $req;
    }

    public function deletePost($postId) 
    {
        $req = $this->db->prepare('DELETE FROM posts WHERE id = ?');
        $req->execute(array($postId));

        return $req;
    }
    
    public function countPosts() 
    {
        $req = $this->db->query('SELECT COUNT(*) AS nb_posts FROM posts');
        $nb_posts = $req -> fetch();

        $req->closeCursor();
        
        return $nb_posts;
    }
}