<?php

    session_start(); 

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['client_id'] = $_POST['id'];
    $_SESSION['logged_in'] = true;

    header('Location: ../index.php');

?>