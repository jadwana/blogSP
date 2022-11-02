<?php
namespace App\Controllers\UpdateComment;

use App\Models\Comment\CommentRepository;
use App\lib\database\DatabaseConnection;
// require '../vendor/autoload.php';
require_once('src/Models/CommentModel.php');
require_once('src/lib/Database.php');


class UpdateComment
{
    public function execute(string $identifier, ?array $input)
    { 
        
        //gestion de la soumission s'il y a une entrée
        if($input !== null){
            $author =null;
            $comment = null;

            if(!empty($input['author']) && !empty($input['comment'])){
                $author = $input['author'];
                $comment = $input['comment'];
            }else {
                throw new \Exception('les données du formulaire sont invalides');
            }

            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();
            $success = $commentRepository->updateComment($identifier, $author, $comment);
            if(!$success){
                throw new \Exception('Impossible de modifier le commentaire !');
            }else{
                $commentRepository = new CommentRepository();
                $commentRepository->connection = new DatabaseConnection();
                $comment = $commentRepository->getComment($identifier);
                header('location: index.php?action=post&id='. $comment->post);
                
            }

        }
        //affiche le formulaire s'il n'y a pas d'entée et au début
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($identifier);
        
        if ($comment === null) {
            throw new \Exception("Le commentaire $identifier n'existe pas.");
        }    
    
        require('Views/form/updateCommentForm.php');
    
   
    }
}