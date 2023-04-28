<?php

include "database.php";
include "auth_check.php";

use main\dp;

$menu = new dp();

if(isset($_GET['item_id'])){
    $menu->add($_SESSION['id'],$_GET['item_id']);

    if(isset($_GET['card']) && $_GET['card'] == 'card.php'){
       header("Location: card.php");
    }else{
       $_SESSION['add'] = true;
       header("Location: products.php"); 
    }
   
}


?>
