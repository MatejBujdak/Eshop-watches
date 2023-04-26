<?php
include "../parts/head.php";
include "../auth_check.php";
include "../php/databaze.php";

use main\Menu;

$menu = new Menu();


$card = $menu -> show($_SESSION["id"]);
$customer = $menu -> info($_SESSION["id"]);

?>

<body>
    <h1>SHOPPING CARD</h1>
    <a href="../index.php">home</a> / <a href="../products.php">products</a>

    <h2> Tvoje položky v košíku:</h2>

    <ol>
      <?php

      $total_prize = 0;

      foreach ($card as $product) {

          $total_prize += $product['prize'] * $product['quantity'];

          echo "<li> Nazov produktu: <b>" . $product['name'] . ",</b> Cena <b>" . $product['prize'] ." €</b>, Množstvo <b>". $product['quantity']. '</b><br>

            <b>
            <a href="add.php?item_id='.$product['item_id'].'">Add</a>  
            <a href="reduce.php?item_id='.$product['item_id'].'">Reduce</a>  
            <a href="delete.php?item_id='.$product['item_id'].'">Delete</a>   
            </b>
            </li> <br>';

      }

      echo "<h3>Celková suma: ". $total_prize . " € </h3>";
      echo "<p>Vaša adresa zásielky je : ". $customer['adresa'] ." </p>";  
    
      ?>

    <form action="order.php" method="post">
      <button type="submit" name="order">Dokončiť objednávku</button>
    </form>

    </ol>

    <br>

  </body>
</html>
