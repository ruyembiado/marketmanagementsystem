<?php 

$host = "localhost";  
$user = "root";  
$password = "";  
$db_name = "market"; 

$conn = mysqli_connect($host,$user,$password,$db_name);

$admin_name = 'Admin01';
$admin_contact ='09702803748';
$admin_user_name ='Admin101';
$admin_email='admin01@gmail.com';
$admin_pass=md5('admin01@gmail.com');

$admin_seed = "INSERT into admin (name, contact, username, email, password) VALUES ('$admin_name','$admin_contact','$admin_user_name','$admin_email','$admin_pass')";

mysqli_query($conn, $admin_seed);

?>