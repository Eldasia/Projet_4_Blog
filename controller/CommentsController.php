<?php

namespace MaureenBruihier\Projet4\controller;

use \MaureenBruihier\Projet4\model\CommentManager;
use \MaureenBruihier\Projet4\model\entities\CommentEntity;

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
            header('Location: index.php?action=displayPost&id=' . $postId);
        }
    }

    public function listComments(int $postId)
    {
        $commentManager = new CommentManager();
        $comments = $commentManager->getComments($postId);
        $listComments = array();
        while ($comment = $comments->fetch())
        {
            $tmp = new CommentEntity(['id'=>$comment['id'],'postId'=>$comment['post_id'], 'author'=>$comment['author'], 'title'=>$comment['title'], 'content'=>$comment['content'], 'creationDate'=>$comment['creation_date_fr'], 'reporting'=>$comment['reporting']]);
            array_push($listComments, $tmp);
        }
        
        return $listComments;
    }

    public function moderateComment($actionComment, $commentId)
    {
        $commentManager = new CommentManager();
        if (isset($actionComment))
        {
            switch ($actionComment) {
                case 'validate':
                    $moderateValue = 0;
                    break;
                case 'report':
                    $moderateValue = 1;
                    break;
                case 'refuse':
                    $moderateValue = -1;
                    break;
            }
        }
    }
}