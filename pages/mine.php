<?php

    require('../php/header.php');
    require_once('../php/user_json.php');
    videurdesoiree();
    session_start();


?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <?php headLinks('Mine'); ?>
        <script src='../js/mine.js'> </script>
    </head>

    <body>
        
        <main> 

            <?php createHeader(Array('Accueil', 'Carte', 'À propos')); ?>

            <section> 

                <fieldset>

                    <h2> Minez pour obtenir des minerais rares et des points de fidélité ! </h2>

                    <?php

                        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

                            $user = getUserProfile($_SESSION['user_id']);

                            echo '<div id="fidelity_points">Points actuels: '.$user['fidelity_points'].'pts</div>';
                            echo '<br> <div id="notification"> </div>';
                            echo '<br> <br> <button onclick="mine('.$_SESSION['user_id'].');"> <img src="../images/Pickaxe.png" alt="Miner" id="mine_button_img"> </button>';

                        } else {
                            echo '<div> Vous n\'êtes pas connecté. <br> <a href="connexion.php"> Connectez-vous </a> pour commencer à miner! </div>';
                        }

                    ?>

                </fieldset>


            </section>

            <?php createFooter(Array('Mentions légales', 'Avis des consommateurs')); ?>

        </main>

    </body>

</html>