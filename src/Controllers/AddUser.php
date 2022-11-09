<?php
namespace App\Controllers;

use App\Models\user;
use App\lib\DatabaseConnection;
require 'vendor/autoload.php';


class AddUser
{
    public function execute()
    {
        if(!empty($_POST)){
            if(isset($_POST["firstname"], $_POST["lastname"], $_POST["pseudo"], $_POST["password"]) && !empty($_POST["firstname"]
            ) && !empty($_POST["lastname"]) && !empty($_POST["pseudo"]) && !empty($_POST["password"])){

                $pseudo= strip_tags($_POST['pseudo']);
                if(strlen($pseudo)<5){
                    echo 'le speudo est trop court'; exit;
                }
                    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        echo 'adresse mail incorrecte'; exit;
                    }
                        if(!preg_match('/[a-zA-Z0-9]+/', $_POST['firstname']) || !preg_match('/[a-zA-Z0-9]+/', $_POST['lastname'])){
                            echo 'vos nom et prénom doivent etre une chaine de caractères aphanumerique'; exit;
                        }
                        
                        $pseudo=htmlspecialchars($_POST['pseudo']);
                        $email=$_POST['email'];
                        //on verifie que le pseudo n'existe pas déjà
                        $userPseudoCheck = new User();
                        $userPseudoCheck->connection= new DatabaseConnection();
                        $result1 = $userPseudoCheck->checkUserPseudo($pseudo);
                        if($result1){
                            throw new \Exception('pseudo déjà existant !');
                        }
                        //on vérifie que l'email n'existe pas déjà
                        $userMailCheck = new User();
                        $userMailCheck->connection= new DatabaseConnection();
                        $result2 = $userMailCheck->checkUserEmail($email);
                        if($result2){
                            throw new \Exception('email déjà existant !');
                        }
                        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $firstname=htmlspecialchars($_POST['firstname']);
                        $lastname=htmlspecialchars($_POST['lastname']);

                        //on ajoute le nvel utilisateur
                        $userRepository = new User();
                        $userRepository->connection = new DatabaseConnection();
                        $success = $userRepository->addUser($firstname, $lastname, $pseudo, $pass, $email);
                        if(!$success){
                            throw new \Exception('Impossible d\'ajouter l\'utilisateur !');
                        }
                            header('location: index.php');
            }
            else{
                echo 'toutes les informations doivent être complétées';
            }
        }else{
            header('location: index.php?action=register');
        }





        
    }
}