<?php

namespace MaureenBruihier\Projet4\Controller\Admin;

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

        require('views/admin/posts.php');
    }

    public function addForm() {
        require('views/admin/post-add.php');
    }

    public function add() {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $postToAdd = $this->postManager->addPost($title, $content);

        if ($postToAdd == false) 
        {
            throw new \Exception('Votre article n\'a pas pu être ajouté.');    
        }
        else 
        {
            header('Location: /adm/dashboard');
        }
    }

    public function updateForm($postId) 
    {   
        $post = $this->postManager->getPost($postId);
        $postToDisplay = new PostEntity([
            'id'=>$post['id'],
            'title'=>$post['title'],
            'content'=>$post['content'],
            'creationDate'=>$post['creation_date_fr'],
            'changeDate'=>$post['change_date_fr']
        ]);

        require('views/admin/post-update.php');
    }

    public function update($postId) {
        $title = $_POST['title'];
        $content = $_POST['content'];
    
        $postToUpdate = $this->postManager->updatePost($postId, $title, $content);

        if ($postToUpdate == false) 
        {
            throw new \Exception('Votre article n\'a pas pu être modifié.');    
        }
        else 
        {
            header('Location: /adm/dashboard');
        }
    }

    public function delete($postId)
    {
        $postToDelete = $this->postManager->deletePost($postId);

        if ($postToDelete == false) 
        {
            throw new \Exception('Votre article n\'a pas pu être supprimé.');    
        }
        else 
        {
            header('Location: /adm/dashboard');
        }
    }
}