<?php

include "database.php";
include "parts/head.php";

use main\dp;

$menu = new dp();
session_start();

if(isset($_POST['email'])){
    $menu-> newsletter($_POST['email']);
    $_SESSION['email_created'] = true;
    header("Location:../index.php");
}

?>



