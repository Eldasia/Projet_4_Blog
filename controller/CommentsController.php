<?php

namespace MaureenBruihier\Projet4\controller;

use \MaureenBruihier\Projet4\model\CommentManager;
use \MaureenBruihier\Projet4\lib\Validation;

class CommentsController {

    protected $commentManager;
    
    public function __construct()
    {
        $this->commentManager = new CommentManager();
    }

    public function add($postId) {
        $author = $_POST['author'];
        $content = $_POST['content'];

        $inputWithoutHTML = ['author' => strip_tags($author), 'content' => strip_tags($content)];

        $validation = Validation::make($inputWithoutHTML, [
            'author' => [
                'required',
                'min:6',
                'max:100',
            ],
            'content' => [
                'required',
                'min:10',
                'max:3000',
            ],
        ]);

        if ($validation->isValid() == false) 
        {
            header('Location: /post/' . $postId);
        } 

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