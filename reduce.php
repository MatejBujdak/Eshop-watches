<?php

include "database.php";
include "auth_check.php";

use main\Data;

$functions = new Data();

if(isset($_GET['item_id'])){
    $functions->remove($_SESSION['id'],$_GET['item_id']);
    header("Location: card.php");
}


?>
