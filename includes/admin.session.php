<?php

session_start();

//Admin Session
if(!isset($_SESSION['admin_ID'])){

    $_SESSION['error'] = "Please login first";
    header('Location: ../user_login.php?');
    
} 

//Session admin data
$admin_ID = $_SESSION['admin_ID'];
$admin_name = $_SESSION['admin_name'];
$admin_user = $_SESSION['admin_user'];
$admin_email = $_SESSION['admin_email'];
$admin_contact = $_SESSION['admin_contact'];

//Query admin data
$admindata = "SELECT * FROM admin WHERE admin_ID = $admin_ID";
$admin = mysqli_query($conn, $admindata);
$admin = mysqli_fetch_assoc($admin);

// Query Map name
//$map = "SELECT * FROM map WHERE admin_ID = $admin_id_session";

?>