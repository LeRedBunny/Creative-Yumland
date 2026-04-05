<?php

    require('commandes_json.php');
    require('header.php');
    require('getapikey.php');

    session_start();

    // Vérification des paramètres
    if (!isset($_GET['transaction'], $_GET['montant'], $_GET['vendeur'], $_GET['control'])) {
        die("Erreur : paramètres manquants");
    }

    $transaction = $_GET['transaction'];
    $montant = $_GET['montant'];
    $vendeur = $_GET['vendeur'];
    $statut = $_GET['status'] ?? $_GET['statut'] ?? '';
    $control_recu = $_GET['control'];

    $api_key = getAPIKey($vendeur);

    // Vérif Api
    if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
        die("Erreur API KEY");
    }

    // normalement ça recalcule le hash
    $control_calcule = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");

    // Vérif
    if ($control_calcule != $control_recu) {
        $titre = 'Données corrompues';
        $statut = 'corrupted';
    } elseif ($statut == 'accepted') {
        $titre = 'Paiement accepté';
    } else {
        $titre = 'Paiement refusé';
    }
?>

<!DOCTYPE html>

<html lang='fr'>

    <head>
        <link rel='stylesheet' href='../css/connexion_inscription_profil.css'>
        <link rel="icon" href="../images/icon.png">
        <title> <?= $titre ?> </title>
    </head>

    <body> 

        <main> 

            <?php createHeader(array('Accueil', 'Carte', 'À propos')); ?>

            <section>

                <fieldset>

                    <?php 

                        if ($statut == 'corrupted') {
                            echo '<h2> Les données du paiement ont été corrompues, veuillez réessayer. </h2>';
                            echo '<a href="panier.php"> Renvenir au panier </a>';
                        } elseif ($statut == 'denied') {
                            echo '<h2> Le paiement a été refusé, veuillez réessayer. </h2>';
                            echo '<a href="panier.php"> Renvenir au panier </a>';
                        } else {

                            $id = createOrder($_SESSION['panier'], $_SESSION['order_type'], $_SESSION['user_id']);
                            $_SESSION['panier'] = array();
                            echo '<h1> Commande#'.$id.' </h1>';
                            echo '<h2> Le paiement a été accepté! </h2>';
                            echo '<a href="index.php"> Renvenir à l\'accueil </a>';
                            echo '<br> <a href="commande?order='.$id.'.php"> voir la commande </a>';
                        }

                    ?>

                </fieldset>

            </section>
        
        </main>

    </body>

</html>