<?php
    //ini_set('display_errors', 1);
    //error_reporting(E_ALL);

    //usage des fonctions géniales d'Alexi
    require('user_json.php');

    $input=file_get_contents("php://input");    //on récupère le contenu du post/input 

    $data=json_decode($input,true); //on les traduit depuis json

    if(isset($data['email'])){  //sécurité
        //récupération de l'id de l'utilisateur
        $user=getUserFromEmail($data['email']);
        $data['id']=$user["id"];


        $answer=updateUser($data);  //mise à jour utilisant la fonction de user_json.php
        if($answer){
            echo '1';
        } else {
            echo '0';
        }
    } else{
        echo '0';
    }
    

?>