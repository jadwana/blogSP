<?php

namespace App\Models\Post;

use App\lib\Database\DatabaseConnection;
require_once('src/lib/Database.php');
// require '../vendor/autoload.php';
class Post
{
    /**
     * post title
     *
     * @var string
     */
    public string $title;
    /**
     * post date
     *
     * @var string
     */
    public string $frenchCreationDate;
    /**
     * post content
     *
     * @var string
     */
    public string $content;
    /**
     * post chapo
     *
     * @var string
     */
    public string $chapo;
    /**
     * post id
     *
     * @var string
     */
    public string $identifier;
    
}

class PostRepository
{
    //connect to the database
    public DatabaseConnection $connection;

    //we retrieve a specific post according to its id
    public function getPost(string $identifier): Post 
    {
        $statement= $this->connection->getConnection()->prepare(
            "SELECT post_id, title, content, chapo, DATE_FORMAT(creationDate, '%d%m%Y à %Hh%imin%ss') AS 
            french_creation_date FROM posts WHERE post_id = ?");

        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $post = new Post();
            $post->title = $row['title'];
            $post->french_creation_date = $row['french_creation_date'];
            $post->content = $row['content'];
            $post->identifier = $row['post_id'];
            $post->chapo = $row['chapo'];
            
        return $post;
    }

    // we retrieve all posts
    public function getPosts(): array
    {
        $statement= $this->connection->getConnection()->query(
        "SELECT post_id, title, content, chapo, DATE_FORMAT(creationDate, '%d%m%Y à %Hh%imin%ss') AS 
        french_creation_date FROM posts ORDER BY creationDate");
        $posts = [];

        while (($row = $statement->fetch())){
        $post = new Post();
            $post->title = $row['title'];
            $post->french_creation_date = $row['french_creation_date'];
            $post->content = $row['content'];
            $post->identifier = $row['post_id'];
            $post->chapo = $row['chapo'];

            $posts[] = $post;
        }
        return $posts;
    }

    

}