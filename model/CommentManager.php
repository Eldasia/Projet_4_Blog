<?php

namespace MaureenBruihier\Projet4\model;

use MaureenBruihier\Projet4\model\Manager;

class CommentManager extends Manager
{

    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    public function getCommentsPost($postId)
    {
        $req = $this->db->prepare('SELECT id, post_id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, reporting FROM comments  WHERE post_id = ? AND reporting = ? ORDER BY creation_date DESC');
        $req->execute(array($postId, 2));

        return $req;
    }

    public function getComments()
    {
        $req = $this->db->query('SELECT id, post_id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, reporting FROM comments ORDER BY reporting DESC, creation_date DESC');

        return $req;
    }

    public function getCommentsReport($reportValue)
    {
        $req = $this->db->prepare('SELECT id, post_id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, reporting FROM comments WHERE reporting = ? ORDER BY creation_date DESC');
        $req->execute(array($reportValue));

        return $req;
    }

    public function addComment($postId, $author, $content)
    {
        $req = $this->db->prepare('INSERT INTO comments(post_id, author, content, creation_date) VALUES(?, ?, ?, now())');
        $req->execute(array($postId, $author, $content));

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

        return $req;
    }
}