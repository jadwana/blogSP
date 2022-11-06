<?php
namespace App\Controllers;

require 'vendor/autoload.php';
use App\Models\Post;
use App\lib\DatabaseConnection;

class PostList
{
    //fonction en charge d'afficher la liste des posts
    public function execute()
    {   
        // $connection = new DatabaseConnection();
        $repository = new Post();
        $repository->connection = new DatabaseConnection();
        $posts = $repository->getPosts();

        require('Views/postList.php');
    }
}