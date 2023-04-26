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
  $menu -> newsletter($email);
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];

  $duplicate = $menu->duplicate("$name","$email");
  if($duplicate){
    echo
    "<script> alert('Username or Email Has Already Taken'); </script>";
  }
  else{

    if($password == $confirmpassword){

      $menu->registration($name, $email, $password);
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
    <form class="" action="" method="post" autocomplete="off">
      <label for="name">Name : </label>
      <input type="text" name="name" id = "name" required value=""> <br>
      <label for="email">Email : </label>
      <input type="email" name="email" id = "email" required value=""> <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id = "password" required value=""> <br>
      <label for="confirmpassword">Confirm Password : </label>
      <input type="password" name="confirmpassword" id = "confirmpassword" required value=""> <br>
      <button type="submit" name="submit">Register</button>
    </form>
    <br>
    <a href="login.php">Login</a>
  </body>
</html>
