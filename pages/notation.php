<?php

    require('../php/header.php');
    require('../php/commandes_json.php');
    require('../php/avis_json.php');
    session_start();

    if (!$_SESSION['logged_in']) {
        header('Location: connexion.php');
    }

    // When sending the review
    if ($_POST) {
        writeReview(intval($_POST['order_id']), intval($_SESSION['user_id']), intval($_POST['rating']), $_POST['comment']);
        $_POST['message'] = 'Merci d\'avoir laissé votre avis!';
        header('Location: commande.php?order='.$_POST['order_id']);
    }
    
    if (!isset($_GET['order'])) {
        header('Location: index.php');
    }

    $order_id = $_GET['order'];
    $order = getOrder($order_id);
    if (!$order || $order['client_id'] != $_SESSION['user_id']) {
        header('Location: index.php');
    } else if (getReview($order_id)) {
        $_POST['message'] = 'Vous avez déjà noté cette commande.';
        header('Location: commande.php?order='.$order_id);
    }
?>

<!DOCTYPE html>

<html lang="fr">
        
    <head>
        <?php headLinks('Notation'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script>

            function countCharacters (textboxId, counterId, maxLength) {
                /* Counts the characters in the text area with the given ID, and removes the excess characters */

                let textbox = document.getElementById(textboxId);
                let counter = document.getElementById(counterId);

                let length = textbox.value.length;
                if (length > maxLength) {
                    textbox.value = textbox.value.slice(0, maxLength);
                    length = maxLength;
                }
                counter.innerHTML = length.toString() + '/' + maxLength.toString();
            }

        </script>
    </head>

    <body>
        <main>

            <?php createHeader(array('Accueil', 'Carte', 'À propos')); ?>

            <section>
                <fieldset>
                        
                    <h2> Commande #<?= $order_id ?> </h2>

                    <ul>
                        <?php
                            foreach($order['contents'] as $dish => $amount) {
                                echo '<li> <a href="plat.php?plat='.$dish.'"> '.$dish.'</a> ✕ '.$amount.' </li>';
                            }
                        ?>
                    </ul>

                    <form method="post">

                        <div class="rating">
                            <input type="radio" id="1star" name="rating" value="1" />
                            <label class="star" for="1star" title="1 star">★</label>
                            <input type="radio" id="2star" name="rating" value="2" />
                            <label class="star" for="2star" title="2 star">★</label>
                            <input type="radio" id="3star" name="rating" value="3" />
                            <label class="star" for="3star" title="3 star">★</label>
                            <input type="radio" id="4star" name="rating" value="4" />
                            <label class="star" for="4star" title="4 star">★</label>
                            <input type="radio" id="5star" name="rating" value="5" checked />
                            <label class="star" for="5star" title="5 star">★</label>
                        </div>

                        <div>
                            <textarea oninput='countCharacters("comment", "character_count", 250);' name="comment" placeholder="Commentaires" id='comment' rows="10" cols="50"></textarea>
                            <div id='character_count'> 0/250 </div>
                        </div>

                        <div>
                            <input type='hidden' name='order_id' value='<?= $order_id ?>'>
                            <input type="submit" value="Envoyer"/>
                        </div>

                    </form>
                </fieldset>
            </section>

            <?php createFooter(array('Mentions légales', 'Avis des consommateurs')); ?>

        </main>
    </body>
</html>