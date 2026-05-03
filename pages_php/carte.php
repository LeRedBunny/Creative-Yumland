<?php

    require('user_json.php');
    require('header.php');
    session_start();

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../images/icon.png">
        <link rel="stylesheet" href="../css/style2.css">
        <title> Carte </title>
        <script src="../js/carte.js"></script>
    </head>

    <body>


        <main>

            <?php
                createHeader(array('Accueil', 'À propos'));
            ?>
            
        

            <aside class="bbno">
                <form action="#" method="GET">
                    <input type="text" placeholder="Filtrer les plats" name="filtre" id="filters"> <br>
                    <select name="tri" id="tri">    <!-- A finir d'implémenter-->
                        <option value="">Aucun</option>
                        <option value="prix">Prix</option>
                        <option value="durete">Dureté</option>
                    </select>

                    <button type="button" placeholder="Rechercher" onclick='filter()'></button>
                    <!-- no submit, or the page reloads and the filter doesn't apply-->
                </form>
            </aside>
            <section>
                <div class="container" id="box">
                    
                </div>
            </section>

            
        </main>
    </body>

</html>