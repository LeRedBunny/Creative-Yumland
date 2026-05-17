<?php

    require('commandes_json.php');

    $id = $_GET['order'];
    $order = getOrder($id);
    if (!$order) {
        echo 'Une erreur est survenue';
        die();
    }

    // Check if the order still hasn't been taken by a chef
    if ($order['status'] == 0) {
        $success = deleteOrder($id);
    } else {
        echo 'La commande a déjà été prise en charge';
    }
    
    if (isset($success) && $success) {
        $user = getUserProfile($order['client_id']);
        if ($user) {
            $user['fidelity_points'] += $order['price'] * 99;
            updateUser($user);
        }
        echo 'Commande annulée avec succès.';
    }


?>
