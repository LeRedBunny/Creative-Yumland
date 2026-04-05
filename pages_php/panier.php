<?php

    require('user_json.php');
    require('header.php');
    session_start();

    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
    }

    if ($_POST) {

        $plat = $_POST['plat'];

        if ($plat == 'pay') {
            // Procédure de paiement
            header('Location: paiement.php'); // ?
        }

        unset($_SESSION['panier'][$plat]);

    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=*, initial-scale=1.0">
        <link rel="icon" href="../images/icon.png">
        <link rel="stylesheet" href="../css/connexion_inscription_profil.css">
        <title> Panier </title>
    </head>

    <body>


        <main>

            <?php
                createHeader(array('Accueil', 'Carte', 'À propos'));
            ?>

            <section>

                <fieldset>

                    <table>
                    <h1> Panier </h1>
                    <form method="post">
                    
                    <?php 

                        $prixtot=0;

                        if ($_SESSION['panier']) {

                            foreach($_SESSION["panier"] as $index => $tab){
                                echo "<tr>";

                                echo '<td>';
                                echo '</td>';

                                echo '<td> '.$tab['name'].'</td>';
                                echo '<td>'.$tab['amount'].' x '.$tab['prix'].'€ </td>';
                                
                                


                                echo '<td> <button type="submit" id="plat" name="plat" value="'.$index.'"> Retirer </button> </td>';
                                
                                $prixtot += $tab["prix"] * $tab['amount'];
                            }
                            echo "</table>";

                            echo"<div>Prix total: ".$prixtot." €</div>";
                            echo "<button type='submit' value='pay' id='plat' name='plat'> Commander </button>";
                                
                        } else {
                            echo 'Votre panier est vide. <a href="carte.php"> Remplissez le vite! </a>';
                        }
                        
                    ?>


                    </form>

                </fieldset>

            </section>
            
        </main>
    </body>

</html>