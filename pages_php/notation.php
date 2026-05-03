<?php

    require('header.php');
    session_start();

    if (!$_SESSION['logged_in']) {
        header('Location: connexion.php');
    }

    if ($_POST) {
        // Remplir
    }

?>

<!DOCTYPE html>

<html lang="fr">
        
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notation</title>
        <link rel="stylesheet" href="../css/notation.css">
        <!--bibliothèque d'icones-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="../images/icon.png">
    </head>

    <body>
        <main>

            <?php createHeader(array('Accueil', 'Carte', 'À propos')); ?>

            <section>
                <fieldset>

                    <h2>Notez votre expérience!</h2>

                    <form method="post">

                        <div>
                            <input type="text" name="name" placeholder="Nom"/>
                        </div>

                        <div class="rating">
                            <input type="radio" id="1star" name="rating" value="1" />
                            <label class="star" for="1star" title="1 star">★</label>
                            <input type="radio" id="2star" name="rating" value="2" />
                            <label class="star" for="2star" title="2 star">★</label>
                            <input type="radio" id="3star" name="rating" value="3" />
                            <label class="star" for="3star" title="3 star">★</label>
                            <input type="radio" id="4star" name="rating" value="4" />
                            <label class="star" for="4star" title="4 star">★</label>
                            <input type="radio" id="5star" name="rating" value="5" />
                            <label class="star" for="5star" title="5 star">★</label>
                        </div>

                        <div>
                            <textarea name="comment" placeholder="Commentaires" rows="5" cols="50"></textarea>
                        </div>

                        <div>
                            <input type="submit" value="Envoyer"/>
                        </div>

                    </form>
                </fieldset>
            </section>

            <?php createFooter(array('Mentions légales', 'Notez votre expérience')); ?>

        </main>
    </body>
</html>