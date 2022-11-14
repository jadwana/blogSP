<?php
namespace App\Controllers;

use App\Models\Comment;
use App\lib\DatabaseConnection;
require 'vendor/autoload.php';



class UpdateComment
{
    public function execute(string $identifier, ?array $input)
    { 
        
        //gestion de la soumission s'il y a une entrée
        if($input !== null){
            
            $comment = null;

            if( !empty($input['comment'])){
                
                $comment = htmlspecialchars($input['comment']) ;
            }else {
                throw new \Exception('les données du formulaire sont invalides');
            }

            $commentRepository = new Comment();
            $commentRepository->connection = new DatabaseConnection();
            $success = $commentRepository->updateComment($identifier, $comment);
            if(!$success){
                throw new \Exception('Impossible de modifier le commentaire !');
            }else{
                $commentRepository = new Comment();
                $commentRepository->connection = new DatabaseConnection();
                $comment = $commentRepository->getOneComment($identifier);
                header('location: index.php?action=post&id='.$comment->getPost);
                
            }

        }
        //affiche le formulaire s'il n'y a pas d'entée et au début
        $commentRepository = new Comment();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getOneComment($identifier);
        
        if ($comment === null) {
            throw new \Exception("Le commentaire $identifier n'existe pas.");
        }    
    
        require('Views/forms/updateCommentForm.php');
    
   
    }
}