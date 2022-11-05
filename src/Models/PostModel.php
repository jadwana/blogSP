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

    public string $firstname;

    public string $lastname;
    
}

class PostRepository
{
    //connect to the database
    public DatabaseConnection $connection;

    //we retrieve a specific post according to its id
    public function getPost(string $identifier): Post 
    {
        $statement= $this->connection->getConnection()->prepare(
            "SELECT users.firstName,users.lastname,posts.post_id, posts.title, posts.content, posts.chapo, 
            DATE_FORMAT(posts.creationDate, '%d%m%Y à %Hh%imin%ss') AS french_creation_date FROM posts 
            INNER JOIN users ON users.user_id=posts.user_id WHERE posts.post_id = ?");

        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $post = new Post();
            $post->title = $row['title'];
            $post->french_creation_date = $row['french_creation_date'];
            $post->content = $row['content'];
            $post->identifier = $row['post_id'];
            $post->chapo = $row['chapo'];
            $post->firstname = $row['firstName'];
            $post->lastname = $row['lastname'];
            
        return $post;
    }

    // we retrieve all posts
    public function getPosts(): array
    {
        $statement= $this->connection->getConnection()->query(
        "SELECT users.firstName, users.lastname,posts.post_id,posts.title, posts.chapo, 
        DATE_FORMAT(posts.creationDate,'%d%m%Y à %Hh%imin%ss') AS french_creation_date 
        FROM users INNER JOIN posts ON users.user_id=posts.user_id ORDER BY creationDate DESC;");


        $posts = [];

        while (($row = $statement->fetch())){
        $post = new Post();
            $post->title = $row['title'];
            $post->french_creation_date = $row['french_creation_date'];
            // $post->content = $row['content'];
            $post->identifier = $row['post_id'];
            $post->chapo = $row['chapo'];
            $post->firstname = $row['firstName'];
            $post->lastname = $row['lastname'];

            $posts[] = $post;
        }
        return $posts;
    }

    

}