<?php

namespace MaureenBruihier\Projet4\model;

use MaureenBruihier\Projet4\model\Manager;

class CommentManager extends Manager
{

    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    public function getComments(int $postId)
    {
        $req = $this->db->prepare('SELECT id, post_id, author, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, reporting FROM comments  WHERE post_id = ? AND reporting = ? ORDER BY creation_date DESC');
        $req->execute(array($postId, 0));

        return $req;
    }

    public function addComment($postId, $title, $author, $content)
    {
        $req = $this->db->prepare('INSERT INTO comments(post_id, title, author, content, creation_date) VALUES(?, ?, ?, ?, now())');
        $req->execute(array($postId, $title, $author, $content));

        return $req;
    }

    public function deleteComment($commentId) {
        $req = $this->db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($commentId));

        return $req;
    }

    public function moderateComment($moderateValue, $commentId) {
        $req = $this->db->prepare('UPDATE comments SET reporting = ? WHERE id = ?');
        $req->execute(array($moderateValue, $commentId));
    }
}