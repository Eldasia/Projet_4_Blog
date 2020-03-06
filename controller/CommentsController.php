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
}