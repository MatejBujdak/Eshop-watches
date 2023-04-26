<?php

include "databaze.php";
include "../auth_check.php";

use main\Menu;

$menu = new Menu();

if(isset($_GET['item_id'])){
    $menu->delete($_SESSION['id'],$_GET['item_id']);
    header("Location: card.php");
}


?>
