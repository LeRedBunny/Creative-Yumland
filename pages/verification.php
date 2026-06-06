<?php

    require('../php/commandes_json.php');
    require('../php/header.php');
    require('../php/getapikey.php');
    require_once('../php/user_json.php');
    videurdesoiree();
    session_start();


    // En venant directement de paiement.php (quand le prix est 0€)
    if (!$_GET) {
        $pay = false;
        $titre = 'Merci pour votre commande!';
        $statut = 'accepted';
        $montant = $_POST['montant'];
    }

    // En revenant de CY Bank
    else {
        $pay = true;
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
    }
    

    // Cette condition permet de ne pas répéter la commande en rafraichissant la page
    $cart = getCart();
    if ($cart) {
        
        $id = createOrder($cart, $_SESSION['order_type'], $_SESSION['user_id'], $montant);
        resetCart();
        
        // Points de fidélité (1pt = 1 centime)

        $user = getUserProfile($_SESSION['user_id']);
        if ($user) {
            $user['fidelity_points'] += intval($montant - 100 * ($_SESSION['price'] - $montant)); // Points gagnés - Points utilisés
            updateUser($user);
        }
    } else {
        header('Location: index.php');
    }

?>

<!DOCTYPE html>

<html lang='fr'>

    <head>
        <?php headLinks($titre); ?>
    </head>

    <body> 

        <main> 

            <?php createHeader(array('Accueil', 'Carte', 'À propos', 'La Mine')); ?>

            <section>

                <fieldset>

                    <?php 

                        if ($pay) {
                            if ($statut == 'corrupted') {
                            echo '<h2> Les données du paiement ont été corrompues, veuillez réessayer. </h2>';
                            echo '<a href="panier.php"> Revenir au panier </a>';
                            } 
                            elseif ($statut == 'denied') {
                                echo '<h2> Le paiement a été refusé, veuillez réessayer. </h2>';
                                echo '<a href="panier.php"> Revenir au panier </a>';
                            } 
                            else {  

                                echo '<h1> Commande #'.$id.'</h1>';
                                echo '<h2> Le paiement a été accepté! </h2>';
                                echo 'Vous avez obtenu '.intval($montant).' points de fidélité ! <br>';
                                echo '<a href="index.php"> Revenir à l\'accueil </a> <br>';
                                echo '<a href="commande.php?order='.$id.'"> Voir la commande </a>';
                            }
                        } else {
                            echo '<h1> Commande #'.$id.'</h1>';
                            echo '<h2> Merci pour votre commande ! </h2>';
                            if ($user) {
                                echo 'Il vous reste '.$user['fidelity_points'].' points de fidélité !';
                            }
                            echo '<br> <a href="index.php"> Revenir à l\'accueil </a> <br>';
                            echo '<a href="commande.php?order='.$id.'"> Voir la commande </a>';
                        }

                    ?>

                </fieldset>

            </section>
        
        </main>

    </body>

</html>