<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {

    header("location:login.php");
    exit;
      
}else if((isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) && $_SESSION['role']==1 ){
    header("location:adminDashboard.php");
    exit;
    
}

?>