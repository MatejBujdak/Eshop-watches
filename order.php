<?php

include "database.php";
include "auth_check.php";

use main\Data;

$functions = new Data();

if(isset($_POST['order'])){

    $order_status = $functions->order($_SESSION["id"]);
    
    if(!$order_status){
        $errors = $functions->getErrors();
        foreach($errors as $error) {
            echo $error . "<br>";
            
    }}

    if($order_status){
        header("Location: card.php?order=1");
    }else{
        header("Location: card.php?order=0");
    }
    
}

?>