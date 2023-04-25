<?php

include "php/databaze.php";
include "parts/head.php";

use main\Menu;

$menu = new Menu();

session_start();

if(!empty($_SESSION["id"])){
  header("Location: user.php");
}
if(isset($_POST["submit"])){
  $nameemail = $_POST["nameemail"];
  $password = $_POST["password"];

  $result = $menu->auth($nameemail);

  if(!empty($result)){
    if($password == $result['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $result["id"];
      $_SESSION["name"] = $result["name"];
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
    <h2>Login</h2>
    <a href="index.php">home</a>
    <form class="" action="" method="post" autocomplete="off">
      <label for="nameemail">Username or Email : </label>
      <input type="text" name="nameemail" id = "nameemail"> <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id = "password"> <br>
      <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="registration.php">Registration</a>
  </body>
</html>
