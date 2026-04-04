<?php 

    require('header.php');
    session_start();

    if (!$_SESSION['logged_in'] || $_SESSION['status'] != 'admin') {
        header('Location: index.php');
    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Administrateur </title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" href="../images/icon.png">
    </head>

    <body>

        <main>
    
            <?php createHeader(array('Accueil', 'Carte', 'À propos')); ?>

            <section>
                <!--Liste des utilisateurs-->
                <div>
                    <h1>Liste des clients</h1>
                    <ul>
                        <li><a href="profil.html" target="_blank">Maxime Basto</a></li>
                        <li><a href="profil.html" target="_blank">Alexi Toutou</a></li>
                        <li><a href="profil.html" target="_blank">Grégoire Marie</a></li>
                        <li><a href="profil.html" target="_blank">LuLu Yam</a></li>
                        <li><a href="profil.html" target="_blank">Mark Fishback</a></li>
                    </ul>
                </div>
            </section>

        </main>

    </body>

</html>