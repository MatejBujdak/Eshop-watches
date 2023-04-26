<?php

include "php/databaze.php";
include "parts/head.php";

use main\Menu;

$menu = new Menu();

session_start();

if(empty($_SESSION["id"])){
  header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
  </head>
  <body>
  <a href="index.php">home</a> / <a href="products.php">products</a>

    <h2>Meno: <?php echo $_SESSION["name"]; ?></h2>
    <h2>Email: <?php echo $_SESSION["user_email"]; ?></h2>
    <a href="logout.php">logout</a>
    
  </body>
</html>
