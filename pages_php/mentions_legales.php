<?php

    require('header.php');
    session_start();

?>

<!DOCTYPE html>

<html lang="fr">
        
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Mentions légales </title>
        <link rel="stylesheet" href="../css/connexion_inscription_profil.css">
        <link rel="icon" href="../images/icon.png">
    </head>

    <body>
        
        <main>

            <?php createHeader(array('Accueil', 'Carte', 'À propos')); ?>

            <section>

                <fieldset>

                    <h2> Propriété </h2>
                    <div>
                        <h3> Ce site est la propriété du Bistroche  : </h3>
                        79 Chem. de Halage, 95220 Herblay-sur-Seine 
                        <br>
                        Tél: 36 30
                    </div>

                    <br>

                    <h2> Développement </h2>
                    <div> 
                        <h3>Site réalisé par : </h3>
                        <ul>
                            <li> Grégoire MARIE </li>
                            <li> Maxime BASTO </li>
                            <li> Alexi TOUTOU </li>
                        </ul>
                    </div>

                    <br> 

                    <h2> Propriété Intellectuelle : </h2>
                    <div>
                            Toutes les images utilisées sont, sauf mention explicite, propriétés d'entités non créditées et en aucun cas affiliées au Bistroche.
                    </div>
                    

                </fieldset>

            </section>

            <?php createFooter(array('Mentions légales', 'Notez votre expérience')); ?>
            
        </main>

    </body>

</html>