<?php session_start(); //$_SESSION["plat"]="Savouroche";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Bistroche-Ajouter au panier</title>
    <link rel="stylesheet" href="../css/style.css">
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
        <?php
        //-1) récupérer le json, puis le tableau du json correspondant à l'id contenu dans $_session
            $carte=json_decode(file_get_contents("../json/carte.json"),true);
            $nomplat=$_SESSION["plat"];
            $plat=$carte[$nomplat];
        ?>
        <section>
            <fieldset>
                <!--2) écrire les données dans le tableau à partir des noms des données-->
                <h3>
                    <?=$nomplat?>
                </h3> <?=$plat["prix"]?>€
                <div><?=$plat["description"]?></div>
                <ul>liste des roches
                <?php
                    foreach($plat["pierres"] as $index => $word){
                        echo "<li>".$word."</li>";
                    }
                ?>
                </ul>
                <!--3) formulaire demandant les données supplémentaires de la commande -->
                <form action="ajouterpanier.php" method="POST">
                    <input type="hidden" value=<?php echo "\"".$nomplat."\"";?> name="name" id="name"/>
                    <input type="hidden" value=<?php echo "\"".$plat["prix"]."\"";?> name="prix" id="prix"/>
                    <input type="hidden" value="1" name="ajout.suppression" id="a.s"/>
                    <label for="amount">Quantité</label>
                    <input type="number" value="1" min="1" max="99" name="amount" id="amount"/> <br>
                    <br>
                    <input type="submit" value="Ajouter au panier">
                </form>
            </fieldset>
        </section>
    </main>
</body>
</html>