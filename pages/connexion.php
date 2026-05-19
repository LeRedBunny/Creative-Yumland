<?php

    require('../php/user_json.php');
    require('../php/header.php');
    require('../php/checkform.php');
    session_start();

    $message = '';
    
    if ($_POST) {
        //à tester 
        $_POST=$detecterror($POST,'connexion');
        
        $profile = getUserFromEmail($_POST['email']);

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
        <?php headLinks('Connexion'); ?>
        <script src='../js/see_password.js'> </script>
        <script src='../js/check_form.js'> </script>
    </head>

    <body>

        <main>

            <?php
                createHeader(array('Accueil', 'Carte', 'À propos'));
            ?>

            <section>
                

                <fieldset>
                    <form name="connexion" method="post" action="connexion.php" id='form'>
                        
                        <h2>Connexion</h2>
                        
                        <div id='error_message'> <?= $message ?> </div>

                        <div class="div1">
                            <input type="email" id="email" name='email' value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                            <label for="email">Email</label>
                        </div>
                        <br>
                        <div class="div1">
                            <input type="password" id="password" name='password' required>
                            <label for="password">Mot de passe</label>
                            <button type='button' onclick='seePassword();'> Voir </button>
                            
                        </div>
                        <br>
                        <button onclick='checkForm("form");' class="login">Connexion</button>
                        <button type="reset" class="login">Effacer</button>
                        <br><br>
                
                        Vous n'avez pas de compte ? 
                        <a href="inscription.php"> Cliquer ici </a>

                    </form>
                </fieldset>
            </section>

            <?php
                createFooter(array('Mentions légales', 'Avis des consommateurs'));
            ?>

        </main>

    </body>

</html>
