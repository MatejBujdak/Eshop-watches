<?php

include "parts/head.php";
include "database.php";
include "parts/navigation.php";
include "auth_check.php";

use main\Data;

$functions = new Data();

$orders= $functions->show_orders($_SESSION["id"]);


if(empty($orders)) {
  $errors = $functions->getErrors();
  foreach($errors as $error) {
    echo $error . "<br>";
  }
}

?>
 
<body>
  <div class="container">
  <br><br><br>
    <h1>YOUR ORDERS</h1>

    <form action="card.php" method="post">
      <button type="submit" name="order">Back to card</button>
    </form>
    <br>

    <h2> Your ordered items:</h2>

    <ol>
      <?php

      if(empty($orders)){  
        echo "Nemáš žiadne objednávky!  ";
      }

      foreach ($orders as $product) {

          echo "<li> Product name: <b>" . $product['product'] . ",</b> Prize <b>" . $product['prize'] ." €</b>, Quantity <b>". $product['quantity']. 
          '</b> <br> Order date: '. $product['date'].'</li> <br>';

      }
    
      
      ?>

    </ol>

    <br><br><br>
  </div>
  </body>
</html>

<?php
include "parts/footer.php";
?>