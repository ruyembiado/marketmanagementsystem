<?php

session_start();

//Market Admin Session
if(!isset($_SESSION['market_admin_ID'])){
    
    $_SESSION['error'] = "Please login first";
    header('Location: ../user_login.php?');
    
}

//Session market admin data
$ma_ID = $_SESSION['market_admin_ID'];
$ma_name = $_SESSION['marketAd_name'];
$ma_user = $_SESSION['marketAd_user'];
$ma_email = $_SESSION['marketAd_email'];
$ma_contact = $_SESSION['marketAd_contact'];

// Query market name
$market_name = "SELECT * FROM market_admin, market WHERE market_admin.market_admin_ID='$ma_ID' AND market.market_ID=market_admin.market_ID";
$row = mysqli_query($conn, $market_name);
$result = mysqli_fetch_assoc($row);

// Query map name for market_ID (add map)
$map = "SELECT * FROM map";
$sql = mysqli_query($conn, $map);
$row = mysqli_fetch_assoc($sql);
