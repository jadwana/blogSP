<?php
namespace App\Controllers;



use App\Models\User;
use App\lib\DatabaseConnection;
require 'vendor/autoload.php';



class Logon

{
    public function execute()
    {
        if(!empty($_POST)){
            $pseudo =null;
            // $password = null;

            if(isset($_POST['pseudo'], $_POST['password']) && !empty($_POST['pseudo']) && !empty($_POST['password'])){
                $pseudo=htmlspecialchars($_POST['pseudo']);

                $userRepository = new User();
                $userRepository->connection= new DatabaseConnection();
                $connectedUser = $userRepository->checkUserPseudo($pseudo);
                if(!$connectedUser){
                    throw new \Exception('mauvais pseudo  !');
                }else{
                    if(password_verify($_POST['password'], $connectedUser->getPassword)){
                        $_SESSION['user_id']= $connectedUser->getUser_id;
                        $_SESSION['pseudo']= $connectedUser->getPseudo;
                        $_SESSION['role'] = $connectedUser->getRole;
                        $_SESSION['firstname'] = $connectedUser->getFirstname;
                        $_SESSION['lastname'] = $connectedUser->getLastname;

                        header("location: index.php");
                    }else{
                        echo 'mauvais mot de passe'; exit;
                    }
                }
            }else{
                echo 'vous devez remplir tous les champs';
            }
            
        }else{
            // header('location: index.php?action=logon');
        }
        require ('views/connexionPage.php');  
    }
}



