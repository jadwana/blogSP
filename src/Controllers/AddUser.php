<?php
namespace App\Controllers\AddUser;

use App\Models\user;
use App\lib\Database\DatabaseConnection;
// require '../vendor/autoload.php';
require_once('src/Models/UserModel.php');
require_once('src/lib/Database.php');

class AddUser
{
    public function createUser(string $firstname, string $lastname, string $pseudo, string $password)
    {
        if(!empty($_POST)){
            if(isset($_POST["firstname"], $_POST["lastname"], $_POST["pseudo"], $_POST["password"]) && !empty($_POST["firstname"]
            ) && !empty($_POST["lastname"]) && !empty($_POST["pseudo"]) && !empty($_POST["password"])){

                $pseudo= strip_tags($_POST['pseudo']);
                if(strlen($pseudo)<5){
                    echo 'le speudo est trop court';
                }
                    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        echo 'adresse mail incorrecte';
                    }
                        if(!preg_match('/[a-zA-Z0-9]+/', $_POST['firstname']) || !preg_match('/[a-zA-Z0-9]+/', $_POST['lastname'])){
                            echo 'vos nom et prénom doivent etre une chaine de caractères aphanumerique';
                        }

            }else{
                echo 'toutes les informations doivent être complétées';
            }
        }else{
            header('location: index.php?action=register');
        }

        if(!empty($input['author']) && !empty($input['comment'])){
            $author = $input['author'];
            $comment = $input['comment'];
        }else {
            throw new \Exception('les données du formulaire sont invalides');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->UpdateComment($post, $author, $comment);
        if(!$success){
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        }else{
            header('location: index.php?action=post&id=' .$post);
        }
    }
}