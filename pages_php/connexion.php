<?php

    require('user_json.php');
    session_start();


    $profile = getUserProfile($_POST['email']);
    $message = '';

    if (!isset($profile)) {
        $message = "Aucun compte n'est associé à cet email.";
    } else {
        $password = $_POST['password'];
        
        if (hash('sha256', $password) == $profile['password']) {
            loadProfileIntoSession($profile);
            header('Location: ../index.php');
        } else {
            $message = 'Mot de passe érroné.';
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

            <header>

                <div> 
                    <a href="../index.html" id="logo"> 
                        <h1> Le Bistroche </h1> 
                    </a>
                </div>

                <div>
                    <a href="../index.html"> Accueil </a>
                    <span> | </span>
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
                    <form name="connexion" method="post" action="connexion.php">
                        
                            <h2>Connexion</h2>
                                <div class="div1">
                                    <input type="email" id="pEmail" required>
                                    <label for="pEmail">Email</label>
                                </div>
                                <br>
                                <div class="div1">
                                    <input type="password" id="password" required>
                                    <label for="password">Mot de passe</label>
                                </div>
                                <br>
                                <button type="submit" class="login">Connexion</button>
                                <button type="reset" class="login">Effacer</button>
                                <br><br>
                        
                            Vous n'avez pas de compte ? 
                            <a href="inscription.html"> Cliquer ici </a>

                            <?= $message ?>

                    </form>
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
