<?php 
    
    require('user_json.php');
    session_start(); 
    

    if ($_POST) {

        $newUser = array();
        foreach($_POST as $key => $value) {
            $newUser[$key] = $value;
        }
        $newUser['password'] = hash('sha256', $newUser['password'], false);
        $newUser['role'] = 'client';
        $newUser['favorite_rock'] = '?';

        writeNewUser($newUser);

        header("Location: init_session.php"); // changer ça
    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
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
                <form name="Inscription" method="post" action="inscription.php">
                    <h2>Inscription</h2>
                    <br>
                    <div class="div1">
                        <input type="text" id="nom" name="name" required>
                        <label for="nom">Nom</label>
                    </div>
                    <br>
                    <div class="div1">
                        <input type="text" id="prenom" name="firstname" required>
                        <label for="prenom">Prénom</label>
                    </div>
                    <br>
                    <div class="div1">
                        <input type="email" id="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <br>
                    <div class="div1">
                        <input type="password" id="password" name="password" required>
                        <label for="password">Mot de passe</label>
                    </div>
                    <br>
                    <div class="div1">
                        <input type="tel" id="tel" name="tel" pattern="[0-9]{10}" required>
                        <label for="tel">Téléphone</label>
                    </div>
                    
                    <br><br>
                    <button type="submit" class="login">Creer un compte</button>
                    <button type="reset" class="login">Effacer</button>
                    <br><br>


                    Vous avez déjà un compte ?  
                    <a href="connexion.html">Cliquez ici</a>

                
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
