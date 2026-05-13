<?php

    require('../php/header.php');
    require('../php/avis_json.php');
    session_start();

?>
<!DOCTYPE html>

<html lang="fr">

    <head>
        <?php headLinks('Avis'); ?>
    </head>

    <body>
        
        <main>

            <?php createHeader(array('Accueil', 'Carte', 'À propos')); ?>

            <section> 

                <!-- Lister les avis, triés par date ou par note (ou les deux ensembles?) -->

            </section>

            <?php createFooter(array('Mentions légales')) ?>

        </main>

    </body>

</html>