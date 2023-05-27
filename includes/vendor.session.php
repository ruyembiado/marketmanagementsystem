<?php

session_start();

//Vendor Session
if(!isset($_SESSION['vendor_ID'])){

    $_SESSION['error'] = "Please login first";
    header('Location: ../user_login.php?');
    
}

// Session vendor data
$vendor_ID = $_SESSION['vendor_ID'];
$vendor_user = $_SESSION['vendor_user'];
$ma_ID = $_SESSION['market_admin_ID'];
$stall_ID = $_SESSION['stall_ID'];
$vendor_name = $_SESSION['vendor_name'];
$vendor_email = $_SESSION['vendor_email'];
$vendor_contact = $_SESSION['vendor_contact'];

// Query map name
$market = "SELECT * FROM market, market_admin, vendor WHERE market.market_ID=market_admin.market_ID AND market_admin.market_admin_ID=vendor.market_admin_ID";
$row = mysqli_query($conn, $market);
$result = mysqli_fetch_assoc($row);
