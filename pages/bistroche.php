<?php

    require('../php/header.php');
    session_start();

?>

<!DOCTYPE html>

<html lang="fr">
        
    <head>
        <?php headLinks('À propos'); ?>
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

            <?php createFooter(array('Mentions légales', 'Avis des consommateurs')); ?>
            
        </main>

    </body>

</html>