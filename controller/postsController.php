<?php

namespace MaureenBruihier\Projet4\controller;

require "vendor/autoload.php";

use \MaureenBruihier\Projet4\controller\CommentsController;
use \MaureenBruihier\Projet4\model\PostManager;
use \MaureenBruihier\Projet4\model\entities\PostEntity;


class PostsController {

    public function listPosts($isAdmin)
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
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
            require('views/adminView.php');
        }
        else 
        {
            throw new \Exception('Argument invalide.');
        }
        
    }

    public function displayPost($postId, $isAdmin) 
    {   
        $postManager = new PostManager();
        $post = $postManager->getPost($postId);
        $postToDisplay = new PostEntity([ 'id'=>$post['id'], 'author'=>$post['author'], 'title'=>$post['title'], 'content'=>$post['content'], 'creationDate'=>$post['creation_date_fr'], 'changeDate'=>$post['change_date_fr']]);
        
        if ($isAdmin == 'false') 
        {
            $commentsController = new CommentsController();
            $listComments = $commentsController->listComments($postId);
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
        $postManager = new PostManager();
        $postToAdd = $postManager->addPost($title, $author, $content);

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
        $postManager = new PostManager();
        $postToUpdate = $postManager->updatePost($postId, $title, $content);

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
        $postManager = new PostManager();
        $postToDelete = $postManager->deletePost($postId);

        if ($postToDelete == false) 
        {
            throw new \Exception('Votre article n\'a pas pu être supprimé.');    
        }
        else 
        {
            header('Location: admin.php?result=2');
        }
    }
}