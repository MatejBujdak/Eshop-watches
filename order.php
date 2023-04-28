<?php

include "database.php";
include "auth_check.php";

use main\dp;

$menu = new dp();

if(isset($_POST['order'])){

    $order_status = $menu->order($_SESSION["id"]);
    if($order_status){
        header("Location: card.php?order=1");
    }else{
        header("Location: card.php?order=0");
    }
    
}

?>