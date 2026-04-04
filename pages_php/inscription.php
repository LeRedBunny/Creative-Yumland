<?php 
    
    require('user_json.php');
    require('header.php');
    session_start();

    if ($_POST) {

        $newUser = array();
        foreach($_POST as $key => $value) {
            $newUser[$key] = $value;
        }
        $newUser['password'] = hash('sha256', $newUser['password'], false);
        $newUser['status'] = 'client';
        $newUser['favorite_rock'] = 'Aucune';
        $newUser['order_history'] = array();
        $newUser['fidelity_points'] = 0;

        $success = writeNewUser($newUser);
        $message = '';
        if ($success) {
            logIn($newUser);
            header("Location: index.php");
        } else {
            $message = 'Un utilisateur avec cet email existe déjà.';
        }
        
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

            <?php
                createHeader(array('Accueil', 'Carte', 'À propos'));
            ?>
                    
            
            <section>
                <fieldset> 

                    <form name="Inscription" method="post" action="inscription.php">

                        <h2>Inscription</h2>

                        <?php
                            if (isset($message)) {
                                echo '<div class="error_message">'.$message.'</div>';
                            }
                        ?>

                        <br>
                        <div class="div1">
                            <input type="text" id="nom" name="name" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                            <label for="nom">Nom</label>
                        </div>
                        <br>
                        <div class="div1">
                            <input type="text" id="prenom" name="firstname" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>" required>
                            <label for="prenom">Prénom</label>
                        </div>
                        <br>
                        <div class="div1">
                            <input type="email" id="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                            <label for="email">Email</label>
                        </div>
                        <br>
                        <div class="div1">
                            <input type="password" id="password" name="password" required>
                            <label for="password">Mot de passe</label>
                        </div>
                        <br>
                        <div class="div1">
                            <input type="tel" id="tel" name="tel" pattern="[0-9]{10}" value="<?= isset($_POST['tel']) ? $_POST['tel'] : '' ?>" required>
                            <label for="tel">Téléphone</label>
                        </div>
                        
                        <br><br>
                        <button type="submit" class="login">Creer un compte</button>
                        <button type="reset" class="login">Effacer</button>
                        <br><br>


                        Vous avez déjà un compte ?  
                        <a href="connexion.php">Cliquez ici</a>

                    
                    </form>
                </fieldset>
            </section>

            <?php
                createFooter(array('Mentions légales', 'Notez votre expérience'));
            ?>
            
        </main>

    </body>

</html>
