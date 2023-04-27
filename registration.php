<?php

include "php/databaze.php";
include "parts/head.php";

use main\Menu;

$menu = new Menu();

if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $adresa = $_POST["address"];
  $menu -> newsletter($email);
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];

  $info = false;

  $duplicate = $menu->duplicate("$name","$email");  
  if(empty($name) || empty($email) || empty($adresa) || empty($menu) || empty($password)){
    echo "<script> alert('Neboli vyplnené všetky údaje!'); </script>";
  }
  elseif($duplicate){
    echo
    "<script> alert('Username or Email Has Already Taken'); </script>";
  }
  else{

    if($password == $confirmpassword){

      $menu->registration($name, $email, $password, $adresa);
      echo
      "<script> alert('Registration Successful'); </script>";

    }
    else{
      echo
      "<script> alert('Password Does Not Match'); </script>";
    }
  }
}

//HTML COD 
?>

  <body>
    <h2>Registration</h2>
    <a href="index.php">home</a>/<a href="products.php">products</a>
    <form action="registration.php" method="post">
      <label for="name">Meno : </label>
      <input type="text" name="name"> <br>
      <label for="name">Adresa : </label>
      <input type="text" name="address"> <br>
      <label for="email">Email : </label>
      <input type="email" name="email"> <br>
      <label for="password">Heslo : </label>
      <input type="password" name="password"> <br>
      <label for="confirmpassword">Potvrdiť heslo : </label>
      <input type="password" name="confirmpassword"> <br>
      <button type="submit" name="submit">Register</button>
    </form>
    <br>
    <a href="login.php">Login</a>
  </body>
</html>
