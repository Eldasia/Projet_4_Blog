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

    public function list($reportValue = 5)
    {
        if ($reportValue == 5)
        {
            $comments = $this->commentManager->getComments();
        }
        elseif (0 < $reportValue && $reportValue < 4)
        {
            $comments = $this->commentManager->getCommentsReport($reportValue);
        }
        else
        {
            throw new \Exception('Aucune valeur de signalement valide.');
        }
        $listComments = array();
        while ($comment = $comments->fetch())
        {
            $tmp = new CommentEntity(['id'=>$comment['id'],'postId'=>$comment['post_id'], 'author'=>$comment['author'], 'content'=>$comment['content'], 'creationDate'=>$comment['creation_date_fr'], 'reporting'=>$comment['reporting']]);
            array_push($listComments, $tmp);
        }
        require('views/adminListCommentsView.php');
    }

    public function moderateComment($actionComment, $commentId, $postId = null)
    {
        switch ($actionComment) {
            case 'validate':
                $moderateValue = 2;
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