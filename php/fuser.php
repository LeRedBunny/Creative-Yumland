<?php
    //ini_set('display_errors', 1);
    //error_reporting(E_ALL);

    //usage des fonctions géniales d'Alexi
    require('user_json.php');


    $input=file_get_contents("php://input");    //on récupère le contenu du post/input 

    $user=json_decode($input,true); //on les traduit depuis json

    //création de notre objet, à partir de l'input

    //liste des paramètres pertinents (sécurité)
    $datalist=array("name","firstname","email","tel","address","city","code","favorite_rock");


    //pour chaque paramètre pertinent, $data stocke la même chose que $user
    foreach($datalist as $index => $value){
        $data[$value]=$user[$value];
        //echo '$data['.$value.']=$_POST['.$value.']='.$data[$value].'<br>';
    }

    //récupération des données obsolètes de l'utilisateur (pour récupérer son ID)
    $olduser=getUserFromEmail($data['email']);
    $data['id']=$olduser["id"];


    $answer=updateUser($data);  //mise à jour utilisant la fonction de user_json.php
    if($answer){
        echo '1';
    } else {
        echo '0';
    }

?>