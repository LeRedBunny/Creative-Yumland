<?php

    require('header.php');
    require('user_json.php');
    session_start();

    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
    }

    $profile = getUserProfile($_SESSION['email']);
    if (!$profile) {
        header('Location: index.php');
    }

    if ($_POST) {
        $_POST['email'] = $profile['email'];
        updateUser($_POST);
        header('Location: profil.php');
    }

?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='../css/connexion_inscription_profil.css'>
        <link rel="icon" href="../images/icon.png">
        <title> Modifier </title>
    </head>

    <body>
        <main>

            <?php
                createHeader(array('Carte', 'À propos'));
            ?>


            <section>

                <form method='post'>

                    <fieldset>

                        <h2> Modifier le profil </h2>

                        <div>
                            <input type="text" id="nom" name="name" placeholder='Nom' value="<?= $profile['name'] ?>" required>
                        </div>
                        <br>

                        <div>
                            <input type="text" id="prenom" name="firstname" placeholder='Prénom' value="<?= $profile['firstname'] ?>" required>
                        </div>
                        <br>
                        
                        <div> 
                            <input type="tel" id="tel" name="tel" pattern="[0-9]{10}" placeholder='Numéro de téléphone' value="<?= $profile['tel'] ?>" required>
                        </div>
                        <br>

                        <div> 
                            Pierre préférée :
                            <select name="favorite_rock" id="favorite_rock">
                                <?php
                                    $rocks = array('Rubis', 'Saphir', 'Améthyste', 'Émeraude');

                                    echo '<option value="Aucune"> Aucune </option>';
                                    foreach($rocks as $rock) {
                                        echo '<option value="'.$rock.'" '.(($profile['favorite_rock'] == $rock) ? 'selected' : '').'> '.$rock.' </option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <br>

                        <div>
                            <a href='modifier_mdp.php'> <button> Modifier le mot de passe </button> </a>
                        </div>

                        <br>

                        <button type="submit"> Sauvegarder </button>
                        <button type="reset"> Réinitialiser </button>

                    </fieldset>

                </form>

            </section>
            

            <?php
                createFooter(array('Mentions légales', 'Notez votre expérience'));
            ?>
            
        <main>
    </body>

</html>