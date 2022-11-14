<?php

namespace App\Models;

use App\lib\DatabaseConnection;
// require_once('src/lib/Database.php');
require 'vendor/autoload.php';
class User 
{
    private string $role;

    private string $pseudo;

    private string $firstname;

    private string $lastname;

    private string $password;

    private string $user_id;

    private string $email;

// }

// class UserRepository
// {
    public DatabaseConnection $connection;
    //check user pseudo
    public function checkUserPseudo(string $pseudo): ?user
    {
        $statement= $this->connection->getConnection()->prepare(
            'SELECT * FROM users WHERE pseudo=? ');

            $statement->execute([$pseudo]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }
        $user = new User();
            $user->getPseudo = $row['pseudo'];
            $user->getPassword = $row['password'];
            $user->getUser_id = $row['user_id'];
            $user->getRole = $row['role'];
            $user->getEmail = $row['email'];
            $user->getFirstname = $row['firstName'];
            $user->getLastname = $row['lastname'];
            
        return $user;
    }

    //check user email
    public function checkUserEmail(string $email)
    {
        $statement= $this->connection->getConnection()->prepare(
            'SELECT * FROM users WHERE email=? ');

            $statement->execute([$email]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }
        // $user = new User();
        //     $user->pseudo = $row['pseudo'];
        //     $user->password = $row['password'];
        //     $user->user_id = $row['user_id'];
        //     $user->role = $row['role'];
        //     $user->email = $row['email'];
        //     $user->firstname = $row['firstName'];
        //     $user->lastname = $row['lastname'];
            
        return $row;
    }

    //creation nvel utilisateur

    public function addUser(string $firstname, string $lastname, string $pseudo, string $password, string $email): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO users( firstname, lastname, pseudo, password, email) VALUES(?, ?, ?, ?, ?)'
        );
        $affectedLines = $statement->execute([$firstname, $lastname, $pseudo, $password, $email]);

        return($affectedLines > 0);
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
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
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
    

    
