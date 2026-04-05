<?php 

    require('header.php');
    require('user_json.php');
    session_start();

    if (!$_SESSION['logged_in'] || $_SESSION['status'] != 'admin') {
        header('Location: index.php');
    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Administrateur </title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" href="../images/icon.png">
    </head>

    <body>

        <main>
    
            <?php createHeader(array('Accueil', 'Carte', 'À propos')); ?>

            <section>
                <!--Liste des utilisateurs-->
                <div>

                    <h1>Liste des clients</h1>

                    <ul>

                        <?php

                            $STATUSES = array(
                                'client' => 'Client',
                                'admin' => 'Administrateur',
                                'livreur' => 'Livreur',
                                'cuisinier' => 'Cuisinier'
                            );


                            $users = getUserData();

                            echo '<ul>';
                            foreach($users as $user) {
                                echo '<li> <a href="profil.php?id='.$user['id'].'">';
                                echo 'Utilisateur #'.$user['id'].' </a> - '.$user['firstname'].' '.$user['name'].'</li>';

                            }
                            echo '</ul>';
                        
                        ?>
                    </ul>

                </div>

            </section>

        </main>

    </body>

</html>