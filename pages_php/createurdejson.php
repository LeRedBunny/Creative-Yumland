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

            <h4>Ajouter un plat?</h4>
            <form action="#" method="POST">
                <label for="nomdeplat"></label>
                <input type="text" name="nomdeplat"/>
                <label for="prix"></label>
                <input type="text" name="prix"/>
                <label for="nomdeplat"></label>
                <input type="text" name="nomdeplat"/>
            </form>
        </main>
    </body>

</html>