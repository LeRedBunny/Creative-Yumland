<?php
    //prend en paramètre le tableau des données du formulaire et le mode voulu
    //retourne un formulaire dont toutes les données non récupérables ont été initialisées à une valeur censé causer une erreur
    function createError(array $array, string $mode) : array{   //utiliser un tableau de chaînes de caractères avec un foreach plutôt qu'un switch case?
        //echo 'beginning function createError';
        switch ($mode){
            case 'connexion':   //si les valeurs ne sont pas récupérées par réécriture de balise ou autre, les initialise à une valeur prévue
                //echo 'checking for email<br>';
                $array['email']=defaultvalue($array['email'],'error');  //ne s'exécute pas si l'index n'existe pas
                //echo 'checking for password<br>';
                $array['password']=defaultvalue($array['password'],'error');//mot de passe trop court pour exister

                break;
            //la défense de connexion dépend beaucoup de l'intégrité d'inscription
            case 'inscription':

                $array['email']=defaultvalue($array['email'],'error'); 

                $array['password']=defaultvalue($array['password'],'error');
                
                $array['firstname']=defaultvalue($array['firstname'],'error');

                $array['name']=defaultvalue($array['name'],'error');

                $array['tel']=defaultvalue($array['tel'],'error');

                $array['address']=defaultvalue($array['adress'],'error');

                $array['code']=defaultvalue($array['code'],'error');

                $array['city']=defaultvalue($array['city'],'error');
                break;
            case 'commande':
                break;
        }
        return $array;
    }

    function defaultvalue($data = '', $default) : string {
        if(!isset($data)){//premier cas: la variable n'est pas initialisé, on renvoie default
            //echo '$data does not exist<br>' ;
            //echo '$data='.$data.'<br>';
            return $default;
        } else { //deuxième cas: la variable est initialisé
            //on supprime tous ses espaces (il ne peut pas y en avoir), si elle est vide, on renvoie default
            $trimmed=str_replace(' ','',$data);
            if($trimmed==''){
                //echo '$data is empty';
                return $default;
            }//on la purge de ses caractères
            //echo 'no classic mistakes, replacing special characters<br>';
            return htmlspecialchars($data); //cette fonction supprime les caractères problématiques
        }
    }

    function detectError(array $array){
        $contain=0;
        foreach($array as $index => $value){
            if($value=='error'){
                $contain++;
            }
        }
        return $contain;
    }
?>