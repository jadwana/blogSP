<?php
namespace App\Controllers;



use App\Models\User;
use App\lib\DatabaseConnection;
require 'vendor/autoload.php';



class Logon

{
    public function execute(){

     

        

        if(!empty($_POST)){
            $pseudo =null;
            $password = null;

            if(isset($_POST['pseudo'], $_POST['password']) && !empty($_POST['pseudo']) && !empty($_POST['password'])){
                $pseudo=htmlspecialchars($_POST['pseudo']);

                $userRepository = new User();
                $userRepository->connection= new DatabaseConnection();
                $connectedUser = $userRepository->checkUserPseudo($pseudo);
                if(!$connectedUser){
                    throw new \Exception('mauvais pseudo  !');
                }else{
                    if(password_verify($_POST['password'], $connectedUser->password)){
                        $_SESSION['user_id']= $connectedUser->user_id;
                        $_SESSION['pseudo']= $connectedUser->pseudo;
                        $_SESSION['role'] = $connectedUser->role;

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
        
    }
}



