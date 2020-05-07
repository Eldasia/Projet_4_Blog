<?php

namespace MaureenBruihier\Projet4\Controller\Admin;

use \MaureenBruihier\Projet4\model\PostManager;
use \MaureenBruihier\Projet4\model\entities\PostEntity;
use \MaureenBruihier\Projet4\lib\View;
use \MaureenBruihier\Projet4\lib\Validation;

class PostsController {

    protected $postManager;
    
    public function __construct()
    {
        $this->postManager = new PostManager();
    }

    public function list($page = 1)
    {
        $count = $this->postManager->countPosts();
        $nbPage = ceil($count[0] / 4);
        $posts = $this->postManager->getPosts($page);
        $listPosts = array();

        while ($post = $posts->fetch()) {
            $tmp = new PostEntity([ 'id'=>$post['id'], 'title'=>$post['title'], 'content'=>$post['content'], 'creationDate'=>$post['creation_date_fr'], 'changeDate'=>$post['change_date_fr']]);
            array_push($listPosts, $tmp);
        }

        return View::make('admin/posts', [
            'title' => 'Interface administrateur',
            'listPosts' => $listPosts,
            'nbPage' => $nbPage,
        ]);
    }

    public function addForm() {
        return View::make('admin/post-add', [
            'title' => 'Ajouter un article',
        ]);
    }

    public function add() {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $validation = Validation::make($_POST, [
            'title' => [
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
            return $this->addForm();
        } 

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
        $postToUpdate = new PostEntity([
            'id'=>$post['id'],
            'title'=>$post['title'],
            'content'=>$post['content'],
            'creationDate'=>$post['creation_date_fr'],
            'changeDate'=>$post['change_date_fr']
        ]);

        return View::make('admin/post-update', [
            'title' => 'Modifier un article',
            'postToUpdate' => $postToUpdate,
        ]);
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