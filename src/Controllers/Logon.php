<?php
namespace App\Controllers\Logon;
session_start();


use App\Models\user\User;
use App\lib\database\DatabaseConnection;
use App\Models\User\UserRepository;

require_once('src/lib/Database.php');
require_once('src/Models/UserModel.php');

class Logon

{
    public function execute(){

        if(!empty($_POST)){
            $pseudo =null;
            $password = null;

            if(isset($_POST['pseudo'], $_POST['password']) && !empty($_POST['pseudo']) && !empty($_POST['password'])){
                $pseudo=htmlspecialchars($_POST['pseudo']);
                $password=htmlspecialchars($_POST['password']);

                $userRepository = new UserRepository();
                $userRepository->connection= new DatabaseConnection();
                $connectedUser = $userRepository->checkUserLogon($pseudo);
                if(!$connectedUser){
                    throw new \Exception('mauvais pseudo  !');
                }else{
                    $userpass =$connectedUser->password;
                    if($password != $userpass){
                        echo 'mauvais mot de passe';
                    }else{
                        echo 'vous etes connecté';
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



