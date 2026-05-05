<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=*, initial-scale=1.0">
        <link rel="icon" href="../images/icon.png">
        <link rel="stylesheet" href="../css/admin.css">
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
                <fieldset>
                    <h4>Ajouter un plat?</h4>
                    <form action="inventaire_plats.php" method="POST">
                        <label for="nomdeplat"></label> <br>
                        <input type="text" name="nomdeplat"/> <br>
                        <label for="prix"></label> <br>
                        <input type="text" name="prix"/> <br>
                        <label for="nomdeplat"></label> <br>
                        <input type="text" name="nomdeplat"/> <br>
                        <input type="submit" value="Envoyer">
                    </form>
                </fieldset>    
            </section>
        </main>
    </body>

</html>