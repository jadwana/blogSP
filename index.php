<?php
session_start();
use App\Controllers\Logon;
use App\Controllers\Logout;
use App\Controllers\AddUser;
use App\Controllers\OnePost;
use App\Controllers\Homepage;
use App\Controllers\PostList;
use App\Controllers\Register;
use App\Controllers\Connexion;
use App\Controllers\AddComment;
use App\controllers\UpdateComment;

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
            (new Logon())->execute();

         }elseif($_GET['action'] === 'connexion'){
            if(isset($_SESSION['user_id'])){
               header("location: index.php");
               exit;
            }
            (new Connexion())->execute();
         }elseif($_GET['action'] === 'logout'){
            (new Logout())->execute();

         }elseif($_GET['action'] === 'register'){
            (new Register())->execute();

         }elseif($_GET['action'] === 'addUser'){
            (new AddUser())->execute();
         }
         
         else{

            throw new Exception("la page que vous cherchez n'existe pas.");

         }
         
         
        
      }else{
         (new Homepage())->execute();
      }
   
   }catch (Exception $e) {
      //s'il y a une erreur alors ...
      $errorMessage = $e->getMessage();

      require('Views/error.php');
   }
