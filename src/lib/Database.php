<?php
namespace App\lib\Database;

class DatabaseConnection
{
    public ?\PDO $database = null;
    

    public function getConnection(): \PDO
    {
        if($this->database === null){
            $this->database = new \PDO('mysql:host=;dbname=blogsp;charset=utf8', 'root', '');
        }
        return $this->database;
    }

}