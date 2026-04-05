<?php

    require('commandes_json.php');
    require('header.php');
    session_start();

    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
    }

    if ($_POST) {

        $plat = $_POST['plat'];

        if ($plat == 'pay') {
            $_SESSION['order_type'] = $_POST['type'];
            $_SESSION['price'] = $_POST['price'];
            header('Location: paiement.php');
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
                    
                    <?php 

                        $prixtot=0;

                        if ($_SESSION['panier']) {

                            echo '<form method="post">';

                            foreach($_SESSION["panier"] as $dish_name => $amount){

                                $price = getDish($dish_name)['prix'];

                                echo "<tr>";

                                echo '<td>';
                                echo '</td>';

                                echo '<td> '.$dish_name.'</td>';
                                echo '<td>'.$amount.' ✕ '.$price.'€ </td>';
                                
                                


                                echo '<td> <button type="submit" id="plat" name="plat" value="'.$dish_name.'"> Retirer </button> </td>';
                                
                                $prixtot += $price * $amount;
                            }
                            echo "</table>";

                            echo"<br> <br> <div>Prix total: ".$prixtot." €</div>";
                            echo "<select id='type' name='type'>
                                      <option value='livraison' selected> En livraison </option>
                                      <option value='emporter'> À emporter </option>
                                      <option value='sur place'> Sur place </option>
                                  </select>";
                            echo '<input type="hidden" name="price" id="price" value="'.$prixtot.'">';
                            echo "<button type='submit' value='pay' id='plat' name='plat'> Commander </button>";
                            
                            echo '</form>'; 
                                
                        } else {
                            echo 'Votre panier est vide. <a href="carte.php"> Remplissez le vite! </a>';
                        }
                        
                    ?>



                </fieldset>

            </section>
            
        </main>
    </body>

</html>