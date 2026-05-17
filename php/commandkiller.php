<?php 
    
    require('commandes_json.php');
    
    
    //get user ID
    if(isset($_GET['email'])){
        $email=$_GET["email"];
        $user=getUserFromEmail($email);

        $id=$user["id"];
        echo "user id is ".$id;
        //get commands
        $commands=getOrders($id);
        $email;
        $counter=0;


        foreach($commands as $index => $command){//trouver et détruire toute commande passée par l'utilisateur bloqué
            echo "loop number: ".$index;
            if($command["client_id"] == $id){
                echo '<br>$commands['.$index."] has been deleted";
                unset($commands[$index]);
                $counter++;
            }
        }
        echo $counter;
        file_put_contents(ORDER_JSON_PATH, json_encode($commands, JSON_PRETTY_PRINT));
    } else{
        echo '-1';
    }
?>