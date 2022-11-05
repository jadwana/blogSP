<?php

namespace App\Models\Comment;

use App\lib\database\DatabaseConnection;
// require '../vendor/autoload.php';
require_once('src/lib/database.php');


class Comment
{
    public string $pseudo;
    public string $frenchCreationDate;
    public string $comment;
    public string $identifier;
    public string $post;
}

class CommentRepository
{
    public DatabaseConnection $connection;

     //on recupère les commentaires associés à l'id du post
    public function getComments(string $post): array
    {
    
        $statement= $this->connection->getConnection()->prepare(
            "SELECT comments.comment_id, comments.comment, DATE_FORMAT(comments.commentDate, '%d%m%Y à %Hh%imin%ss') AS 
        french_creation_date, comments.post_id, users.pseudo FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE post_id = ? AND comments.validation = 'y' ORDER BY comments.commentDate DESC");

        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())){
            $comment = new Comment();
            $comment->pseudo = $row['pseudo'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->identifier = $row['comment_id'];
            $comment->post =$row['post_id'];

            $comments[] = $comment;
    }
    
    return $comments;
    } 
    // on récupère un seul commentaire en fonction de son id
    public function getComment(string $identifier): ?Comment
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT comments.comment_id, comments.comment, DATE_FORMAT(comments.commentDate, '%d%m%Y à %Hh%imin%ss') AS 
            french_creation_date, comments.post_id, users.pseudo FROM comments INNER JOIN users ON comments.user_id = users.user_id
             WHERE comments.comment_id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $comment = new Comment();
        $comment->identifier = $row['comment_id'];
        $comment->author = $row['pseudo'];
        $comment->frenchCreationDate = $row['french_creation_date'];
        $comment->comment = $row['comment'];
        $comment->post = $row['post_id'];

        return $comment;
    }

    //creation commentaire

    public function createComment(string $post, string $user_id, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, user_id, comment, commentDate) VALUES(?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$post, $user_id, $comment]);

        return($affectedLines > 0);
    }

    //modifier un commentaire
    public function updateComment(string $identifier, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET  comment=?  WHERE comment_id=?'
        );
        $affectedLines = $statement->execute([$comment, $identifier]);

        return($affectedLines > 0);
    }

}
