<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <?php
        $_SESSION["plat"]="Glace à l'émeraude";
        header("Location: ../commander.php");
    ?>
</html>
