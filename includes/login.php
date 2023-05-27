<?php

@include '../config.php';

session_start();

//Admin Login
if (isset($_POST['login_user'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);

    $sql0 = "SELECT * FROM admin WHERE username='$username'";
    $sql1 = "SELECT * FROM market_admin WHERE username='$username'";
    $sql2 = "SELECT * FROM vendor WHERE username='$username'";
    $sql3 = "SELECT * FROM customer WHERE username='$username'";

    $resultAdmin = mysqli_query($conn, $sql0);
    $resultMarketAdmin = mysqli_query($conn, $sql1);
    $resultVendor = mysqli_query($conn, $sql2);
    $resultCustomer = mysqli_query($conn, $sql3);

    $row = mysqli_fetch_assoc($resultAdmin);
    $row1 = mysqli_fetch_assoc($resultMarketAdmin);
    $row8 = mysqli_fetch_assoc($resultVendor);
    $row3 = mysqli_fetch_assoc($resultCustomer);

    //If system find the data in admin table

    if ($row['username'] === $username) {
        if ($row['password'] === $pass) {
            $_SESSION['admin_ID'] = $row['admin_ID'];
            $_SESSION['admin_user'] = $row['username'];
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_contact'] = $row['contact'];

            // Set the success message in the session variable
            $_SESSION['success'] = "Welcome back, " . $_SESSION['admin_name'] . "!";

            // Redirect to admin_page.php
            header("Location: ../adminView/admin_page.php");
        } else {
            $_SESSION['error'] = "Password is incorrect";
            header("Location: ../user_login.php?username=" . $username);
            exit();
        }
    } else if ($row1['username'] === $username) {
        if ($row1['market_admin_status'] !== '1') {
            $_SESSION['error'] = "Account is not activated yet";
            header("Location: ../user_login.php?username=" . $username);
            exit();
        } else {
            if ($row1['password'] === $pass) {
                $_SESSION['market_admin_ID'] = $row1['market_admin_ID'];
                $_SESSION['marketAd_user'] = $row1['username'];
                $_SESSION['marketAd_name'] = $row1['name'];
                $_SESSION['marketAd_email'] = $row1['email'];
                $_SESSION['marketAd_contact'] = $row1['contact'];

                // Set the success message in the session variable
                $_SESSION['success'] = "Welcome back, " . $_SESSION['marketAd_name'] . "!";

                // Redirect to marketAd_page.php
                header("Location: ../marketAdView/marketAd_page.php");
            } else {
                $_SESSION['error'] = "Password is incorrect";
                header("Location: ../user_login.php?username=" . $username);
                exit();
            }
        }
    } else if ($row8['username'] === $username) {
        if ($row8['vendor_status'] !== '1') {
            $_SESSION['error'] = "Account is not activated yet";
            header("Location: ../user_login.php?username=" . $username);
            exit();
        } else {
            if ($row8['password'] === $pass) {
                $_SESSION['vendor_ID'] = $row8['vendor_ID'];
                $_SESSION['vendor_user'] = $row8['username'];
                $_SESSION['vendor_name'] = $row8['name'];
                $_SESSION['vendor_email'] = $row8['email'];
                $_SESSION['vendor_contact'] = $row8['contact'];

                // Set the success message in the session variable
                $_SESSION['success'] = "Welcome back, " . $_SESSION['vendor_name'] . "!";

                // Redirect to vendor_page.php
                header("Location: ../vendorView/vendor_page.php");
            } else {
                $_SESSION['error'] = "Password is incorrect";
                header("Location: ../user_login.php?username=" . $username);
                exit();
            }
        }
    } else if ($row3['username'] === $username) {
        if ($row3['password'] === $pass) {
            $_SESSION['customer_ID'] = $row3['customer_ID'];
            $_SESSION['customer_user'] = $row3['username'];
            $_SESSION['customer_name'] = $row3['name'];
            $_SESSION['customer_email'] = $row3['email'];
            $_SESSION['customer_contact'] = $row3['contact'];

            if (isset($_POST['cart']) && !empty($_POST['cart'])) {
                $customer_ID = $row3['customer_ID'];
                // Convert the serialized cart string back to an array
                $cart = unserialize($_POST['cart']);

                $stall_ID = $cart['stall_ID'];
                $product_ID = $cart['product_ID'];
                $vendor_ID = $cart['vendor_ID'];

                $reserve = "INSERT INTO reservation(vendor_ID, product_ID, customer_ID, quantity, reserve_status, reserve_index) VALUES ('$vendor_ID','$product_ID','$customer_ID','1','0','$stall_ID')";
                mysqli_query($conn, $reserve);

                // Store the updated cart array back in the session
                $_SESSION['cart'] = $cart;
                unset($_SESSION['cart']);
            }

            // Set the success message in the session variable
            $_SESSION['success'] = "Welcome back, " . $_SESSION['customer_name'] . "!";

            // Redirect to customer_page.php
            header("Location: ../customerView/customer_page.php");
            exit();
        } else {
            $_SESSION['error'] = "Password is incorrect";
            header("Location: ../user_login.php?username=" . $username);
            exit();
        }
    } else {
        $_SESSION['error'] = "Username does not exist";
        header("Location: ../user_login.php");
        exit();
    }
}
