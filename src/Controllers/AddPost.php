<?php
namespace App\Controllers;

use App\Models\Post;
use App\lib\DatabaseConnection;

require 'vendor/autoload.php';

class AddPost
{
    public function execute()
    {
        
        $user_id =$_SESSION['user_id'];
        $content = null;
        $title = null;
        $chapo = null;

        if(!empty($_POST)){
            //on fait les vérifications
            if(!empty($_POST['content']) && !empty($_POST['title']) && !empty($_POST['chapo'])){
                $content = htmlspecialchars($_POST['content']) ;
                $title = htmlspecialchars($_POST['title']) ;
                $chapo = htmlspecialchars($_POST['chapo']) ;
            }else {
                throw new \Exception('les données du formulaire sont invalides');
            }
            //on crée le nvel article
            $postRepository = new Post();
            $postRepository->connection = new DatabaseConnection();
            $success = $postRepository->addPost($title, $content, $chapo, $user_id);
            if(!$success){
                throw new \Exception('Impossible d\'ajouter l\'article !');
            }else{
                echo'article ajouté';
                // header('location: index.php?action=admin);
            }
        }
            
        


        require 'Views/addPost.php';
    }

    
}