<?php

namespace MaureenBruihier\Projet4\controller;

use \MaureenBruihier\Projet4\model\CommentManager;
use \MaureenBruihier\Projet4\model\PostManager;
use \MaureenBruihier\Projet4\model\entities\PostEntity;
use \MaureenBruihier\Projet4\model\entities\CommentEntity;

class PostsController {

    protected $postManager;
    
    public function __construct()
    {
        $this->postManager = new PostManager();
    }

    public function list()
    {
        $posts = $this->postManager->getPosts();
        $listPosts = array();

        while ($post = $posts->fetch()) {
            $tmp = new PostEntity([ 'id'=>$post['id'], 'title'=>$post['title'], 'content'=>$post['content'], 'creationDate'=>$post['creation_date_fr'], 'changeDate'=>$post['change_date_fr']]);
            array_push($listPosts, $tmp);
        }

        require('views/front/posts.php');
    }

    public function show($postId) 
    {   
        $post = $this->postManager->getPost($postId);
        $postToDisplay = new PostEntity([
            'id'=>$post['id'],
            'title'=>$post['title'],
            'content'=>$post['content'],
            'creationDate'=>$post['creation_date_fr'],
            'changeDate'=>$post['change_date_fr']
        ]);
        
        $commentManager = new CommentManager();
        $comments = $commentManager->getCommentsPost($postId);
        $listComments = array();

        while ($comment = $comments->fetch())
        {
            $tmp = new CommentEntity(['id'=>$comment['id'],'postId'=>$comment['post_id'], 'author'=>$comment['author'], 'content'=>$comment['content'], 'creationDate'=>$comment['creation_date_fr'], 'reporting'=>$comment['reporting']]);
            array_push($listComments, $tmp);
        }

        require('views/front/post-show.php');
    }
}