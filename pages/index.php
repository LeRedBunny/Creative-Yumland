<?php 
    
    session_start(); 
    
    require_once('../php/header.php');

    if (!isset($_SESSION['logged_in'])) {
        $_SESSION['logged_in'] = false;
    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <?php headLinks('Le Bistroche') ?>
    </head>

    <body>

        <main>

            <?php createHeader(array('Carte', 'À propos', 'La Mine')); ?>

            <aside class="left">
                <form method='get' action='carte.php'>
                    <input type="text" name="filtres" placeholder="Chercher des plats" />
                </form>
            </aside>


            <section>
                <h1> Bienvenue dans la caverne... </h1>
            </section>


            <?php
                createFooter(array('Mentions légales', 'Avis des consommateurs'));
            ?>
        
        </main>

    </body>

</html>
