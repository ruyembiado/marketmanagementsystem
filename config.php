<?php

$host = "localhost";  
$user = "root";  
$password = "";  
$db_name = "market"; 

date_default_timezone_set('Asia/Manila');

$conn = mysqli_connect($host,$user,$password,$db_name);

if(!$conn) {  
    die("Failed to connect". mysqli_connect_error());  
}  
?>