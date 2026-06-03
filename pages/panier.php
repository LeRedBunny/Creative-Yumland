<?php

    require('../php/commandes_json.php');
    require('../php/header.php');
    session_start();

    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
    }

    // Remove an item from the cart or go to payment
    if ($_POST) {

        $_SESSION['order_type'] = $_POST['type'];
        $_SESSION['price'] = $_POST['price'];
        header('Location: paiement.php');

    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <?php headLinks('Panier'); ?>
        <script src='../js/panier.js'> </script>
        <script src='../js/cookie.js'> </script>
    </head>

    <body onload='displayCart();'>


        <main>

            <?php
                createHeader(array('Accueil', 'Carte', 'À propos'));
            ?>

            <section>

                <fieldset>

                    <h1> Panier </h1>
                    <table id='cart'> </table>

                    <div id='order'> </div>

                </fieldset>

            </section>
            
        </main>
    </body>

</html>