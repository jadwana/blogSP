<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\lib\DatabaseConnection;
require 'vendor/autoload.php';


class OnePost
{
//fonction en charge d'affichier la page des billets
public function execute(string $identifier)
{
    $connection = new DatabaseConnection();

    $postRepository = new Post();
    $commentRepository = new Comment();
    $postRepository->connection = $connection;
    $commentRepository->connection = $connection;
    $post = $postRepository->getPost($identifier);
    $comments = $commentRepository->getComments($identifier);

    require('Views/onePost.php');
}
}