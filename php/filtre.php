<?php
$carte = json_decode(file_get_contents("../json/carte.json"), true);
$filtre=$_GET['filtres'] ?? ''; //extrait la string depuis GET (via l'url), la rend vide si erreur
if($filtre)
//appel de la fonction formateur
$filtre=formateur($filtre);
// le retour est une string formatée, qu'on peut éclater en tableau de filtres
$filtres=explode(" ",$filtre);     //on éclate cette string en tableau pour pouvoir la parcourir facilement
$cartefiltree = [];
$fit = 0;

//vérification que filtres n'est pas vide (profite du formatage)
$count=0;
$empties=0;
foreach($filtres as $index => $string){
    $count++;
    if(!$string){
        $empties++;
    }
}
if($count != $empties){ //not all strings are empty
    foreach($carte as $index => $content){  //pour chaque plat de la carte
        $fit=0; //par défaut, le plat n'appartient pas à la carte filtrée
        foreach($content["mots_clefs"] as $id => $value){   //pour chaque mot clef du plat
            foreach($filtres as $id2 => $f){                //pour chaque filtre appliqué par l'utilisateur
                if($f == $value){                           //si le filtre est le même que le mot clefs
                    $fit=1;         //alors ce plat appartient aux plats filtrées
                    break;          //on arrête la boucle pour plus d'efficacité
                }
            }
        }
        /*Filtres des ingrédients, inutiles avec le nouveau format
        if($fit!=1){    //si le plat ne contient pas de mot-clef correspondant aux filtres, on cherche dans les ingrédients
            foreach($content["pierres"] as $id => $value){   //pour chaque ingrédient du plat
                foreach($filtres as $id2 => $f){                //pour chaque filtre appliqué par l'utilisateur
                    if(is_array($value)){
                        foreach($value as $id3 => $component){
                            if($f == $component){   //si l'un des mots de l'ingrédient correspond au filtre
                                $fit=1;         //alors ce plat appartient aux plats filtrées
                                break;  
                            }
                        }
                    } else 
                        if($f == $value){   //si le filtre est le même que l'ingrédient
                        $fit=1;         //alors ce plat appartient aux plats filtrées
                        break;          //on arrête la boucle pour plus d'efficacité
                    }
                }
            }
        }*/
        if($fit >= 1){
            $cartefiltree[$index]=$content;
        }
        
    }
    echo json_encode($cartefiltree);    //renvoie la carte filtrée
} else {
    echo json_encode($carte);           //si aucun filtre n'est appliqué, renvoie la carte non-filtrée
}


    function formateur( string $string ){

        //str_replace("valeur cherchée","valeur de remplacement","sujet du remplacement")

        //formatage des caractères spéciaux
        $letters=array("e" => array("é","è","ê","ë"), "a" => array("à","â",'ä'), "u" => array("ù","û",'ü'), "o" => array("ô","ò",'ö'),
                ' ' => array("-","_",","),      //caractères "espaces"
                ' ' => array("0",'1','2','3','4','5','6','7','8','9'));
        foreach($letters as $index => $value){
            $string=str_replace($value,$index,$string);
        }
        //formatage en minuscules (maintenant que les caractères ne peuvent être que des lettres)
        $string=strtolower($string); 

        return $string;
    };
?>