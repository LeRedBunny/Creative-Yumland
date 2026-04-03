<?php

    require('user_json.php');
    session_start();

    logOut();
    header('Location: ../index.php');

?>