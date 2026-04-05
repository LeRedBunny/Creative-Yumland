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
        $id = intval($_GET['id']);
    } else {
        $admin = false;
        $id = $_SESSION['user_id'];
    }

    // If an admin udated the user's fidelity points
    if ($_POST) {
        $new_info = array(
            'id' => $id,
            'status' => $_POST['status'],
            'fidelity_points' => $_POST['fidelity_points']
        );
        updateUser($new_info);
    }

    $profile = getUserProfile($id);
    if (!$profile) {
        header('Location: index.php');
    }


?>

<!DOCTYPE html>

<html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil</title>
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
                    
                    <?php 

                        $STATUSES = array(
                                'client' => 'Client',
                                'admin' => 'Administrateur',
                                'livreur' => 'Livreur',
                                'cuisinier' => 'Cuisinier',
                                'bloque' => 'Bloqué'
                            );
                        



                        if (!$admin) {
                            
                            echo '<h2> 
                                    <a href="modifier_profil.php">
                                        <button>
                                            <img src="../images/Pickaxe.png" alt="Modifier" height="20px">
                                        </button>
                                    </a> 
                                    Mon Profil
                                </h2>';
                        } else {
                            echo '<form method="post">';
                            echo '<h2> Profil #'.$profile['id'].' : ';
                            echo '<select name="status">';
                            foreach($STATUSES as $code => $status) {
                                echo '<option value="'.$code.'" '.(($profile['status'] == $code) ? 'selected' : '').'> '.$status.' </option>';
                            }
                            echo '</select> </h2>';
                        }
                    ?>
                        


                    <!-- Informations personnelles -->
                    <h3> Informations personnelles </h3>

                    <div>
                        <p>
                            <strong>Nom :</strong> <?= $profile['name'] ?>
                        </p>
                        <p>
                            <strong>Prénom :</strong> <?= $profile['firstname'] ?>
                        </p>
                        <p>
                            <strong>Mail :</strong> <?= $profile['email'] ?>
                        </p>
                        <p>
                            <strong>Pierre préférée :</strong> <?= $profile['favorite_rock'] ?>
                        </p>
                        <p>
                            <strong>Numéro de téléphone :</strong> <?= $profile['tel'] ?>
                        </p>
                        <p>
                            <strong>Adresse :</strong> <?= getAddress($profile['address'], $profile['code'], $profile['city']) ?>
                        </p>
                    </div>

                    <!--Commandes-->
                    <div class="bloc">
                        <h3>Commandes</h3>
                        <ul>
                            <?php
                            
                                $orders = getUserOrders($profile['id']);
                                if (empty($orders)) {
                                    echo "Aucune commande dans l'historique.";
                                } else {
                                    foreach($orders as $order) {
                                        echo "<li> Commande #".$order['id']." - ".date($order['date'])."</li>";
                                    }
                                }

                            ?>
                        </ul>
                    </div>

                    <div class="bloc">
                        <h3>Compte fidélité</h3>

                        <?php

                            if ($admin) {
                                echo '<input type="number" name="fidelity_points" id="fidelity_points" placeholder="Points fidélité" value="'.$profile["fidelity_points"].'">';
                                echo '<button type="submit" value="Sauvegarder"> Sauvegarder </button>';
                            } else {
                                echo '<p>Points: '.$profile["fidelity_points"].' points </p>';
                            }

                        ?>
                    </div>


                    <?php
                        if (!$admin) {
                            echo '<div>
                                      <a href="modifier_mdp.php"> <button> Modifier le mot de passe </button> </a>
                                  </div>';
                            } else {
                                echo '</form>';
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
