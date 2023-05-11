<?php

include "database.php";
include "parts/head.php";
include "parts/navigation.php";

use main\Data;

$functions = new Data();

if(!empty($_SESSION["id"])){
  header("Location: user.php");
}
if(isset($_POST["submit"])){
  $nameemail = $_POST["nameemail"];
  $password = $_POST["password"];

  $result = $functions->login($nameemail);

  if(empty($result)){
    $errors = $functions->getErrors();
    foreach($errors as $error) {
      echo $error . "<br>";
    }
  }

  if(!empty($result)){
    if($functions->hashing($password) == $result['password']){
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

<style>
   h2 {
    text-align: center;
    color: #333333;
  }
  .form {
    max-width: 400px;
    margin: 0 auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  .form a {
  margin-top: 10px;
}
</style>

  <body>
  <br>
  <div class="form">
    <h2>Login</h2><br>
    <form action="login.php" method="post">
      <label for="nameemail">Name or Email : </label>
      <input type="text" name="nameemail" id = "nameemail"> <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id = "password"> <br><br>
      <button type="submit" name="submit">Login</button>
      <a href="registration.php">Registration</a>
    </form>
</div>
    <br> 
  </body>
  <br><br><br>
</html>

<?php
include "parts/footer.php";
?>