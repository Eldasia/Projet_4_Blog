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

    public function listPosts($firstPost, $isAdmin)
    {
        $nb_page_posts = $this->nbPage();
        $posts = $this->postManager->getPosts($firstPost);
        $listPosts = array();

        while ($post = $posts->fetch())
        {
            $tmp = new PostEntity([ 'id'=>$post['id'], 'author'=>$post['author'], 'title'=>$post['title'], 'content'=>$post['content'], 'creationDate'=>$post['creation_date_fr'], 'changeDate'=>$post['change_date_fr']]);
            array_push($listPosts, $tmp);
        }
        if ($isAdmin == 'false') 
        {
            require('views/listPostsView.php');
        } 
        elseif ($isAdmin == 'true') 
        {
            require('views/adminListPostsView.php');
        }
        else 
        {
            throw new \Exception('Argument invalide.');
        }
        
    }

    public function displayPost($postId, $isAdmin) 
    {   
        $post = $this->postManager->getPost($postId);
        $postToDisplay = new PostEntity([ 'id'=>$post['id'], 'author'=>$post['author'], 'title'=>$post['title'], 'content'=>$post['content'], 'creationDate'=>$post['creation_date_fr'], 'changeDate'=>$post['change_date_fr']]);
        
        if ($isAdmin == 'false') 
        {
            $commentManager = new CommentManager();
            $comments = $commentManager->getCommentsPost($postId);
            $listComments = array();
            while ($comment = $comments->fetch())
            {
                $tmp = new CommentEntity(['id'=>$comment['id'],'postId'=>$comment['post_id'], 'author'=>$comment['author'], 'title'=>$comment['title'], 'content'=>$comment['content'], 'creationDate'=>$comment['creation_date_fr'], 'reporting'=>$comment['reporting']]);
                array_push($listComments, $tmp);
            }
            require('views/displayPostView.php');
        }
        elseif ($isAdmin == 'true')
        {
            require('views/updatePostView.php');
        }
        else
        {
            throw new \Exception('Argument invalide');
        }
    }

    public function addPost($title, $author, $content)
    {
        $postToAdd = $this->postManager->addPost($title, $author, $content);

        if ($postToAdd == false) 
        {
            throw new \Exception('Votre article n\'a pas pu être ajouté.');    
        }
        else 
        {
            header('Location: admin.php?result=3');
        }
    }

    public function updatePost($postId, $title, $content)
    {
        $postToUpdate = $this->postManager->updatePost($postId, $title, $content);

        if ($postToUpdate == false) 
        {
            throw new \Exception('Votre article n\'a pas pu être modifié.');    
        }
        else 
        {
            header('Location: admin.php?result=1');
        }
    }

    public function deletePost($postId)
    {
        $postToDelete = $this->postManager->deletePost($postId);

        if ($postToDelete == false) 
        {
            throw new \Exception('Votre article n\'a pas pu être supprimé.');    
        }
        else 
        {
            header('Location: admin.php?result=2');
        }
    }

    public function nbPage() 
    {
        $nb_posts = $this->postManager->countPosts();
        if ($nb_posts['nb_posts'] <= 5){
            $nb_page_posts = 1;
        } else {
            $nb_page_posts = $nb_posts['nb_posts'] / 5;
            $nb_page_posts = ceil($nb_page_posts);
        }

        return $nb_page_posts;
    }
}