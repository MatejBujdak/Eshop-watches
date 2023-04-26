<?php

include "../php/databaze.php";
include "../parts/head.php";

use main\Menu;

$menu = new Menu();
session_start();

if(isset($_POST['email'])){
    $menu-> newsletter($_POST['email']);
    $_SESSION['email_created'] = true;
    header("Location:../index.php");
}

?>



