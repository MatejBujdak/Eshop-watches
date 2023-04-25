<?php

include "php/databaze.php";

use main\Menu;

$menu = new Menu();

session_start();

if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = $menu->info($id);
}
else{
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
  <a href="index.php">home</a>
    <h2>Meno: <?php echo $result["name"]; ?></h2>
    <h2>Email: <?php echo $result["email"]; ?></h2>
    <a href="logout.php">logout</a>
    
  </body>
</html>
