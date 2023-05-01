<?php

include "database.php";
include "parts/head.php";
include "parts/navigation.php";

use main\dp;

$menu = new dp();


if(!empty($_SESSION["id"])){
  header("Location: user.php");
}
if(isset($_POST["submit"])){
  $nameemail = $_POST["nameemail"];
  $password = $_POST["password"];

  $result = $menu->login($nameemail);

  if(!empty($result)){
    if($menu->hashing($password) == $result['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $result["id"];
      $_SESSION["name"] = $result["name"];
      $_SESSION["user_email"] = $result["email"];
      $_SESSION["adresa"] = $result["adresa"];
      header("Location: user.php");
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
      
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
?>

  <body>
  <br>
    <h2>Login</h2><br>
    <form action="login.php" method="post">
      <label for="nameemail">Name or Email : </label>
      <input type="text" name="nameemail" id = "nameemail"> <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id = "password"> <br><br>
      <button type="submit" name="submit">Login</button>
    </form>
    <br> 
    <a href="registration.php">Registration</a>
  </body>
  <br><br><br>
</html>

<?php
include "parts/footer.php";
?>