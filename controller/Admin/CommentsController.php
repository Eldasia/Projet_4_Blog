<?php

namespace MaureenBruihier\Projet4\controller\Admin;

use \MaureenBruihier\Projet4\model\CommentManager;
use \MaureenBruihier\Projet4\model\entities\CommentEntity;
use \MaureenBruihier\Projet4\lib\View;

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
        return View::make('admin/comments', [
            'title' => 'Interface administrateur',
            'listComments' => $listComments,
        ]);
    }

    public function validate($commentId) {
        
        $moderateComment = $this->commentManager->moderateComment(2, $commentId);

        if ($moderateComment == false)
        {
            throw new \Exception('La validation n\'a pas pu être effectué');
        }
        else
        {
            header('Location: /adm/comments');
        }
    }


    public function refuse($commentId)
    {
        $moderateComment = $this->commentManager->moderateComment(1, $commentId);

        if ($moderateComment == false)
        {
            throw new \Exception('Le refus n\'a pas pu être effectué');
        }
        else
        {
            header('Location: /adm/comments');
        }
    }
}