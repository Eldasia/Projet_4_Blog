<?php

namespace MaureenBruihier\Projet4\controller;

use \MaureenBruihier\Projet4\model\CommentManager;
use \MaureenBruihier\Projet4\model\entities\CommentEntity;

require_once('model/CommentManager.php');
require_once('model/entities/CommentEntity.php');

class CommentsController {
    
    public function addCommment($postId, $title, $author, $content) {
        $commentManager = new CommentManager();
        $commentToAdd = $commentManager->addComment($postId, $title, $author, $content);

        if ($commentToAdd == false) 
        {
            throw new \Exception('Votre commentaire n\'a pas pu être ajouté.');    
        }
        else 
        {
            header('Location: index.php?action=displayPost');
        }
    }
}