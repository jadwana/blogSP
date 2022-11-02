<?php

namespace App\Models\Comment;

use App\lib\database\DatabaseConnection;
// require '../vendor/autoload.php';
require_once('src/lib/database.php');


class Comment
{
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
}

class CommentRepository
{
    public DatabaseConnection $connection;

     //on recupère les commentaires associés à l'id du post
    public function getComments(string $post): array
    {
    
        $statement= $this->connection->getConnection()->prepare(
            "SELECT comment_id, author, comment, DATE_FORMAT(commentDate, '%d%m%Y à %Hh%imin%ss') AS 
        french_creation_date, post_id FROM comments WHERE post_id = ? ORDER BY commentDate DESC");

        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())){
            $comment = new Comment();
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->identifier = $row['comment_id'];
            $comment->post =$row['post_id'];

            $comments[] = $comment;
    }
    
    return $comments;
    } 

    public function getComment(string $identifier): ?Comment
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT comment_id, author, comment, DATE_FORMAT(commentDate, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date, post_id FROM comments WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $comment = new Comment();
        $comment->identifier = $row['comment_id'];
        $comment->author = $row['author'];
        $comment->frenchCreationDate = $row['french_creation_date'];
        $comment->comment = $row['comment'];
        $comment->post = $row['post_id'];

        return $comment;
    }

    //fonction creation commentaire

    public function createComment(string $post, string $author, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, author, comment, commentDate) VALUES(?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$post, $author, $comment]);

        return($affectedLines > 0);
    }

    //fonction modifier un commentaire
    public function updateComment(string $identifier, string $author, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET author=?, comment=?  WHERE comment_id=?'
        );
        $affectedLines = $statement->execute([$author, $comment, $identifier]);

        return($affectedLines > 0);
    }

}
