<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <?php
        $_SESSION["plat"]="Pomme d'or";
        header("Location: ../commander.php");
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
