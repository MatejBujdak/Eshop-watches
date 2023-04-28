<?php

include "database.php";
include "auth_check.php";

use main\dp;

$menu = new dp();

if(isset($_GET['item_id'])){
    $menu->delete($_SESSION['id'],$_GET['item_id']);
    header("Location: card.php");
}


?>
