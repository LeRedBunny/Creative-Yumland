<?php 

    require('commandes_json.php');
    require('header.php');
    session_start();

    if (!$_SESSION['logged_in'] || $_SESSION['status'] == 'client') {
        header('Location: index.php');
    }

    if ($_SESSION['status'] != 'admin' && !isset($_SESSION['in_charge'])) {
        $_SESSION['in_charge'] = array();
    }

    if ($_POST) {
        $_SESSION['in_charge'][] = $_POST['order'];
        updateOrderStatus($_POST['order']);
    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Commandes </title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" href="../images/icon.png">
    </head>

    <body>

        <main>
    
            <?php createHeader(array('Accueil', 'Carte', 'À propos')); ?>

            <section>
                <!--Liste des utilisateurs-->
                <div>
                    <h1> Liste des commandes </h1>
                    <ul>
                        <?php

                            $STATUSES = array('Payée', 'En préparation', 'Préparée', 'En livraison', 'Livrée');

                            if ($_SESSION['status'] == 'livreur') {
                                $orders = ordersByStatus('2', 'livraison');
                            } elseif ($_SESSION['status'] == 'cuisinier') {
                            $orders = ordersByStatus('0');
                            } else {
                                $orders = getOrders();
                            }

                            echo '<form method="post"';
                            foreach($orders as $order) {
                                echo '<li>';
                                echo 'Commande #'.$order['id'];
                                if ($_SESSION['status'] == 'admin') {
                                    echo ' - Statut : '.$STATUSES[$order['status']];
                                } else {
                                    if (in_array($order['id'], $_SESSION['in_charge'])) {
                                        echo '<button> Prise en charge </button>';
                                    } else {
                                        echo '<button type="submit" name="order" value="'.$order['id'].'"> Prendre en charge  </input>';
                                    }
                                }

                                echo '</li>';
                            }
                            echo '</form>';
                        
                        ?>
                    </ul>
                </div>
            </section>

        </main>

    </body>

</html>