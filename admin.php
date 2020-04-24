<?php

require "vendor/autoload.php";

use \MaureenBruihier\Projet4\controller\PostsController;
use \MaureenBruihier\Projet4\controller\CommentsController;
use \MaureenBruihier\Projet4\controller\AdminController;

// try
// {

    
//         $postsController = new PostsController();
//         $commentsController = new CommentsController();
//         $adminController = new AdminController();

//         if (!isset($_GET['page']) OR empty($_GET['page'])) {
//             $_GET['page'] = 1;
//         }

//         $firstPost = (intval($_GET['page'])-1)*5;

//         if (isset($_GET['action'])) {
//             if ($_GET['action'] == 'login') {
//                 $adminController->login($_POST['pseudo'], $_POST['password']);
//             }

//             if (isset($_SESSION['pseudo'])) {
//                 if ($_GET['action'] == 'displayPosts') {
//                     $postsController->listPosts($firstPost, 'true');
//                 }

//                 if ($_GET['action'] == 'displayComments') {
//                     if (isset($_GET['commentId']) && !empty($_GET['commentId'])) {
//                         if ($_GET['actionComment'] == "validate" || $_GET['actionComment'] == "refuse") {
//                             $commentsController->moderateComment($_GET['actionComment'], $_GET['commentId']);
//                         }
//                         else {
//                             throw new Exception('Aucune action valide.');
//                         }
//                     }

//                     else {
//                         if (isset($_GET['reportValue']) && !empty($_GET['reportValue'])) {
//                             $commentsController->listComments($_GET['reportValue']);
//                         }
//                         else {
//                             $commentsController->listComments();
//                         }
//                     }

//                 }

//                 if ($_GET['action'] == 'deletePost')
//                 {
//                     if (isset($_GET['id']) && $_GET['id'] >0) {
//                         $postsController->deletePost($_GET['id']);
//                     }
//                     else {
//                         throw new Exception('Aucun identifiant de billet valide.');
//                     }
//                 }

//                 if ($_GET['action'] == 'createPost') {
//                     require('views/addPostView.php');
//                 }

//                 if ($_GET['action'] == 'addPost') {
//                     $postsController->addPost(htmlspecialchars($_POST['title']), nl2br($_POST['content']));
//                 }

//                 if ($_GET['action'] == 'updatePost') {
//                     if (isset($_GET['id']) && $_GET['id'] >0) {
//                         $postsController->displayPost($_GET['id'], 'true');
//                     }
//                     else {
//                         throw new Exception('Aucun identifiant de billet valide.');
//                     }
//                 }

//                 if ($_GET['action'] == 'save') {
//                     if (isset($_GET['id']) && $_GET['id'] > 0) {
//                         $postsController->UpdatePost($_GET['id'], htmlspecialchars($_POST['title']), nl2br($_POST['content']));
//                     }
//                     else {
//                         throw new Exception('Aucun identifiant de billet valide.');
//                     }
//                 }
//             } else {
//                 require('views/loginPage.php');
//             }
//         }
//         else {
//             if (isset($_SESSION['pseudo'])) {
//                 require('views/adminView.php');
//             } else {
//                 require('views/loginPage.php');
//             }
//         }
// }
// catch (Exception $e) {
//     $errorMessage = $e->getMessage();
//     require('views/errorView.php');
// }
