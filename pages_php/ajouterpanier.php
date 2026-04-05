<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php
    foreach($_POST as $index => $tab){
            echo "$_POST"."[\"panier\"][".$index."]=".$tab."<br>";
        }
        $_SESSION["panier"][]=$_POST;
        header("Location: carte.php");
    ?>
</html>
