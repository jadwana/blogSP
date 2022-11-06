<?php
namespace App\Controllers\Logout;

class Logout
{
    //deconnection de l'utilisateur
    public function execute(){
        session_start();
        //on verifie que l'utilisateur est bien connecté
        //sinon on le renvoie sur la page d'accueil
        if(!isset($_SESSION["user_id"])){
            header("location: index.php");
            exit;
        }
        session_unset();
        session_destroy();
        ;

        header("location: index.php");
    }
}
