<?php

include "parts/head.php";
include "database.php";
include "parts/navigation.php";
include "auth_check.php";

use main\Data;

$functions = new Data();

$card = $functions -> show($_SESSION["id"]);
$customer = $functions -> info($_SESSION["id"]);

if(empty($customer) || empty($card)){
  $errors = $functions->getErrors();
  foreach($errors as $error) {
    echo $error . "<br>";
  }  
}


?>

<body>
  <div class="container">
  <br><br><br>
    <h1>SHOPPING CARD</h1>

    <form action="user_order.php" method="post">
      <button type="submit" name="order">Your orders</button>
    </form><br>

    <h2> Your items in the cart:</h2>

    <ol>
      <?php

      $total_prize = 0;

      foreach ($card as $product) {

          $total_prize += $product['prize'] * $product['quantity'];

          
          echo "<li> Product name: <b>" . $product['product_name'] . ",</b> Prize <b>" . $product['prize'] ." €</b>, Quantity <b>". $product['quantity']. '</b><br>

            <b>
            <a href="add.php?item_id='.$product['item_id'].'&&card=card.php">Add</a>  
            <a href="reduce.php?item_id='.$product['item_id'].'">Reduce</a>  
            <a href="delete.php?item_id='.$product['item_id'].'">Delete</a>   
            </b>
            </li> <br>';

      }
      
      echo "<br><h3>Total prize: ". $total_prize . " € </h3>";
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
    </div>
    <br><br><br>
  </body>

<?php
include "parts/footer.php";
?>

