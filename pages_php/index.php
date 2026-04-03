<?php 
    
    session_start(); 

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
                require('header.php');
            ?>


            <aside class="left">
                <form>
                    <input type="text" name="search" placeholder="Chercher des plats" />
                </form>
            </aside>


            <section>
                <h1> Bienvenue dans la caverne... </h1>
            </section>


            <footer>
                <div>
                    <a href="mentions_legales.php"> Mentions légales </a>
                    <span> | </span>
                    <a href="notation.php"> Notez votre expérience </a>
                </div>
            </footer>
        
        </main>

    </body>

</html>
