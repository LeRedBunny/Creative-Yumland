<?php
    //ini_set('display_errors', 1);
    //error_reporting(E_ALL);

    //usage des fonctions géniales d'Alexi
    require('user_json.php');

    $id=$_GET['id'] ?? ''; //extrait la string depuis GET (via l'url), la rend vide si erreur

    $users=getUserData();   //récupération du tableau des utilisateurs

    $target=$users[$id]['status'];    //récupération de l'individu connecté
    $return=0;              //initialisation de la valeur de retour
    switch($target){        //détermine la valeur de retour en fonction du statut de la cible (j'ai pas envie de gérer une bêtise de renvoi de données)
        case 'bloque':
            $return=5;
        break;
        case 'client':
            $return=4;
        break;
        case 'livreur':
            $return=3;
        break;
        case 'cuisinier':
            $return=2;
        break;
        case 'admin':
            $return=1;
        break;
        default :   //si le système a enregistré une autre valeur, considéré comme un client par défaut
            $return=4;
        break;
    }

    echo $return;

?>