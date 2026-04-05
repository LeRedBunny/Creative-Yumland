<?php

    require("header.php");
    require('user_json.php');
    require('getapikey.php');
    session_start();

    $montant = $_SESSION['price'];
    $order = $_SESSION['panier'];
    $transaction = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 12); //Identifiant généré aléatoirement
    $vendeur = "MI-4_G";
    $retour = "http://localhost/pages_php/verification.php";
    $api_key = getAPIKey($vendeur);

    // Vérif API key
    if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
        die("Erreur API KEY");
    }

    $control = md5($api_key."#".$transaction."#".$montant."#".$vendeur."#".$retour."#");
?>

<!DOCTYPE html>

<html lang='fr'>

    <head>
        <link rel='stylesheet' href='../css/connexion_inscription_profil.css'>
        <link rel="icon" href="../images/icon.png">
        <title> Paiement </title>
    </head>

    <body> 

        <main> 

            <?php createHeader(array('Accueil', 'Carte', 'À propos')); ?>

            <section>

                <fieldset>

                    <h2> Le prix total de votre commande est <?= $montant ?>€ </h2>
                    <br>
                    <br>

                    <?php
                    
                        
                        if ($_SESSION['order_type'] == 'sur place') {
                            echo '<h3> Elle vous sera servie sur place. </h3>';
                        } elseif ($_SESSION['order_type'] == 'emporter') {
                            echo '<h3> Vous pourrez venir la récupérer sur place. </h3>';
                        } else {
                            echo '<h3> Elle sera livrée au '.getAddress($_SESSION['address'], $_SESSION['code'], $_SESSION['city']).'. </h3>';
                        }

                    ?>


                    <form id="paymentForm" action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
                        <input type="hidden" name="transaction" value="<?= $transaction ?>">
                        <input type="hidden" name="montant" value="<?= $montant ?>">
                        <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
                        <input type="hidden" name="retour" value="<?= $retour ?>">
                        <input type="hidden" name="control" value="<?= $control ?>">
                        <input type="submit" value="Accéder à la plateforme de paiement">
                    </form>

                </fieldset>

            </section>
        
        </main>

    </body>

</html>
