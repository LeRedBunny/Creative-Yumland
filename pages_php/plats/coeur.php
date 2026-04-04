<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <?php
        $_SESSION["plat"]="Coeur de corail";
        header("Location: ../commander.php");
    ?>
</html>
