<?php 
    require('user_json.php');
    require('header.php');
    session_start();

    
    if ($_GET) {                    // Coming from carte.php
        $carte = json_decode(file_get_contents("../json/carte.json"), true);
        $nomplat = $_GET["plat"];
        if (isset($carte[$nomplat])) { 
            $plat=$carte[$nomplat];
        } else {
            header('Location: carte.php');
        }
    } 
    elseif ($_POST) {               // Add to the cart
        
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

            $name = $_POST['name'];
            if (isset($_SESSION['panier'][$name])) {
                $_SESSION['panier'][$name] += $_POST['amount'];
            } else {
                $_SESSION['panier'][$name] = $_POST['amount'];
            }

            header('Location: carte.php');
        } else {
            header('Location: connexion.php');
        }
        
    } 
?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../images/icon.png">
        <title> <?= $nomplat ?> </title>
        <link rel="stylesheet" href="../css/connexion_inscription_profil.css">
    </head>
    
    <body>

        <main>

            <?php
                createHeader(array('Accueil', 'Carte', 'À propos'));
            ?>

            <section>
                <fieldset>

                    <!--2) écrire les données dans le tableau à partir des noms des données-->
                    <h3> <?=$nomplat?> </h3> 
                    
                    <div> <?=$plat["description"]?> </div>
                    <div> Prix : <?=$plat["prix"]?>€ </div>

                    <br>

                    <ul> 
                        Liste des roches :
                        <?php
                            foreach($plat["pierres"] as $word){
                                echo "<li>".$word."</li>";
                            }
                        ?>
                    </ul>

                    <!--3) formulaire demandant les données supplémentaires de la commande -->
                    <form action="plat.php" method="POST">
                        <input type="hidden" value=<?= "\"".$nomplat."\"" ?> name="name" id="name"/>
                        <input type="number" value="1" min="1" max="99" name="amount" id="amount"/>
                        <br>
                        <input type="submit" value="Ajouter au panier">
                    </form>

                </fieldset>

            </section>

        </main>

    </body>

</html>