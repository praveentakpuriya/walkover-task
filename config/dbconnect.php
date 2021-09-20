<?php
// session_start();
$server="localhost";
$username="root";
$password="";
$databse="walkover";

$con=mysqli_connect($server,$username,$password,$databse);

if(!$con){
 
    die(mysqli_connect_error());
}


?>