<?php

include "database.php";
include "auth_check.php";

use main\Data;

$functions = new Data();

if(isset($_GET['item_id'])){
    $delete = $functions->delete($_SESSION['id'],$_GET['item_id']);
    if(!$delete){
        $errors = $functions->getErrors();
        foreach($errors as $error) {
          echo $error . "<br>";
        }
      }
    header("Location: card.php");
}


?>
