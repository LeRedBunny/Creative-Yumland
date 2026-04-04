<?php

    require('header.php');
    require('user_json.php');
    session_start();

    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
    }

    $profile = getUserProfile($_SESSION['user_id']);
    if (!$profile) {
        header('Location: index.php');
    }

    if ($_POST) {

        if (hash('sha256', $_POST['password'], false) != $profile['password']) {
            $message = 'Mot de passe erroné.';
        } else {
            $profile['password'] = hash('sha256', $_POST['new_password'], false);
            updateUser($profile);
            header('Location: index.php');
        }

    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='../css/connexion_inscription_profil.css'>
        <link rel="icon" href="../images/icon.png">
        <title> Mot de passe </title>
    </head>

    <body>
        <main>

            <?php
                createHeader(array('Accueil', 'Carte', 'À propos'));
            ?>


            <section>

                <form method='post'>

                    <fieldset>

                        <h2> Modifier le mot de passe </h2>

                        <?php
                            if (isset($message)) {
                                echo '<div class="error_message">'.$message.'</div>';
                            }
                        ?>
                        <br>

                        <div>
                            <input type="password" id="password" name="password" placeholder='Mot de passe actuel' required>
                        </div>
                        <br>

                        <div>
                            <input type="password" id="new_password" name="new_password" placeholder='Nouveau Mot de passe' required>
                        </div>
                        <br>
                        
                        
                        <button type="submit"> Sauvegarder </button>

                    </fieldset>

                </form>

            </section>
            

            <?php
                createFooter(array('Mentions légales', 'Notez votre expérience'));
            ?>
            
        <main>
    </body>

</html>