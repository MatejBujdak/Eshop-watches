<?php

include "databaze.php";
include "../auth_check.php";

use main\Menu;

$menu = new Menu();

if(isset($_POST['order'])){

    $menu->order($_SESSION["id"]);

    header("Location: card.php");
}

?>