<?php //session_destroy();

    require('user_json.php');
    require('header.php');
    session_start();

    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/panier.css">
</head>
<body>
     <main>

            <?php
                createHeader(array('Accueil', 'Carte', 'À propos'));
            ?>

        <?php
        /*foreach($_SESSION["panier"] as $index => $tab){
            echo '$_SESSION'."[\"panier\"][".$index."]:<ol><br>";
            foreach($tab as $id => $value){
                echo "<li>"."$tab"."[".$id."]=".$value."</li>";
            }
            echo"</ol>";}*/
            echo "<section>";
            echo "<ul>";
            echo "<li><h1>Panier</h1></li>";
            $prixtot=0;
            foreach($_SESSION["panier"] as $index => $tab){
                echo "<li><fieldset>";
                echo "<form action=\"#\" method=\"POST\">
                        <input type=\"hidden\" value=\"-1\" name=\"ajout.suppression\" id=\"a.s\"/>
                        <input type=\"hidden\" value=\"".$index."\" name=\"numtab\" id=\"numtab\"/>
                        <button type=\"submit\"><img src=\"../images/deletebutton.png\" alt=\"supprimer commande\" width=\"10\"></button>
                    </form>";
                echo "<ol>";
                    echo "<li>".$tab['name']."</li>";
                    echo "<li>Quantité:".$tab['amount']."</li>";
                    echo "<li>Prix:".$tab["prix"]."</li>";
                echo"</ol></fieldset></li>";
                $prixtot+=$tab["prix"]*$tab['amount'];
            }
            echo "</ul>";
            echo "</section>";
            echo"<div>Prix total: ".$prixtot." €</div>";
        ?>
        <form action="#" method="POST">
            <textarea name="comment" id="comment" placeholder="commentaires"></textarea></br>
            <textarea name="adress" id="adress" value=<?php //valeur stockée dans les données de l'utilisateur?>></textarea></br>
            <input type="submit" value="Payer"/>
        </form>
    </main>
</body>
</html>