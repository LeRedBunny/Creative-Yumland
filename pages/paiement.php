<?php

    require("../php/header.php");
    require_once('../php/user_json.php');
    videurdesoiree();
    require('../php/getapikey.php');
    require('../php/get_url.php');
    session_start();

    $user = getUserProfile($_SESSION['user_id']);

    $pay = true; // To know if it needs to take you to CY Bank or if the price is 0€
    $montant = $_SESSION['price'];
    if ($user) {
        $reduc = $user['fidelity_points'] / 100;
        if ($reduc >= $montant) {
            $pay = false;
            $reduc = $montant;
            $montant = 0;
        } else {
            $montant -= $reduc;
        }
    }

    $order = $_SESSION['panier'];
    $transaction = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 12); //Identifiant généré aléatoirement
    $vendeur = "MI-4_G";
    $retour = getDomain()."/pages/verification.php";
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
        <?php headLinks('Paiement'); ?>
    </head>

    <body> 

        <main> 

            <?php createHeader(array('Accueil', 'Carte', 'À propos', 'La Mine')); ?>

            <section>

                <fieldset>

                    <h2> Le prix total de votre commande est <?= $_SESSION['price'] ?>€ </h2>
                    <?php
                        if ($user) {
                            echo 'Vous avez actuellement '.$user['fidelity_points'].' points de fidélité.';
                            if ($user['fidelity_points']) {
                                echo '<br> Vous gagnerez donc '.($reduc).'€ sur votre commande!';
                            }
                        } else {
                            echo 'Une erreur est survenue dans le chargement de vos points de fidélité.';
                        }
                    ?>
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


                    <form id="paymentForm" action=<?= ($pay) ? "https://www.plateforme-smc.fr/cybank/index.php" : "verification.php"; ?> method="POST">
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
