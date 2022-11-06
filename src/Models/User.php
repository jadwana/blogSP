<?php

namespace App\Models;

use App\lib\DatabaseConnection;
// require_once('src/lib/Database.php');
require 'vendor/autoload.php';
class User 
{
    public string $role;

    public string $pseudo;

    public string $firstname;

    public string $lastname;

    public string $password;

    public string $user_id;

    public string $email;

// }

// class UserRepository
// {
    public DatabaseConnection $connection;
    //check user logon
    public function checkUserLogon(string $pseudo): ?user
    {
        $statement= $this->connection->getConnection()->prepare(
            'SELECT * FROM users WHERE pseudo=? ');

            $statement->execute([$pseudo]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }
        $user = new User();
            $user->pseudo = $row['pseudo'];
            $user->password = $row['password'];
            $user->user_id = $row['user_id'];
            $user->role = $row['role'];
            $user->email = $row['email'];
            $user->firstname = $row['firstName'];
            $user->lastname = $row['lastname'];
            
        return $user;
    }

    //creation nvel utilisateur

    public function createUser(string $firstname, string $lastname, string $pseudo, string $password, string $email): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO users( firstname, lastname, pseudo, password, email) VALUES(?, ?, ?, ?, ?)'
        );
        $affectedLines = $statement->execute([$firstname, $lastname, $pseudo, $password, $email]);

        return($affectedLines > 0);
    }
}
    

    
