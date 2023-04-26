<?php
include "../parts/head.php";
include "../auth_check.php";
include "../php/databaze.php";

use main\Menu;

$menu = new Menu();


$card = $menu -> show($_SESSION["id"]);


?>

<body>
    <h1>SHOPPING CARD</h1>
    <a href="../index.php">home</a> / <a href="../products.php">products</a>

    <h2> Toto su tvoje aktualne položky:</h2>

    <ol>
      <?php

      foreach ($card as $menuItem) {

          echo "<li> Nazov produktu: <b>" . $menuItem['name'] . ",</b> Cena <b>" . $menuItem['prize'] ."</b>, Množstvo <b>". $menuItem['quantity']. '</b><br>

            <a href="add.php?item_id='.$menuItem['item_id'].'">Add</a>
            <a href="reduce.php?item_id='.$menuItem['item_id'].'">reduce</a>
            <a href="delete.php?item_id='.$menuItem['item_id'].'">Delete</a> 
            
            </li>';

      }
    
      ?>

    </ol>

    <br>

  </body>
</html>
