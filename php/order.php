<?php

include "databaze.php";
include "../auth_check.php";

use main\Menu;

$menu = new Menu();

if(isset($_POST['order'])){

    $order_status = $menu->order($_SESSION["id"]);
    if($order_status){
        header("Location: card.php?order=1");
    }else{
        header("Location: card.php?order=0");
    }
    
}

?>