<?php

    require('../php/user_json.php');
    require('../php/header.php');
    session_start();

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <?php headLinks('Carte'); ?>
        <script src="../js/carte.js" defer></script>
    </head>

    <body onload='filter(); showhide();'>


        <main>

            <?php
                createHeader(array('Accueil', 'À propos'));
            ?>
            
        

            <aside class="left">
                <form action="#" method="GET">
                    <input type="text" placeholder="Filtrer les plats" name="filtres" id="filters"> <br>
                    <select name="tri" id="tri" onclick="showhide()">    <!-- A finir d'implémenter-->
                        <option value="0">Aucun</option>
                        <option value="prix">Prix</option>
                        <option value="durete">Dureté</option>
                    </select>
                    <select name="typetri" id="typetri">
                        <option value="1">Croissant</option>
                        <option value="2">Décroissant</option>
                    </select>
                    <button type="button" placeholder="Rechercher" onclick='filter()'>Rechercher</button>
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