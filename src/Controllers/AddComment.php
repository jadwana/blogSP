<?php
namespace App\Controllers\AddComment;

use App\Models\Comment\CommentRepository;
use App\lib\Database\DatabaseConnection;
// require '../vendor/autoload.php';
require_once('src/Models/CommentModel.php');
require_once('src/lib/Database.php');

class AddComment
{
    //fonction en charge de faire les vérifications de securité
    //et d'ajouter un nouveau commentaire
    public function execute(string $post, array $input)
    {
    $author =null;
    $comment = null;
        //on fait les vérifications
        if(!empty($input['author']) && !empty($input['content'])){
            $author = htmlspecialchars( $input['author']);
            $comment = htmlspecialchars($input['content']) ;
        }else {
            throw new \Exception('les données du formulaire sont invalides');
        }
        //on crée le nouveau commentaire
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->createComment($post, $author, $comment);
        if(!$success){
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        }else{
            header('location: index.php?action=post&id=' .$post);
        }
    }
}