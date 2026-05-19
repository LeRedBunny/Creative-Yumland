<?php
    //prend en paramètre le tableau des données du formulaire et le mode voulu
    //retourne un formulaire dont toutes les données non récupérables ont été initialisées à une valeur censé causer une erreur
    function detecterror(array $array, $mode): array{   //utiliser un tableau de chaînes de caractères avec un foreach plutôt qu'un switch case?
        switch ($mode){
            case 'connexion':   //si les valeurs ne sont pas récupérées par réécriture de balise ou autre, les initialise à une valeur prévue

                $array['email']=defaultvalue($array['email'],'error');  //adresse email pas censé être reconnaissable

                $array['password']=defaultvalue($array['password'],'error');//mot de passe trop court pour exister

                break;
            //la défense de connexion dépend beaucoup de l'intégrité d'inscription
            case 'inscription':

                $array['email']=defaultvalue($array['email'],'error');  //adresse email pas censé être reconnaissable

                $array['password']=defaultvalue($array['password'],'error');//mot de passe trop court pour exister
                
                //faire les autres valeurs


                break;
            case 'commande':
                break;
        }
    }

    function defaultvalue($data, $default){
        if(!isset($data)){
            return $default;
        } else {
            return htmlspecialchars($data); //cette fonction supprime touuuuut ce qui fait chier
        }
    }
?>