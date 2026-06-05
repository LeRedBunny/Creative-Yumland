<?php

    require('../php/user_json.php');
    require('../php/header.php');
    require('../php/checkform.php');
    session_start();

    $message = '';

    if ($_POST) {
        //bloc de code à placer dans toutes les pages au fonctionnement similaire 
        $_POST=createError($_POST,'connexion');
        if(detectError($_POST)){ unset($_POST); } 
        //POST est supprimé si ses données sont corrompues
        if ($_POST) {
            $profile=getUserFromEmail($_POST['email']);
            //fin du bloc de code

            if ($profile) {
                $password = $_POST['password'];
                
                if (hash('sha256', $password) == $profile['password']) {
                    logIn($profile);
                        if(isset($_SESSION['forcing'])){
                            unset($_SESSION['forcing']);
                        }
                        if(isset($_COOKIE['forcing'])){
                            setcookie('forcing','1',time() - 60);
                        }
                    header('Location: index.php');
                } else {
                    $message = 'Mot de passe erroné.';
                    //comptage du nombre d'essais. Le temps d'attente devient de plus en plus élevé.
                        if(isset($_SESSION['forcing'])){//session sera utilisé par défaut
                            $_SESSION['forcing']++;
                        }else{
                            $_SESSION['forcing']=1;
                        }
                        //conséquence de blocage ici -> attendre x secondes
                        //récupération de la quantité d'essais de l'utilisateur
                        $wait=0;
                        if(isset($_SESSION['forcing'])){
                            $wait=$_SESSION['forcing'];
                        }

                        if($wait>3){
                            //header('Location: pleasewait.php');
                            $wait=($wait-3)*2;
                            sleep($wait);
                            }
                        //echo "<b>vous avez attendu ".$wait." secondes<b>";
                }
            } else {
                $message = "Aucun compte n'est associé à cet email.";
            }
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
                createHeader(array('Accueil', 'Carte', 'À propos', 'La Mine'));
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
