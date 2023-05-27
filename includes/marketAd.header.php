<?php
// header("Refresh: 10"); // Refresh the page after seconds
@include '../config.php';
@include '../includes/marketAd.session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Web-based Market Product Monitoring System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <!-- Favicon -->
    <link href="img/favicon.icon" rel="icon">

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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sweetalert2.min.css" rel="stylesheet">
    <link href="../css/datatables.css" rel="stylesheet">
    <!-- Sweetalert2 -->
    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div>
        <!-- Sidebar -->
        <div class="sidebar pb-3" id="sidebar" style="overflow:hidden; background-color: #001427;">
            <div class="d-flex justify-content-center mb-2 mt-2">
                <p class="text-center mt-3" style="font-size: 40px; color: #F4D58D;">MPMS</p>
            </div>
            <div class="d-flex justify-content-start mt-2  mx-3 mb-4 ms-3 border-bottom border-secondary pb-3">
                <div class="align-self-center">
                    <i class='fas fa-user-circle' style='font-size:38px; color: #708D81;'></i>
                </div>
                <div class="ms-2 align-self-center">
                    <h6 class="mb-0 h6" style='color:#708D81; font-size:15px; '><span><?php echo $ma_name; ?></span></h6>
                    <span style='color:#708D81; font-size:13px'>Market Admin</span>
                </div>
            </div>
            <div class="row m-auto px-3 mb-3">
                <a href="marketAd_page.php" class="side-admin btn text-start " style="color: #001427; background-color: #708D81;">
                    <i class="fa fa-home" aria-hidden="true"></i> Dashboard
                </a>
            </div>
            <div class="row m-auto px-3 mb-3">
                <a href="marketAd_map.php" class="side-admin btn text-start " style="color: #001427; background-color: #708D81;">
                    <i class="fa fa-map" aria-hidden="true"></i> Manage Market Map
                </a>
            </div>
            <div class="row m-auto px-3 mb-3">
                <a href="marketAd_vendor_acc.php" class="side-admin btn text-start " style="color: #001427; background-color: #708D81;">
                    <i class="bi bi-shop-window" aria-hidden="true"></i> Manage Vendor Stalls
                </a>
            </div>
            <div class="row m-auto px-3 mb-3">
                <a href="marketAd_vendor_validate.php" class="side-admin btn text-start " style="color: #001427; background-color: #708D81; font-size: 13.5px;">
                    <i class="bi bi-person-lines-fill" aria-hidden="true"></i> Manage Vendor Registration
                </a>
            </div>
            </nav>
        </div>
        <!-- Sidebar -->

        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand sticky-top px-4 py-3" style="background-color:#001427;">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars" style='color:#708D81;'></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <p class="mb-0" style="font-size: 30px; color:#F4D58D;"><?php echo $result['market_name']; ?></h3>
                </div>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex" data-bs-toggle="dropdown">
                            <i class='fas fa-user-circle me-1 align-self-cente' style="font-size: 25px; color:#708D81;"></i>
                            <span class="d-none d-lg-inline-flex align-self-center" style='color:#708D81;'><?php echo $ma_user; ?></span><i class="ms-1 fa fa-caret-down" style='color:#708D81;'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end border-0 rounded-0 rounded-bottom m-0" style="color: #001427; background-color: #708D81;">
                            <a href="marketAd_profile.php" style="color: #001427; background-color: #708D81;" class="dropdown-item">
                                <p class="m-0 p-0"><i class="fa fa-user"></i> My Profile</p class="m-0 p-0">
                            </a>
                            <a href="../logout.php" style="color: #001427; background-color: #708D81;" class="dropdown-item logout">
                                <p class="m-0 p-0"><i class="fa fa-sign-out"></i> Logout</p class="m-0 p-0">
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Navbar -->