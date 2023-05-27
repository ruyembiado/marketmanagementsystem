<?php
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Web-based Market Product Monitoring System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" href="../img/favicon.png" type="image/png">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Sweetalert2 -->
    <link href="css/sweetalert2.min.css" rel="stylesheet">
    <link href="css/datatables.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div>
        <!-- Sidebar -->
        <div class="sidebar pb-3" style="overflow:hidden; background-color: #001427;">
            <a href="" class="navbar-brand p-0 m-0">
                <p class="text-center mt-3" style="font-size: 40px; color: #F4D58D;">MPMS</p>
            </a>
            <div class="d-flex justify-content-center mb-4">
                <div class="position-relative">
                    <i class='bi bi-shop' style='font-size:48px;color:#F4D58D;'></i>
                </div>
            </div>
            <div class="row m-auto px-3 mb-3">
                <a href="index.php" style="color: #001427; background-color: #708D81;" class="btn text-start">
                    <i class="fa fa-home" aria-hidden="true"></i> Home
                </a>
            </div>
            <div class="row m-auto px-3 mb-3">
                <a href="user_login.php" style="color: #001427; background-color: #708D81;" class="btn text-start">
                    <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                </a>
            </div>
            <div class="row m-auto px-3">
                <a href="#" style="color: #001427; background-color: #708D81;" class="dropdown-toggle btn text-start" data-bs-toggle="dropdown">
                    <i class="fa fa-book" aria-hidden="true"></i> Register As
                </a>
                <div class="col-md-5 dropdown-menu rounded-0 rounded-bottom m-1" style="color: #001427; background-color: #708D81;">
                    <a style="color: #001427; background-color: #708D81;" href="marketAd_reg.php" class="dropdown-item">
                        <p class="mb-0">Market Admin</p>
                    </a>
                    <a style="color: #001427; background-color: #708D81;" href="vendor_reg.php" class="dropdown-item">
                        <p class="mb-0">Vendor</p>
                    </a>
                    <a style="color: #001427; background-color: #708D81;" href="customer_reg.php" class="dropdown-item">
                        <p class="mb-0">Customer</p>
                    </a>
                </div>
            </div>
        </div>
        <!-- Sidebar -->

        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand sticky-top px-4 py-3" style="background-color:#001427;">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars" style='color:#708D81;'></i>
                </a>
                <form action="index_search.php" method="GET" class="d-flex col-md-3 m-auto sm-search">
                    <input class="form-control form-control-sm text-dark" type="text" placeholder="Search here" name="search" required />
                    <button class="btn btn-primary btn-sm button-size px-3 d-flex align-items-center" type="submit"><i class="fa fa-search"></i></button>
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <p class="mb-0" style="font-size: 30px; color:#F4D58D;">Web-based Market Product Monitoring System</p>
                </div>
                <div class="navbar-nav align-items-center ms-auto">
                </div>
            </nav>
            <!-- Navbar -->