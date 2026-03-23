<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=*, initial-scale=1.0">
        <link rel="icon" href="../images/icon.png">
        <link rel="stylesheet" href="../css/carte.css">
        <title> Créateur de carte</title>
    </head>

    <body>

        <main>

            <header>

                <div> 
                    <a href="../index.html" id="logo"> 
                        <h1> Le Bistroche </h1> 
                    </a>
                </div>

                <div>
                    <a href="../index.html"> Accueil </a>
                    <span> | </span>
                    <a href="bistroche.html"> À propos </a>
                </div>

                
                <div>
                    <a href="inscription.html"> Inscription </a>
                    <span> | </span>
                    <a href="connexion.html"> Connexion </a>
                </div>

            </header>
            
            <?php  //récupération des données de POST, et ajout au JSON, puis écriture de ttes les données du json
            
            function cardinal($tab) : int{  //renvoie la quantité d'éléments initialisés d'un tableau
                $return=0;
                foreach($tab as $index => $value){
                    if(isset($tab[$index])){
                        $return++;
                    }
                }
                return $return;
            }
                    
            $caracplats=["image","prix","pierres","description","mots_clefs"];
            
                //vérification des paramètres de POST
                $belong;
                foreach($_POST as $id){
                    //vérification que chaque nom de données existe
                    $belong=0;
                    foreach($caracplats as $index => $value){
                        if($id==$value){    // Le nom existe, on le retire de la liste des noms acceptés
                            $belong=1;
                            unset($caracplats[$index]);
                        }
                    }
                    if($belong==0){ //le nom n'existe pas, on supprime la donnée
                        unset($_POST[$id]);
                    }
                }
                if(cardinal($caracplats==0)){   //toutes les variables sont présentes dans le $post /peut être altérés pour remplacer les champs vides
                    $carte=json_decode(file_get_contents("../json/carte.json"),true);    //décodage des données du tableau carte actuel
                    //ajout des données de post dans le tableau carte
                    foreach($_POST as $index => $value){
                        $carte[$_POST[$name]][$index]=$value;
                    }
                    //encodage dans le json
                    file_put_contents("../json/carte.json", json_encode($carte, JSON_PRETTY_PRINT));
                }
            ?>

            <section>
                <h5>Carte actuelle</h5>
                <div class="container">
                    <?php 
                    

                    $plat=json_decode(file_get_contents("carte.json"));
                    foreach($plat as $nom_plat => $tab){
                        //deux manières de faire " à l'intérieur de "_" : '' à l'intérieur, ou mettre un \ devant
                        //imprime la div contenant un nouveau plat
                        echo
                            "<div class='box'>
                                <img src=\"".$tab['src']."\"alt\"".$nom_plat."\" width='50' height='50'>
                                <div>Bouchée de minerai</div>
                            </div>";
                    }
                    ?>
                </div>
            </section>

            <h4><a href="ajouteurplats.php">Ajouter un plat?</a></h4>
        </main>
    </body>

</html>