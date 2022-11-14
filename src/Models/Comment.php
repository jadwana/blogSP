<?php

namespace App\Models;

use App\lib\DatabaseConnection;
require 'vendor/autoload.php';

class Comment
{
    private string $pseudo;
    private string $frenchCreationDate;
    private string $comment;
    private string $identifier;
    private string $post;

    public DatabaseConnection $connection;

     //on recupère les commentaires associés à l'id du post
    public function getComments(string $post): array
    {
    
        $statement= $this->connection->getConnection()->prepare(
            "SELECT comments.comment_id, comments.comment, DATE_FORMAT(comments.commentDate, '%d%m%Y à %Hh%imin%ss') AS 
        french_creation_date, comments.post_id, users.pseudo FROM comments INNER JOIN users ON comments.user_id = users.user_id 
        WHERE post_id = ? AND comments.validation = 'y' ORDER BY comments.commentDate DESC");

        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())){
            $comment = new Comment();
            $comment->getPseudo = $row['pseudo'];
            $comment->getFrenchCreationDate = $row['french_creation_date'];
            $comment->getComment = $row['comment'];
            $comment->getIdentifier = $row['comment_id'];
            $comment->getPost =$row['post_id'];

            $comments[] = $comment;
    }
    
    return $comments;
    } 
    // on récupère un seul commentaire en fonction de son id
    public function getOneComment(string $identifier): ?Comment
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
        $comment->getIdentifier = $row['comment_id'];
        $comment->getAuthor = $row['pseudo'];
        $comment->getFrenchCreationDate = $row['french_creation_date'];
        $comment->getComment = $row['comment'];
        $comment->getPost = $row['post_id'];

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


    /**
     * Get the value of pseudo
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of frenchCreationDate
     */ 
    public function getFrenchCreationDate()
    {
        return $this->frenchCreationDate;
    }

    /**
     * Set the value of frenchCreationDate
     *
     * @return  self
     */ 
    public function setFrenchCreationDate($frenchCreationDate)
    {
        $this->frenchCreationDate = $frenchCreationDate;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of identifier
     */ 
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set the value of identifier
     *
     * @return  self
     */ 
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get the value of post
     */ 
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set the value of post
     *
     * @return  self
     */ 
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }
}
