<?php

@include '../config.php';

session_start();

//Vendor CRUD Functions//

//update stall
if (isset($_POST['update_stall'])) {

    $stall_ID = $_POST['stall_ID'];
    $stall_name = $_POST['stall_name'];

    $stall = "SELECT * FROM stall WHERE stall_name='$stall_name'";
    $stallname = mysqli_query($conn, $stall);
    $row = mysqli_fetch_assoc($stallname);

    if ($row['stall_name'] == $stall_name) {

        $_SESSION['error'] = "Stall is already exist!";
        header("Location: ../vendorView/vendor_stall.php");
        exit();
    } else {

        $select = "UPDATE stall SET stall_name='$stall_name' WHERE stall_ID ='$stall_ID'";
        $result = mysqli_query($conn, $select);

        if ($result) {

            $_SESSION['success'] = "Updated Successfully.";
            header("Location: ../vendorView/vendor_stall.php");
            exit();
        } else {

            $_SESSION['error'] = "Update Failed.";
            header("Location: ../vendorView/vendor_stall.php");
            exit();
        }
    }
}

// add stall
if (isset($_POST['add_stall'])) {

    $vendor_ID = $_POST['vendor_ID'];
    $market_admin_ID = $_POST['market_admin_ID'];
    $stall_name = mysqli_real_escape_string($conn, $_POST['stall_name']);

    $stall = "SELECT * FROM stall WHERE stall_name = '$stall_name'";
    $stallname = mysqli_query($conn, $stall);

    if (mysqli_num_rows($stallname) > 0) {
        $_SESSION['error'] = "Stall is already exist!";
        header("Location: ../vendorView/vendor_stall.php");
        exit();
    } else {
        $insert_stall = "INSERT INTO stall (market_admin_ID, vendor_ID, stall_name, stall_status) VALUES ('$market_admin_ID','$vendor_ID','$stall_name', '1')";

        if ($create_stall = mysqli_query($conn, $insert_stall)) {
            $_SESSION['success'] = "Added Successfully.";
            header("Location: ../vendorView/vendor_stall.php");
            exit();
        } else {
            $_SESSION['error'] = "Addition Failed.";
            header("Location: ../vendorView/vendor_stall.php");
            exit();
        }
    }
}

//Update Vendor Profile
if (isset($_POST['update_vendor_profile'])) {

    $vendor_ID = $_POST['vendor_ID'];
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $current_password = md5($_POST['password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    $checkbox = $_POST['updatepass'];

    $select = "UPDATE vendor SET contact ='$contact', email ='$email', password ='$new_password' WHERE vendor_ID='$vendor_ID'";
    $select1 = "UPDATE vendor SET contact ='$contact', email ='$email' WHERE vendor_ID='$vendor_ID'";

    $current_pass = "SELECT * FROM vendor WHERE password = '$current_password'";
    $pass = mysqli_query($conn, $current_pass);

    if ($checkbox == 1) {

        if (mysqli_num_rows($pass) == 0) {

            $_SESSION['error'] = "Your current password does not matches with the password you provided. Please try again.";
            header("Location: ../vendorView/vendor_profile_edit.php?edit_vendor=$vendor_ID");
            exit();
        } else {

            if ($new_password == $confirm_password) {

                if (mysqli_query($conn, $select)) {

                    $_SESSION['success'] = "Updated successfully.";
                    header("Location: ../vendorView/vendor_profile.php");
                    exit();
                } else {

                    $_SESSION['error'] = "Update Failed.";
                    header("Location: ../vendorView/vendor_profile.php");
                    exit();
                }
            } else {

                $_SESSION['error'] = "Your new password does not matches with the confirmation password you provided. Please try again.";
                header("Location: ../vendorView/vendor_profile_edit.php?edit_vendor=$vendor_ID");
                exit();
            }
        }
    } else {
        (mysqli_query($conn, $select1));
        $_SESSION['success'] = "Updated successfully.";
        header("Location: ../vendorView/vendor_profile.php");
        exit();
    }
}

//Add product
if (isset($_POST['add_product'])) {

    $stall_ID = $_POST['stall_ID'];
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $fileName = $_FILES['path']['name'];
    $fileTmp = $_FILES['path']['tmp_name'];
    $fileSize = $_FILES['path']['size'];
    $fileError = $_FILES['path']['error'];
    $fileType = $_FILES['path']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = ['jpg', 'png', 'jpeg', 'jfif'];
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
    $product_unit = mysqli_real_escape_string($conn, $_POST['product_unit']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);

    $sql = "SELECT * FROM product WHERE product_name ='$product_name' AND stall_ID ='$stall_ID' AND product_category ='$product_category' AND product_unit ='$product_unit' AND product_price ='$product_price'";

    $sql1 = mysqli_query($conn, $sql);

    if (mysqli_num_rows($sql1) > 0) {
        $_SESSION['error'] = "Product is already exist in your current stall";
        header("Location: ../vendorView/vendor_product_add.php?add_product=$stall_ID");
        exit();
    } else {
        if (preg_match('/^\d+(\.\d{1,2})?$/', $product_price)) {
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 5000000) {
                        $fileNameNew = uniqid() . "." . $fileActualExt;
                        $fileDir = "../product_img/" . $fileNameNew;
                        $add_product = "INSERT INTO product (stall_ID, product_name, product_img, product_category, product_unit, product_price, product_status) VALUES ('$stall_ID','$product_name','$fileDir','$product_category','$product_unit','$product_price','1')";
                        $add_prod = mysqli_query($conn, $add_product);
                        if ($add_prod) {
                            move_uploaded_file($fileTmp, $fileDir);
                            $_SESSION['success'] = "Added Successfully.";
                            header("Location: ../vendorView/vendor_product_add.php?add_product=$stall_ID");
                            exit();
                        } else {
                            $_SESSION['error'] = "Addition Failed.";
                            header("Location: ../vendorView/vendor_product_add.php?add_product=$stall_ID");
                            exit();
                        }
                    } else {
                        $_SESSION['error'] = "File is too big.";
                        header("Location: ../vendorView/vendor_product_add.php?add_product=$stall_ID");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "Addition Failed.";
                    header("Location: ../vendorView/vendor_product_add.php?add_product=$stall_ID");
                    exit();
                }
            } else {
                $_SESSION['error'] = "File type is not accepted.";
                header("Location: ../vendorView/vendor_product_add.php?add_product=$stall_ID");
                exit();
            }
        } else {
            $_SESSION['error'] = "The product price must be a number with up to 2 decimal places";
            header("Location: ../vendorView/vendor_product_add.php?add_product=$stall_ID");
            exit();
        }
    }
}
// }

//Delete Product
if (isset($_GET['delete_product'])) {
    $product_ID = $_GET['delete_product'];
    $stall_ID = $_GET['stall_ID'];
    $select = "DELETE FROM product WHERE product_ID ='$product_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Deleted Successfully.";
        header("Location: ../vendorView/vendor_product_rec.php?manage_stall=$stall_ID");
        exit();
    } else {
        $_SESSION['error'] = "Deletion Failed.";
        header("Location: ../vendorView/vendor_product_rec.php?manage_stall=$stall_ID");
        exit();
    }
}

//Update Product
if (isset($_POST['update_product'])) {
    $stall_ID = $_POST['stall_ID'];
    $product_ID = $_POST['product_ID'];
    $product_name = $_POST['product_name'];
    $currentProd = $_POST['current_path'];
    $newProd = $_POST['path'];
    $fileName = $_FILES['path']['name'];
    $fileTmp = $_FILES['path']['tmp_name'];
    $fileSize = $_FILES['path']['size'];
    $fileError = $_FILES['path']['error'];
    $fileType = $_FILES['path']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = ['jpg', 'png', 'jpeg', 'jfif'];
    $product_category = $_POST['product_category'];
    $product_unit = $_POST['product_unit'];
    $product_price = $_POST['product_price'];

    if (preg_match('/^\d+(\.\d{1,2})?$/', $product_price)) {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) {
                    $fileNameNew = uniqid() . "." . $fileActualExt;
                    $fileDir = "../product_img/" . $fileNameNew;
                    $up_product = "UPDATE product SET product_name ='$product_name', product_img ='$fileDir', product_category ='$product_category', product_unit ='$product_unit', product_price ='$product_price' WHERE product_ID ='$product_ID'";
                    $up_prod = mysqli_query($conn, $up_product);
                    if ($up_prod) {
                        move_uploaded_file($fileTmp, $fileDir);
                        $_SESSION['success'] = "Updated Successfully.";
                        header("Location: ../vendorView/vendor_product_rec.php?manage_stall=$stall_ID");
                        exit();
                    } else {
                        $_SESSION['error'] = "Update Failed";
                        header("Location: ../vendorView/vendor_product_edit.php?edit_product=$product_ID&stall_ID=$stall_ID");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "File is too big.";
                    header("Location: ../vendorView/vendor_product_edit.php?edit_product=$product_ID&stall_ID=$stall_ID");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Update Failed.";
                header("Location: ../vendorView/vendor_product_edit.php?edit_product=$product_ID&stall_ID=$stall_ID");
                exit();
            }
        } else {
            $up_product = "UPDATE product SET product_name ='$product_name', product_img ='$currentProd', product_category ='$product_category', product_unit ='$product_unit', product_price ='$product_price' WHERE product_ID ='$product_ID'";
            $up_prod = mysqli_query($conn, $up_product);
            $_SESSION['success'] = "Updated Successfully.";
            header("Location: ../vendorView/vendor_product_rec.php?manage_stall=$stall_ID");
            exit();
        }
    } else {
        $_SESSION['error'] = "The product price must be a number with up to 2 decimal places";
        header("Location: ../vendorView/vendor_product_edit.php?edit_product=$product_ID&stall_ID=$stall_ID");
        exit();
    }
}

//Update Product Status
if (isset($_GET['product_status'])) {
    $product_ID = $_GET['product_status'];
    $stall_ID = $_GET['stall_ID'];
    $prod = "SELECT product_status FROM product WHERE product_ID ='$product_ID'";
    $status = mysqli_query($conn, $prod);
    while ($row = mysqli_fetch_assoc($status)) {
        $product_status = $row['product_status'];
    }
    if ($product_status === '1') {

        $update = "UPDATE product SET product_status ='0' WHERE product_ID ='$product_ID'";
        $sql = mysqli_query($conn, $update);

        $_SESSION['success'] = 'Product status updated successfully.';
        header("Location: ../vendorView/vendor_product_rec.php?manage_stall=$stall_ID");
        exit();
    } else {

        $update = "UPDATE product SET product_status ='1' WHERE product_ID ='$product_ID'";
        $sql = mysqli_query($conn, $update);

        $_SESSION['success'] = 'Product status updated successfully.';
        header("Location: ../vendorView/vendor_product_rec.php?manage_stall=$stall_ID");
        exit();
    }
}

//Customer reservation done
if (isset($_GET['done_reserve'])) {

    $reservation_date = $_GET['done_reserve'];
    $reserve_index = $_GET['reserve_index'];
    $status = $_GET['status'];
    $select = "UPDATE reservation SET reserve_status='3' WHERE reservation_date ='$reservation_date' AND reserve_index='$reserve_index'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Reservation was completed successfully";
        header("Location: ../vendorView/vendor_customer_reserve_view.php?view_reserve=$reservation_date&status=$status");
        exit();
    } else {
        $_SESSION['error'] = "Unknown error occurred";
        header("Location: ../vendorView/vendor_customer_reserve_view.php?view_reserve=$reservation_date&status=$status");
        exit();
    }
}

//Approve customer reservation
if (isset($_GET['accept_reserve'])) {

    $datenow = date('Y-m-d H:i');
    $tomorrow = date('Y-m-d H:i', strtotime($datenow . ' +1 day'));
    $reservation_date = $_GET['accept_reserve'];
    $reserve_index = $_GET['reserve_index'];
    $status = $_GET['status'];
    // $vendor_ID = $_GET['vendor_ID'];

    $select = "UPDATE reservation SET reserve_status='4', reservation_expdate ='$tomorrow' WHERE reservation_date ='$reservation_date' AND reserve_index ='$reserve_index'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Accepted Successfully";
        header("Location: ../vendorView/vendor_customer_reserve_view.php?view_reserve=$reservation_date&status=$status");
        exit();
    } else {
        $_SESSION['error'] = "Acceptance Failed";
        header("Location: ../vendorView/vendor_customer_reserve_view.php?view_reserve=$reservation_date&status=$status");
        exit();
    }
}

//Customer reservation cancellation
if (isset($_GET['cancel_reserve'])) {

    $reservation_date = $_GET['cancel_reserve'];
    $reserve_index = $_GET['reserve_index'];
    $status = $_GET['status'];

    $select = "UPDATE reservation SET reserve_status='5' WHERE reservation_date ='$reservation_date' AND reserve_index='$reserve_index'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Cancelled Successfully";
        header("Location: ../vendorView/vendor_customer_reserve_view.php?view_reserve=$reservation_date&status=$status");
        exit();
    } else {
        $_SESSION['error'] = "Cancellation Failed";
        header("Location: ../vendorView/vendor_customer_reserve_view.php?view_reserve=$reservation_date&status=$status");
        exit();
    }
}

//Customer reservation deletion
// if (isset($_GET['delete_reserve'])) {

//     $reservation_date = $_GET['delete_reserve'];

//     $select = "DELETE FROM reservation WHERE reservation_date ='$reservation_date'";
//     $result = mysqli_query($conn, $select);

//     if ($result) {

//         header("Location: ../vendorView/vendor_customer_reservation.php?success=Cancelled Successfully.");
//         exit();
//     } else {

//         header("Location: ../vendorView/vendor_customer_reservation.php?error=Cancellation Failed.");
//         exit();
//     }
// }


// request stall
// if (isset($_POST['request_stall'])) {

//     $vendor_ID = $_POST['vendor_ID'];
//     $stall_ID = $_POST['stall_ID'];
//     $stall_name = $_POST['stall_name'];
//     $map_ID = $_POST['map_ID'];

//     $update = "UPDATE stall SET vendor_ID='$vendor_ID', stall_status='3', stall_name='$stall_name' WHERE stall_ID='$stall_ID'";
//     $result = mysqli_query($conn, $update);

//     if ($result) {
//         header("Location: ../vendorView/vendor_map.php?success=Requested Successfully.&map_view=$map_ID");
//         exit();
//     } else {
//         header("Location: ../vendorView/vendor_map.php?error=Request Failed.");
//         exit();
//     }
// }


// if (isset($_POST['cancel_request'])) {

//     $stall_ID = $_POST['stall_ID'];
//     $vendor_ID = $_POST['vendor_ID'];
//     $map_ID = $_POST['map_ID'];

//     $cancel = "UPDATE stall set vendor_ID='NULL', stall_name='Available' , stall_status='0' WHERE stall_ID='$stall_ID'";
//     $result = mysqli_query($conn, $cancel);

//     if ($result) {
//         header("Location: ../vendorView/vendor_map.php?success=Cancelled Successfully.&map_view=$map_ID");
//         exit();
//     } else {
//         header("Location: ../vendorView/vendor_map.php?error=Cancelation Failed.");
//         exit();
//     }
// }
