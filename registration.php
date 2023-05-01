<?php

include "database.php";
include "parts/head.php";
include "parts/navigation.php";

use main\dp;

$menu = new dp();

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
    "<script> alert('Name or Email Has Already Taken'); </script>";
  }
  else{

    if($password == $confirmpassword){

      $menu->registration($name, $email, $password, $adresa);

      //auto-login
      $result = $menu->login($name);

      $_SESSION["login"] = true;
      $_SESSION["id"] = $result["id"];
      $_SESSION["name"] = $result["name"];
      $_SESSION["user_email"] = $result["email"];
      $_SESSION["adresa"] = $result["adresa"];

      header("Location: user.php");
      

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
  <br>
    <h2>Registration</h2><br>
    <form action="registration.php" method="post">
      <label for="name">Name : </label>
      <input type="text" name="name"> <br>
      <label for="name">Address : </label>
      <input type="text" name="address"> <br>
      <label for="email">Email : </label>
      <input type="email" name="email"> <br>
      <label for="password">Password : </label>
      <input type="password" name="password"> <br>
      <label for="confirmpassword">Confirm password : </label>
      <input type="password" name="confirmpassword"> <br><br>
      <button type="submit" name="submit">Create account</button>
    </form>
    <br>
    <a href="login.php">Login</a>
    <br><br><br>
  </body>
</html>

<?php
include "parts/footer.php";
?>