<?php

namespace App\Controllers\OnePost;

use App\Models\Comment\CommentRepository;
use App\Models\Post\PostRepository;
use App\lib\Database\DatabaseConnection;
// require '../vendor/autoload.php';
require_once('src/Models/PostModel.php');
require_once('src/Models/CommentModel.php');
require_once('src/lib/Database.php');

class OnePost
{
//fonction en charge d'affichier la page des billets
public function execute(string $identifier)
{
    $connection = new DatabaseConnection();

    $postRepository = new PostRepository();
    $commentRepository = new CommentRepository();
    $postRepository->connection = $connection;
    $commentRepository->connection = $connection;
    $post = $postRepository->getPost($identifier);
    $comments = $commentRepository->getComments($identifier);

    require('Views/onePost.php');
}
}