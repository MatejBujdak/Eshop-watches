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

    <h2> Your items in the cart:</h2>

    <ol>
      <?php

      $total_prize = 0;

      foreach ($card as $product) {

          $total_prize += $product['prize'] * $product['quantity'];

          echo "<li> Product name: <b>" . $product['name'] . ",</b> Prize <b>" . $product['prize'] ." €</b>, Quantity <b>". $product['quantity']. '</b><br>

            <b>
            <a href="add.php?item_id='.$product['item_id'].'">Add</a>  
            <a href="reduce.php?item_id='.$product['item_id'].'">Reduce</a>  
            <a href="delete.php?item_id='.$product['item_id'].'">Delete</a>   
            </b>
            </li> <br>';

      }

      echo "<h3>Total prize: ". $total_prize . " € </h3>";
      echo "<p>Your shipping address is : ". $customer['adresa'] ." </p>";  
    
      if(isset($_GET['order']) && $_GET['order'] == 1){
        echo "Your order was successful!";
      }
      if(isset($_GET['order']) && $_GET['order'] == 0){
        echo "Your basket is empty!";
      }
      
      ?>

    <form action="order.php" method="post">
      <button type="submit" name="order">order</button>
    </form>

    </ol>

    <br>

  </body>
</html>
