<?php
    /* C'est assez moche comme solution mais j'avais besoin du prix des plats dans le js */
    echo json_decode(file_get_contents('../json/carte.json'), true)[$_GET['item']]['prix'];
?>