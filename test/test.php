<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once('../php/checkform.php');

    echo 'helllooooow rodldfls<br>';
    
    foreach($_POST as $index => $value){
        echo '$_POST['.$index.']='.htmlspecialchars($value).'<br>';
    }
    createError($_POST,'connexion');

    if(detectError($_POST)){ unset($_POST); }
    echo 'goodbbiieiei worodldl<br>'; 
    /*$array=$_POST;
    $array['email'] = '<script>';
    $array['password'] = 'validpassword';



    

    if(detectError($array)){
        echo 'error has been successfully detected<br><br>';
    } else{
        echo 'no error has been detected<br><br>';
    }


    $array = createError($array,'connexion');
    foreach($array as $index => $value){
        echo '$array['.$index.']='.$value.'<br>';
    }
    if(detectError($array)){
        echo 'error has been successfully detected<br>';
    } else{
        echo 'no error has been detected<br>';
    }*/

    ?>
</body>
</html>
