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

    public function addCommment($postId, $author, $content) {
        $commentToAdd = $this->commentManager->addComment($postId, $author, $content);

        if ($commentToAdd == false) 
        {
            throw new \Exception('Votre commentaire n\'a pas pu être ajouté.');    
        }
        else 
        {
            header('Location: index.php?action=displayPost&id=' . $postId);
        }
    }
    
    public function moderateComment($actionComment, $commentId, $postId = null)
    {
        switch ($actionComment) {
            case 'validate':
                $moderateValue = 2;
                break;
            case 'report':
                $moderateValue = 3;
                break;
            case 'refuse':
                $moderateValue = 1;
                break;
        }
        $moderateComment = $this->commentManager->moderateComment($moderateValue, $commentId);

        if ($moderateComment == false)
        {
            throw new \Exception('Le signalement n\'a pas pu être effectué');
        }
        else if ($postId == null)
        {
            header('Location: admin.php?action=displayComments');
        }
        else
        {
            header('Location: index.php?action=displayPost&id=' . $postId);
        }
    }
}