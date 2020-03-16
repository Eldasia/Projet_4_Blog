<?php

namespace MaureenBruihier\Projet4\controller;

use Exception;
use \MaureenBruihier\Projet4\model\CommentManager;
use \MaureenBruihier\Projet4\model\entities\CommentEntity;

class CommentsController {

    protected $commentManager;
    
    public function __construct()
    {
        $this->commentManager = new CommentManager();
    }

    public function addCommment($postId, $title, $author, $content) {
        $commentToAdd = $this->commentManager->addComment($postId, $title, $author, $content);

        if ($commentToAdd == false) 
        {
            throw new \Exception('Votre commentaire n\'a pas pu être ajouté.');    
        }
        else 
        {
            header('Location: index.php?action=displayPost&id=' . $postId);
        }
    }

    public function listComments($reportValue)
    {
        $comments = $this->commentManager->getComments($reportValue);
        $listComments = array();
        while ($comment = $comments->fetch())
        {
            $tmp = new CommentEntity(['id'=>$comment['id'],'postId'=>$comment['post_id'], 'author'=>$comment['author'], 'title'=>$comment['title'], 'content'=>$comment['content'], 'creationDate'=>$comment['creation_date_fr'], 'reporting'=>$comment['reporting']]);
            array_push($listComments, $tmp);
        }
        require('views/adminListCommentsView.php');
    }

    public function moderateComment($actionComment, $commentId, $postId)
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
        $moderateComment = $this->commentManager->moderateComment($moderateValue, $commentId);

        if ($moderateComment == false)
        {
            throw new Exception('Le signalament n\'a pas pu être effectué');
        }
        else
        {
            header('Location: index.php?action=displayPost&id=' . $postId);
        }
    }
}