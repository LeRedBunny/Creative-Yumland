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
        $_POST['id'] = $profile['id'];
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
        <title> Modifier le profil </title>
    </head>

    <body>
        <main>

            <?php
                createHeader(array('Accueil', 'Carte', 'À propos'));
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
                            <input type="text" id="address" name="address" placeholder='Adresse' value="<?= $profile['address'] ?>" required>
                        </div>
                        <br>

                        <div>
                            <input type="text" id="city" name="city" placeholder='Ville' value="<?= $profile['city'] ?>" required>
                        </div>
                        <br>

                        <div>
                            <input type='number' id='code' name='code' placeholder='Code postal' value='<?= $profile['code'] ?>' required>
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