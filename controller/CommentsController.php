<?php

namespace MaureenBruihier\Projet4\controller;

use \MaureenBruihier\Projet4\model\CommentManager;
use \MaureenBruihier\Projet4\model\entities\CommentEntity;

class CommentsController {

    protected $commentManager;
    
    public function __construct()
    {
        $this->commentManager = new CommentManager();
    }

    public function add($postId) {
        $author = $_POST['author'];
        $content = $_POST['content'];

        $commentToAdd = $this->commentManager->addComment($postId, $author, $content);

        if ($commentToAdd == false) 
        {
            throw new \Exception('Votre commentaire n\'a pas pu être ajouté.');    
        }
        else 
        {
            header('Location: /post/' . $postId);
        }
    }
    
    public function report($postId, $commentId)
    {

        $moderateComment = $this->commentManager->moderateComment(3, $commentId);

        if ($moderateComment == false) {
            throw new \Exception('Le signalement n\'a pas pu être effectué');
        } else {
            header('Location: /post/' . $postId);
        }
    }
}