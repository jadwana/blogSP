<?php
namespace App\Controllers\PostList;

require_once('src/Models/PostModel.php');
require_once('src/lib/Database.php');
// require '../vendor/autoload.php';
use App\Models\Post\PostRepository;
use App\lib\Database\DatabaseConnection;

class PostList
{
    //fonction en charge d'afficher la liste des posts
    public function execute()
    {   
        $connection = new DatabaseConnection();
        $repository = new PostRepository();
        $repository->connection = $connection;
        $posts = $repository->getPosts();

        require('Views/postList.php');
    }
}