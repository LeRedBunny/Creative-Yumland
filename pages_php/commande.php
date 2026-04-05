<?php

    require('commandes_json.php');
    require('header.php');
    session_start();

    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
    }


    // Check if the user is an admin or the owner of the profile
    if ($_GET && $_SESSION['logged_in'] && $_SESSION['logged_in'] && $_SESSION['status'] == 'admin') {
        $admin = true;
    } else {
        $admin = false;
    }


    if (!$_GET) {
        header('Location: index.php');
    }

    $id = intval($_GET['order']);
    $order = getOrder($id);
    if (!$order || (!in_array($order, getUserOrders($order['client_id'])) && $_SESSION['user_id'] != $order['client_id'])) {
        header('Location: index.php');
    }

    // If the user wants to copy the order into their cart
    if ($_POST) {
        echo 'hi';  
        foreach($order['contents'] as $name => $amount) {
            if (isset($_SESSION['panier'][$name])) {
                $_SESSION['panier'][$name] += $amount;
            } else {
                $_SESSION['panier'][$name] = $amount;
            }
        }
        header('Location: panier.php');
    }

?>

<!DOCTYPE html>

<html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Commande #<?= $order['id'] ?> </title>
        <link rel="stylesheet" href="../css/connexion_inscription_profil.css">
        <link rel="icon" href="../images/icon.png">
    </head>

    <body>
        
        <main>

            <?php
                createHeader(array('Accueil', 'Carte', 'À propos'));
            ?>

            <section>

                <fieldset>  
                    
                    <h1> Commande #<?= $id ?> </h1>
                    <h3> <?= date('l jS \of F Y h:i:s A', $order['date']) ?> </h3>
                    <?= ($admin) ? '<h3> <a href="profil.php?id='.$order['client_id'].'"> Utilisateur #'.$order['client_id'].' </a> </h3>' : '' ?>

                    <?php
                    
                    $price = 0;
                    echo '<h3> Contenu : </h3> <ul>';
                    foreach($order['contents'] as $dish => $amount) {
                        echo '<li> <a href="plat.php?plat='.$dish.'"> '.$dish.'</a> ✕ '.$amount.' </li>';
                        $price += getDish($dish)['prix'] * $amount;
                    }
                    echo '</ul>';
                    echo 'Prix : '.$price.'€';

                    if ($admin == false) {
                        echo '<form method="post"> <input type="submit" id="submit" name="submit" value="Copier la commande"> </form>';
                    }

                    ?>

                </fieldset>
                
            </section>

            <?php
                createFooter(array('Mentions légales', 'Notez votre expérience'));
            ?>

        </main>
        
    </body>
    
</html>
