<?php

include "database.php";
include "parts/head.php";
include "parts/navigation.php";
include "auth_check.php";

use main\dp;

$menu = new dp();

?>

  <body>

    <br>
    <h2>Name: <?php echo $_SESSION["name"]; ?></h2>
    <h2>Email: <?php echo $_SESSION["user_email"]; ?></h2>
    <br>
    <a href="logout.php">logout</a>
    
  </body>
</html>
