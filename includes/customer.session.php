<?php

session_start();

//Customer Session
if(!isset($_SESSION['customer_ID'])){

    $_SESSION['error'] = "Please login first";
    header('Location: ../user_login.php?');

}

// Session customer data
$customer_ID = $_SESSION['customer_ID'];
$customer_name = $_SESSION['customer_name'];
$customer_user = $_SESSION['customer_user'];
$customer_email = $_SESSION['customer_email'];
$customer_contact = $_SESSION['customer_contact'];
