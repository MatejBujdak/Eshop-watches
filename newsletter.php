<?php

include "database.php";
include "parts/head.php";

use main\Data;

$functions = new Data();
session_start();

if(isset($_POST['email'])){
    $newsletter = $functions->newsletter($_POST['email']);
    
    if(!$newsletter) {
        $errors = $functions->getErrors();
        foreach($errors as $error) {
          echo $error . "<br>";
        }
    }
    $_SESSION['email_created'] = true;
    header("Location:index.php");
}

?>



