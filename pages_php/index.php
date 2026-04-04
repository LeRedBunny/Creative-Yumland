<?php 
    
    session_start(); 
    
    require('header.php');

    if (!isset($_SESSION['logged_in'])) {
        $_SESSION['logged_in'] = false;
    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Le Bistroche</title>
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="icon" href="../images/icon.png">
    </head>

    <body>

        <main>

            <?php
                createHeader(array('Carte', 'À propos'));
            ?>


            <aside class="left">
                <form>
                    <input type="text" name="search" placeholder="Chercher des plats" />
                </form>
            </aside>


            <section>
                <h1> Bienvenue dans la caverne... </h1>
            </section>


            <?php
                createFooter(array('Mentions légales', 'Notez votre expérience'));
            ?>
        
        </main>

    </body>

</html>
