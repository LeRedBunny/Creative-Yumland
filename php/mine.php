<?php
    // Adds the new points to the given user and returns the total points

    require('user_json.php');

    $id = $_GET['user'];
    $user = getUserProfile($id);
    $user['fidelity_points'] += $_GET['points'];
    updateUser($user);
    echo $user['fidelity_points'];

?>