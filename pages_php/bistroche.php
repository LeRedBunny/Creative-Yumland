<?php

    require('header.php');
    session_start();

?>

<!DOCTYPE html>

<html lang="fr">
        
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> À propos </title>
        <link rel="stylesheet" href="../css/connexion_inscription_profil.css">
        <link rel="icon" href="../images/icon.png">
    </head>

    <body>
        
        <main>

            <?php createHeader(array('Accueil', 'Carte')); ?>

            <section>

                <fieldset>

                    <h1> À propos du Bistroche </h1>

                    <p>
                        Au Bistroche, nous avons pour mission de vous faire découvrir la cuisine sous-terraine et sous-estimée de la roche.
                        Venez profiter de notre savoir-faire et de notre sélection unique et variée de minéraux raffinés !
                    </p>

                    <br>
                    <br>

                    <h3> Nous trouver : </h3>
                    <a href="https://maps.app.goo.gl/QyFUhFwGbLNBi5Bc7" target="_blank"> 79 Chem. de Halage, 95220 Herblay-sur-Seine  </a>

                    <br>
                    <br>

                    <h3> Nous contacter : </h3>
                    <div>
                        Tél: 36 30
                        <br>
                        Email: bistroche@bistroche.fr
                    </div>

                </fieldset>

            </section>

            <?php createFooter(array('Mentions légales', 'Notez votre expérience')); ?>
            
        </main>

    </body>

</html>