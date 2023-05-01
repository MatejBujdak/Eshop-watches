<?php

include "database.php";
include "parts/head.php";
include "parts/navigation.php";
include "auth_check.php";

use main\dp;

$menu = new dp();

?>

  <body>
    <div class="container">
      <br><br><br>
      <h2>Name: <?php echo $_SESSION["name"]; ?></h2> <br>
      <h2>Email: <?php echo $_SESSION["user_email"]; ?></h2><br>
      <h2>Adresa: <?php echo $_SESSION["adresa"]; ?></h2><br>
      <br>
      <a href="logout.php">logout</a>
    </div>
  </body>
  <br><br><br>
</html>

<?php
include "parts/footer.php";
?>