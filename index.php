<?php
use App\Controllers\AddComment\AddComment;
use App\Controllers\PostList\PostList;
use App\Controllers\OnePost\OnePost;
use App\controllers\UpdateComment\UpdateComment;
// require 'vendor/autoload.php';
   require_once('src/Controllers/PostList.php');
   require_once('src/Controllers/OnePost.php');
   require_once('src/Controllers/AddComment.php');
   require_once('src/Controllers/UpdateComment.php');

   //ce fichier est notre routeur
   //il va donc nous rediriger vers le bon controleur

   try{
      if(isset($_GET['action']) && $_GET['action'] !==''){
         if($_GET['action'] === 'post'){
            if(isset($_GET['id']) && $_GET['id'] > 0){
               $identifier = $_GET['id'];
   
               (new OnePost())->execute($identifier);
            }else{
               throw new Exception('aucun identifiant envoyé');
            }
   
         }elseif($_GET['action'] === 'addComment'){
            if(isset($_GET['id']) && $_GET['id'] > 0){
               $identifier = $_GET['id'];
   
               (new addComment())->execute($identifier, $_POST);
            }else{
               throw new Exception('aucun identifiant envoyé') ;
            }

         }elseif($_GET['action'] === 'updateComment'){
            if(isset($_GET['id']) && $_GET['id'] > 0){
               $identifier = $_GET['id'];

               $input = null;
               if($_SERVER['REQUEST_METHOD'] === 'POST'){
                  $input = $_POST;
               }
   
               (new updateComment())->execute($identifier, $input);
            }else{
               throw new Exception('aucun identifiant envoyé') ;
            }

         } else{

            throw new Exception("la page que vous cherchez n'existe pas.");
         }
        
      }else{
         (new PostList())->execute();
      }
   
   }catch (Exception $e) {
      //s'il y a une erreur alors ...
      $errorMessage = $e->getMessage();

      require('Views/error.php');
   }
