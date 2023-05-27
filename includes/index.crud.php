<?php

@include '../config.php';
session_start();

//Add product to reservation cart from index_page.php (not logged in)
if (isset($_POST['add_reservation_index'])) {
    if (!isset($_SESSION['customer_ID'])) {
        $_SESSION['cart'] = [
            'stall_ID' => $_POST['stall_ID'],
            'product_ID' => $_POST['product_ID'],
            'vendor_ID' => $_POST['vendor_ID'],
        ];

        $_SESSION['error'] = "Please Login first";
        header("Location: ../user_login.php");
        exit();
    }
}
