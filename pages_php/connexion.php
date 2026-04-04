<?php

    require('user_json.php');
    require('header.php');
    session_start();
    
    if ($_POST) {

        $profile = getUserProfile($_POST['email']);

        if ($profile) {
            $password = $_POST['password'];
            
            if (hash('sha256', $password) == $profile['password']) {
                logIn($profile);
                header('Location: index.php');
            } else {
                $message = 'Mot de passe erroné.';
            }
        } else {
            $message = "Aucun compte n'est associé à cet email.";
        }

    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
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
                    <form name="connexion" method="post" action="connexion.php">
                        
                        <h2>Connexion</h2>
                        
                        <?php
                            if (isset($message)) {
                                echo '<div class="error_message">'.$message.'</div>';
                            }
                        ?>

                        <div class="div1">
                            <input type="email" id="email" name='email' value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                            <label for="email">Email</label>
                        </div>
                        <br>
                        <div class="div1">
                            <input type="password" id="password" name='password' required>
                            <label for="password">Mot de passe</label>
                        </div>
                        <br>
                        <button type="submit" class="login">Connexion</button>
                        <button type="reset" class="login">Effacer</button>
                        <br><br>
                
                        Vous n'avez pas de compte ? 
                        <a href="inscription.php"> Cliquer ici </a>

                    </form>
                </fieldset>
            </section>

            <?php
                createFooter(array('Mentions légales', 'Notez votre expérience'));
            ?>

        </main>

    </body>

</html>
