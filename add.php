<?php

include "database.php";
include "auth_check.php";

use main\Data;

$functions = new Data();

if(isset($_GET['item_id'])){
    $add = $functions->add($_SESSION['id'],$_GET['item_id']);

    if(!$add){
      $errors = $functions->getErrors();
      foreach($errors as $error) {
        echo $error . "<br>";
      }
    }

    if(isset($_GET['card']) && $_GET['card'] == 'card.php'){
       header("Location: card.php");
    }else{
       $_SESSION['add'] = true;
       header("Location: products.php"); 
    }
   
}


?>
