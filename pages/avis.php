<?php

    require('../php/header.php');
    require('../php/avis_json.php');
    session_start();

?>
<!DOCTYPE html>


<html lang="fr">

    <head>
        <?php headLinks('Avis'); ?>
        <script src='../js/avis.js'> </script>
        <script src='../js/get_url.js'> </script>
    </head>


    <body onload='console.log(getReviews());'>
        
        <main>

            <?php createHeader(array('Accueil', 'Carte', 'À propos')); ?>

            <section> 

                

            </section>

            <?php createFooter(array('Mentions légales')) ?>

        </main>

    </body>

</html>