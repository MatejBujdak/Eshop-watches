<?php 
  include "parts/head.php"; 
  include "parts/navigation.php";

  if(isset($_SESSION['add']) && $_SESSION['add'] === true){
    $_SESSION['add'] = false;
    echo "<script> alert('You have successfully added the product to your cart!'); </script>";
  }
  
  include "parts/watches.php";
  include "parts/footer.php";
?>