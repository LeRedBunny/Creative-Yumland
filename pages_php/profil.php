<?php

    require('user_json.php');
    session_start();

    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: ../index.php');
    }

    $profile = getUserProfile($_SESSION['email']);
    if (!$profile) {
        header('Location: ../index.php');
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

            <header>

                <div> 
                    <a href="../index.html" id="logo"> 
                        <h1> Le Bistroche </h1> 
                    </a>
                </div>

                <div>
                    <a href="carte.html"> Carte </a>
                    <span> | </span>
                    <a href="bistroche.html"> À propos </a>
                </div>

                <div>
                    <a href="inscription.html"> Inscription </a>
                    <span> | </span>
                    <a href="connexion.html"> Connexion </a>
                </div>
                
            </header>


            <section>

                <fieldset>
                    
                    <h2>Mon Profil</h2>


                    <!-- Informations personnelles -->
                    <h3> Informations personnelles </h3>

                    <div>
                        <p>
                            <button><img src="../images/Pickaxe.png" alt="Modifier" height="20px"></button>
                            <strong>Nom :</strong> <?= $profile['name'] ?>
                        </p>
                        <p>
                            <button><img src="../images/Pickaxe.png" alt="Modifier" height="20px"></button>
                            <strong>Prénom :</strong> <?= $profile['firstname'] ?>
                        </p>
                        <p>
                            <button><img src="../images/Pickaxe.png" alt="Modifier" height="20px"></button>
                            <strong>Mail :</strong> <?= $profile['email'] ?>
                        </p>
                        <p>
                            <button><img src="../images/Pickaxe.png" alt="Modifier" height="20px"></button>
                            <strong>Pierre préférée :</strong> <?= $profile['favorite_rock'] ?>
                        </p>
                    </div>

                    <!--Commandes-->
                    <div class="bloc">
                        <h3>Commandes</h3>
                        <ul>
                            <?php
                            
                                if (empty($profile['order_history'])) {
                                    echo "Aucune commande dans l'historique.";
                                } else {
                                    foreach($profile['order_history'] as $order) {
                                        echo "<li> Commande #".$order['order_id']." - ".date($order['date'])."</li>";
                                    }
                                }

                            ?>
                        </ul>
                    </div>

                    <div class="bloc">
                        <h3>Compte fidélité</h3>
                        <p>Points: <?= $profile['fidelity_points'] ?> points </p>
                    </div>
                
                </fieldset>
                
            </section>

            <footer>
                <div>
                    <a href="mentions_legales.html"> Mentions légales </a>
                    <span> | </span>
                    <a href="notation.html"> Notez votre expérience </a>
                </div>
            </footer>

        </main>
        
    </body>
</html>
