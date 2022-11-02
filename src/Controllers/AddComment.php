<?php
namespace App\Controllers\AddComment;

use App\Models\Comment\CommentRepository;
use App\lib\Database\DatabaseConnection;
// require '../vendor/autoload.php';
require_once('src/Models/CommentModel.php');
require_once('src/lib/Database.php');

class AddComment
{
    public function execute(string $post, array $input)
    {
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
    $success = $commentRepository->UpdateComment($post, $author, $comment);
    if(!$success){
        throw new \Exception('Impossible d\'ajouter le commentaire !');
    }else{
        header('location: index.php?action=post&id=' .$post);
    }
    }
}