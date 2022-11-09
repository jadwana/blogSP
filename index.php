<?php
session_start();
use App\Controllers\Logon;
use App\Controllers\Logout;
use App\Controllers\AddPost;
use App\Controllers\AddUser;
use App\Controllers\OnePost;
use App\Controllers\PostList;
use App\Controllers\AddComment;
use App\controllers\UpdateComment;
use App\Controllers\Administration;

require 'vendor/autoload.php';

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
   
               (new addComment())->execute($identifier);
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

         }elseif($_GET['action'] === 'postlist'){
            (new PostList())->execute();

         }elseif($_GET['action'] === 'logon'){
            if(isset($_SESSION['user_id'])){
               header("location: index.php");
               exit;
            }
            (new Logon())->execute();

         }elseif($_GET['action'] === 'logout'){
            (new Logout())->execute();

         

         }elseif($_GET['action'] === 'addUser'){
            if(isset($_SESSION['user_id'])){
               header("location: index.php");
               exit;
            }
            (new AddUser())->execute();

         }elseif($_GET['action'] === 'admin'){
            if(isset($_SESSION['user_id']) && $_SESSION['role']=='admin'){
               (new Administration())->execute();
            }else{
               throw new Exception('seul l\'administrateur à accès à cette page') ;
            }
            
         }elseif($_GET['action'] === 'addPost'){
            (new AddPost())->execute();
         }
         
         else{

            throw new Exception("la page que vous cherchez n'existe pas.");

         }
         
         
        
      }else{
         require('Views/homepage.php');
      }
   
   }catch (Exception $e) {
      //s'il y a une erreur alors ...
      $errorMessage = $e->getMessage();

      require('Views/error.php');
   }
