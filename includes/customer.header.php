<?php
// header("Refresh: 10"); // Refresh the page after seconds

@include '../config.php';
@include '../includes/customer.session.php';
@include '../includes/customer.crud.php';
@include '../includes/search.php';

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
    <!-- Sweetalert2 -->
    <link href="../css/sweetalert2.min.css" rel="stylesheet">
    <link href="../css/datatables.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>
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
                <h6 class="mb-0 h6" style='color:#708D81; font-size:15px; '><span><span>
                            <?php echo $customer_name; ?>
                        </span></h6>
                <span style='color:#708D81; font-size:13px'>Customer</span>
            </div>
        </div>
        <div class="row m-auto px-3 mb-3">
            <a href="customer_page.php" class="side-admin btn text-start " style="color: #001427; background-color: #708D81;">
                <i class="fa fa-home" aria-hidden="true"></i> Dashboard
            </a>
        </div>
        <div class="row m-auto px-3 mb-3">
            <a href="customer_reserve_cart.php" class="side-admin btn text-start " style="color: #001427; background-color: #708D81;">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
            </a>
        </div>
        <div class="row m-auto px-3 mb-3">
            <?php
            // Set the time zone to your desired timezone
            date_default_timezone_set('Asia/Manila');
            // Get the current year, month, and week number
            $current_year = date('Y');
            $current_month = date('M');
            $current_week = date('w');
            // Calculate the timestamp of the first Monday of the month
            $timestamp = strtotime("Monday, $current_year-$current_month-$current_week");
            // Format the timestamp as a date
            $date = date('Y-m-d', $timestamp);
            ?>
            <a href="customer_reservation.php?date_from=<?php echo $date; ?>&date_to=<?php echo date('Y-m-d', strtotime('+7 days')) ?>" class="side-admin btn text-start " style="color: #001427; background-color: #708D81;">
                <i class="fa fa-file-text" aria-hidden="true"></i> Manage Reservation
            </a>
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
            <form action="customer_search.php" method="GET" class="d-flex col-md-3 m-auto sm-search">
                <input class="form-control form-control-sm text-dark" type="text" placeholder="Search here" name="search" />
                <button class="btn btn-primary btn-sm button-size px-3 d-flex align-items-center" type="submit"><i class="fa fa-search"></i></button>
            </form>
            <div class="navbar-nav d-flex align-items-center ms-auto d-none d-lg-block d-md-block">
                <p class="mb-0" style="font-size: 30px; color:#F4D58D;">Web-based Market Product Monitoring System</h4>
            </div>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex" data-bs-toggle="dropdown">
                        <i class='fas fa-user-circle me-1 align-self-cente' style="font-size: 25px; color:#708D81;"></i>
                        <span class="d-none d-lg-inline-flex align-self-center" style='color:#708D81;'><?php echo $customer_user; ?></span><i class="ms-1 fa fa-caret-down" style='color:#708D81;'></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end border-0 rounded-0 rounded-bottom m-0" style="color: #001427; background-color: #708D81;">
                        <a href="customer_profile.php" style="color: #001427; background-color: #708D81;" class="dropdown-item">
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