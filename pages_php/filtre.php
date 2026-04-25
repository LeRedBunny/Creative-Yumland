<?php
    $carte = json_decode(file_get_contents("../json/carte.json"), true);
    $filtre="???";//voir comment les données du filtre sont transmises
    $filtre=strtolower($filtres);   //la string contenant les filtres est passé en tout minuscules
    $filtres=explode(" ",$filtre);  //on éclate cette string en tableau pour pouvoir la parcourir facilement
    $cartefiltree;
    $fit;

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
        if($fit!=1){    //si le plat ne contient pas de mot-clef correspondant aux filtres, on cherche dans les ingrédients
            foreach($content["pierres"] as $id => $value){   //pour chaque ingrédient du plat
                foreach($filtres as $id2 => $f){                //pour chaque filtre appliqué par l'utilisateur
                    if($f == $value){                           //si le filtre est le même que l'ingrédient
                        $fit=1;         //alors ce plat appartient aux plats filtrées
                        break;          //on arrête la boucle pour plus d'efficacité
                    }
                }
            }
        }
        if($fit >= 1){
            $cartefiltree[$index]=$content;
        }
        
    }
    //méthode de retour?
    //options: création d'un fichier json et retour de son adresse
    //retour du tableau direct (encodage?)
    return 1;
?>