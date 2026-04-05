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
        
        if (str_starts_with($_POST['order'], 'a') || str_starts_with($_POST['order'], 't')) {
            // Bouton annuler/terminer

            $id = intval(substr($_POST['order'], 1));

            updateOrderStatus($id, str_starts_with($_POST['order'],'a') ? -1 : 1);

            foreach($_SESSION['in_charge'] as $index => $order) {
                if ($order == $id) {
                    unset($_SESSION['in_charge'][$index]);
                    break;
                }
            }
        } else {
            updateOrderStatus($_POST['order']);                 // Bouton prendre en charge
            $_SESSION['in_charge'][] = $_POST['order'];
        }
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

                    <?php

                        $STATUSES = array('Payée', 'En préparation', 'Préparée', 'En livraison', 'Livrée');
                        $ORDER_TYPES = array(
                            'emporter' => 'À emporter',
                            'livraison' => 'Livraison',
                            'sur place' => 'Sur place'
                        );

                        if ($_SESSION['status'] == 'admin') {
                            $orders = getOrders();

                            echo '<ul>';
                            foreach($orders as $order) {
                                echo '<li> Commande #'.$order['id'].' - '.$ORDER_TYPES[$order['type']].' - Statut : '.$STATUSES[$order['status']].'</li>';
                            }
                            echo '</ul>';
                        } else {

                            echo '<form method="post"> <h3> Commandes en cours </h3> <ul>';

                            if (!$_SESSION['in_charge']) {
                                echo 'Aucune commande en cours.';
                            } else {
                                foreach ($_SESSION['in_charge'] as $order) {
                                    echo '<li> Commande #'.$order;
                                    echo '<button type="submit" name="order" value="a'.$order.'"> Annuler  </input>';
                                    echo '<button type="submit" name="order" value="t'.$order.'"> Terminé  </input>';
                                    echo '</li>';

                                    // Afficher l'adresse de livraison ou les plats selon le statut de l'utilisateur
                                }
                            }

                            echo '</ul> <h3> Commandes à prendre en charge </h3> <ul>';

                            if ($_SESSION['status'] == 'livreur') {
                                $orders = getOrdersByStatus(2, 'livraison');
                            } else {
                                $orders = getOrdersByStatus(0);
                            }

                            if (!$orders) {
                                echo 'Aucune commande à prendre en charge';
                            } else {
                                foreach ($orders as $order) {
                                    echo '<li> Commande #'.$order['id'];
                                    echo '<button type="submit" name="order" value="'.$order['id'].'"> Prendre en charge  </input>';
                                    echo '</li>';
                                }
                            }

                            echo '</ul> </form>';

                        }
                    
                    ?>

                </div>

            </section>

        </main>

    </body>

</html>