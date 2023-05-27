<?php

@include '../config.php';

session_start();

//Customer CRUD Functions//

//Add Product to reservation cart from market
if (isset($_POST['add_reservation_market'])) {
    $market_ID = $_POST['market_ID'];
    $stall_ID = $_POST['stall_ID'];
    $product_ID = $_POST['product_ID'];
    $vendor_ID = $_POST['vendor_ID'];
    $customer_ID = $_POST['customer_ID'];

    $prod_check = "SELECT * FROM reservation WHERE product_ID = $product_ID AND reserve_status='0' AND vendor_ID = $vendor_ID";

    $prod_name = mysqli_query($conn, $prod_check);

    if (mysqli_num_rows($prod_name) > 0) {
        $_SESSION['error'] = "Product is already added";
        header("Location: ../customerView/customer_view_market_product.php?view_market_prod=$market_ID");
        exit();
    } else {
        $reserve = "INSERT INTO reservation(vendor_ID, product_ID, customer_ID, quantity, reserve_status, reserve_index) VALUES ('$vendor_ID','$product_ID','$customer_ID','1','0', '$stall_ID')";
        if (mysqli_query($conn, $reserve)) {
            $_SESSION['success'] = "Added Successfully";
            header("Location: ../customerView/customer_view_market_product.php?view_market_prod=$market_ID");
            exit();
        } else {
            $_SESSION['error'] = "Addition Failed";
            header("Location: ../customerView/customer_view_market_product.php?view_market_prod=$market_ID");
            exit();
        }
    }
}

//Add Product to reservation cart
if (isset($_POST['add_reservation'])) {

    // $reservation_date = null;
    $stall_ID   = $_POST['stall_ID'];
    $product_ID = $_POST['product_ID'];
    $vendor_ID = $_POST['vendor_ID'];
    $customer_ID = $_POST['customer_ID'];

    $prod_check = "SELECT * FROM reservation WHERE product_ID = $product_ID AND reserve_status='0' AND vendor_ID = $vendor_ID";

    $prod_name = mysqli_query($conn, $prod_check);

    if (mysqli_num_rows($prod_name) > 0) {
        $_SESSION['error'] = "Product is already added";
        header("Location: ../customerView/customer_page.php");
        exit();
    } else {
        $reserve = "INSERT INTO reservation(vendor_ID, product_ID, customer_ID, quantity, reserve_status, reserve_index) VALUES ('$vendor_ID','$product_ID','$customer_ID','1','0','$stall_ID')";

        if (mysqli_query($conn, $reserve)) {
            $_SESSION['success'] = "Added Successfully";
            header("Location: ../customerView/customer_page.php");
            exit();
        } else {
            $_SESSION['error'] = "Addition Failed";
            header("Location: ../customerView/customer_page.php");
            exit();
        }
    }
}

//Add Product to reservation cart from stall
if (isset($_POST['add_reservation_stall'])) {
    $stall_ID = $_POST['stall_ID'];
    $product_ID = $_POST['product_ID'];
    $vendor_ID = $_POST['vendor_ID'];
    $customer_ID = $_POST['customer_ID'];

    $prod_check = "SELECT * FROM reservation WHERE product_ID = $product_ID AND reserve_status='0' AND vendor_ID = $vendor_ID";

    $prod_name = mysqli_query($conn, $prod_check);

    if (mysqli_num_rows($prod_name) > 0) {
        $_SESSION['error'] = "Product is already added";
        header("Location: ../customerView/customer_store_view.php?view_stall=$stall_ID");
        exit();
    } else {
        $reserve = "INSERT INTO reservation(vendor_ID, product_ID, customer_ID, quantity, reserve_status, reserve_index) VALUES ('$vendor_ID','$product_ID','$customer_ID','1','0', '$stall_ID')";
        if (mysqli_query($conn, $reserve)) {
            $_SESSION['success'] = "Added Successfully";
            header("Location: ../customerView/customer_store_view.php?view_stall=$stall_ID");
            exit();
        } else {
            $_SESSION['error'] = "Addition Failed";
            header("Location: ../customerView/customer_store_view.php?view_stall=$stall_ID");
            exit();
        }
    }
}

// update qty cart
if (isset($_POST['update_qty'])) {

    $reservation_ID = $_POST['reservation_ID'];
    $quantity = $_POST['quantity'];

    $select = "UPDATE reservation SET quantity = '$quantity' WHERE reservation_ID = '$reservation_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = 'Updated Successfully';
        header("Location: ../customerView/customer_reserve_cart.php");
        exit();
    } else {
        $_SESSION['error'] = 'Update Failed';
        header("Location: ../customerView/customer_reserve_cart.php");
        exit();
    }
}

//Remove product from cart
if (isset($_GET['delete_cart'])) {

    $reservation_ID = $_GET['delete_cart'];

    $select = "DELETE FROM reservation WHERE reservation_ID ='$reservation_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = 'Removed Successfully';
        header("Location: ../customerView/customer_reserve_cart.php");
        exit();
    } else {
        $_SESSION['error'] = 'Removal Failed';
        header("Location: ../customerView/customer_reserve_cart.php");
        exit();
    }
}

//Update Customer Profile
// if (isset($_POST['update_customer'])) {

//     $customer_ID = $_POST['customer_ID'];

//     $name = mysqli_real_escape_string($conn, $_POST['name']);
//     $contact = mysqli_real_escape_string($conn, $_POST['contact']);
//     $email = mysqli_real_escape_string($conn, $_POST['email']);

//     $select = "UPDATE customer SET name ='$name', contact ='$contact', email ='$email' WHERE customer_ID='$customer_ID'";

//     if (mysqli_query($conn, $select)) {

//         header("Location: ../customerView/customer_profile.php?success=Updated Successfully.");
//         exit();
//     } else {

//         header("Location: ../customerView/customer_profile.php?error=Update Failed.");
//         exit();
//     }
// }

if (isset($_POST['update_customer_profile'])) {

    $customer_ID = $_POST['customer_ID'];
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $current_password = md5($_POST['password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    $checkbox = $_POST['updatepass'];

    $select = "UPDATE customer SET contact ='$contact', email ='$email', password ='$new_password' WHERE customer_ID='$customer_ID'";
    $select1 = "UPDATE customer SET contact ='$contact', email ='$email' WHERE customer_ID='$customer_ID'";

    $current_pass = "SELECT * FROM customer WHERE password = '$current_password'";
    $pass = mysqli_query($conn, $current_pass);

    if ($checkbox == 1) {

        if (mysqli_num_rows($pass) == 0) {

            $_SESSION['error'] = "Your current password does not match the password you provided. Please try again";
            header("Location: ../customerView/customer_profile_edit.php?edit_customer=$customer_ID");
            exit();
        } else {

            if ($new_password == $confirm_password) {

                if (mysqli_query($conn, $select)) {

                    $_SESSION['success'] = "Updated successfully";
                    header("Location: ../customerView/customer_profile.php");
                    exit();
                } else {

                    $_SESSION['error'] = "Update failed";
                    header("Location: ../customerView/customer_profile.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Your new password does not match the confirmation password you provided. Please try again";
                header("Location: ../customerView/customer_profile_edit.php?edit_customer=$customer_ID");
                exit();
            }
        }
    } else {
        (mysqli_query($conn, $select1));
        $_SESSION['success'] = "Updated successfully";
        header("Location: ../customerView/customer_profile.php");
        exit();
    }
}

// //Update Customer Password
// if (isset($_POST['update_customer_pass'])) {

//     $customer_ID = $_POST['customer_ID'];
//     $current_password = md5($_POST['password']);
//     $new_password = md5($_POST['new_password']);
//     $confirm_password = md5($_POST['confirm_password']);

//     $current_pass = "SELECT * FROM customer WHERE password = '$current_password'";

//     $pass = mysqli_query($conn, $current_pass);

//     if (mysqli_num_rows($pass) == 0) {

//         header("Location: ../customerView/customer_profile.php?error=Your current password does not matches with the password you provided. Please try again.");
//         exit();
//     } else {

//         if ($new_password == $confirm_password) {

//             $select = "UPDATE customer SET password ='$new_password' WHERE customer_ID='$customer_ID'";

//             if (mysqli_query($conn, $select)) {

//                 header("Location: ../customerView/customer_profile.php?success=Updated Successfully.");
//                 exit();
//             } else {

//                 header("Location: ../customerView/customer_profile.php?error=Update Failed.");
//                 exit();
//             }
//         } else {

//             header("Location: ../customerView/customer_profile.php?error=Your new password does not matches with the confirmation password you provided. Please try again.");
//             exit();
//         }
//     }
// }


//Customer cart checkout 
if (isset($_POST['checkout'])) {

    $stall_ID = $_POST['stall_ID'];
    $customer_ID = $_POST['customer_ID'];
    $vendor_ID = $_POST['vendor_ID'];
    $reserve_status = $_POST['reserve_status'];

    // $select = "UPDATE reservation SET reserve_status='1' reserve_index='$stall_ID' WHERE customer_ID='$customer_ID' AND vendor_ID='$vendor_ID' AND reserve_status='$reserve_status'";
    // $result = mysqli_query($conn, $select);
    // if ($result) {
    //     $_SESSION['success'] = "Reserved Successfully";
    //     header("Location: ../customerView/customer_reserve_cart.php");
    //     exit();
    // } else {
    //     $_SESSION['error'] = "Reservation Failed";
    //     header("Location: ../customerView/customer_reserve_cart.php");
    //     exit();
    // }

    // $query = "SELECT reserve_index FROM reservation WHERE reserve_status='1' ORDER BY reservation_ID DESC LIMIT 1";
    // $result1 = mysqli_query($conn, $query);
    // $row = mysqli_fetch_assoc($result1);
    // if ($result1) {
    //     $index = $row['reserve_index'] + 1;
    // } else {
    //     $index = 1;
    // }

    $select = "UPDATE reservation SET reserve_status='1', reservation_date=NOW() WHERE customer_ID='$customer_ID' AND reserve_status=0";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Reserved Successfully";
        header("Location: ../customerView/customer_reserve_cart.php");
        exit();
    } else {
        $_SESSION['error'] = "Reservation Failed";
        header("Location: ../customerView/customer_reserve_cart.php");
        exit();
    }

    // if (empty($row)) {
    //     $index = 1;
    //     $select = "UPDATE reservation SET reserve_status='1', reserve_index='$index' WHERE customer_ID='$customer_ID' AND vendor_ID='$vendor_ID' AND reserve_status=0";
    //     $result = mysqli_query($conn, $select);
    //     if ($result) {

    //         header("Location: ../customerView/customer_reserve_cart.php?success=Reserved Successfully.");
    //         exit();
    //     } else {

    //         header("Location: ../customerView/customer_reserve_cart.php?error=Reservation Failed.");
    //         exit();
    //     }
    // } else {
    //     $index = $row['reserve_index'] + 1;
    //     $select = "UPDATE reservation SET reserve_status='1', reserve_index='$index' WHERE customer_ID='$customer_ID' AND vendor_ID='$vendor_ID' AND reserve_status='$reserve_status'";
    //     $result = mysqli_query($conn, $select);
    //     if ($result) {

    // header("Location: ../customerView/customer_reserve_cart.php?success=Reserved Successfully.");
    // exit();
    //     } else {

    //         header("Location: ../customerView/customer_reserve_cart.php?error=Reservation Failed.");
    //         exit();
    //     }
    // }
}

// //Cancel product reservation
// if (isset($_GET['delete_reserve'])) {

//     $reservation_date = $_GET['delete_reserve'];

//     $select = "UPDATE reservation SET reserve_status='9' WHERE reservation_date ='$reservation_date'";
//     $result = mysqli_query($conn, $select);
//     if ($result) {
//         $_SESSION['success_message'] = "Cancelled Successfully";
//         header("Location: ../customerView/customer_reservation.php");
//         exit();
//     } else {
//         $_SESSION['error_message'] = "Cancelation Failed";
//         header("Location: ../customerView/customer_reservation.php");
//         exit();
//     }
// }


//Cancel product reservation
if (isset($_GET['cancel_reserve'])) {

    $reserve_index = $_GET['reserve_index'];
    $reservation_date = $_GET['cancel_reserve'];
    $status = $_GET['status'];

    $select = "UPDATE reservation SET reserve_status='5' WHERE reserve_index ='$reserve_index' AND reservation_date ='$reservation_date'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Cancelled Successfully";
        header("Location: ../customerView/customer_reserve_view.php?view_reserve=$reservation_date&status=$status");
        exit();
    } else {
        $_SESSION['error'] = "Cancelation Failed";
        header("Location: ../customerView/customer_reserve_view.php?view_reserve=$reservation_date&status=$status");
        exit();
    }
}

// //Reserve cancelled products
// if (isset($_GET['reserve'])) {

//     $reservation_date = $_GET['reserve'];

//     $select = "UPDATE reservation SET reserve_status='1' WHERE reservation_date ='$reservation_date'";
//     $result = mysqli_query($conn, $select);

//     if ($result) {

//         header("Location: ../customerView/customer_reservation.php?success=Reserved Successfully.");
//         exit();
//     } else {

//         header("Location: ../customerView/customer_reservation.php?error=Reservation Failed.");
//         exit();
//     }
// }
