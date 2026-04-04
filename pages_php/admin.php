<?php 

    require('header.php');
    require('user_json.php');
    session_start();

    if (!$_SESSION['logged_in'] || $_SESSION['status'] != 'admin') {
        header('Location: index.php');
    }

    if ($_POST) {

        foreach($_POST as $id => $new_status) {
            $profile = array(
                'id' => intval($id),
                'status' => $new_status
            );
            updateUser($profile);
        }
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

                            echo '<form method="post">';
                            echo '<input type="submit" value="Sauvegarder les changements">';
                            foreach($users as $user) {
                                echo '<li>';
                                echo 'Utilisateur #'.$user['id'].' - '.$user['firstname'].' '.$user['name'];

                                echo '<select name="'.$user['id'].'">';
                                foreach($STATUSES as $code => $status) {
                                    echo '<option value="'.$code.'" '.(($user['status'] == $code) ? 'selected' : '').'> '.$status.' </option>';
                                }
                                echo '</select>';

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