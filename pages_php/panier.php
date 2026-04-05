<?php session_start();//session_destroy();
    if($_SESSION['logged_in'] = false){
        header("Location: connexion.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
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
                    <a href="bistroche.html"> À propos </a>
                </div>

                
                <div>
                    <a href="inscription.html"> Inscription </a>
                    <span> | </span>
                    <a href="connexion.html"> Connexion </a>
                </div>

            </header>
    <h1>Panier</h1>
        <?php
        /*foreach($_SESSION["panier"] as $index => $tab){
            echo '$_SESSION'."[\"panier\"][".$index."]:<ol><br>";
            foreach($tab as $id => $value){
                echo "<li>"."$tab"."[".$id."]=".$value."</li>";
            }
            echo"</ol>";}*/
            $prixtot=0;
            foreach($_SESSION["panier"] as $index => $tab){
                echo "<fieldset> <ol>";
                    echo "<li>".$tab['name']."</li>";
                    echo "<li>Quantité:".$tab['amount']."</li>";
                    echo "<li>Prix:".$tab["prix"]."</li>";
                echo"</ol></fieldset>";
                $prixtot+=$tab["prix"]*$tab['amount'];
            }
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