<?php

@include '../config.php';

session_start();

//Market Admin CRUD Functions

//Update Market Admin Profile
// if (isset($_POST['update_marketAd'])) {

//     $market_admin_ID = $_POST['market_admin_ID'];

//     $name = mysqli_real_escape_string($conn, $_POST['name']);
//     $contact = mysqli_real_escape_string($conn, $_POST['contact']);
//     $email = mysqli_real_escape_string($conn, $_POST['email']);

//     $select = "UPDATE market_admin SET name ='$name', contact ='$contact', email ='$email' WHERE market_admin_ID='$market_admin_ID'";

//     if (mysqli_query($conn, $select)) {

//         header("Location: ../marketAdView/marketAd_profile.php?success=Updated Successfully");
//         exit();
//     } else {

//         header("Location: ../marketAdView/marketAd_profile.php?error=Update Failed.");
//         exit();
//     }
// }

// //Update Market Admin Password
// if (isset($_POST['update_marketAd_pass'])) {

//     $market_admin_ID = $_POST['market_admin_ID'];
//     $current_password = md5($_POST['password']);
//     $new_password = md5($_POST['new_password']);
//     $confirm_password = md5($_POST['confirm_password']);

//     $current_pass = "SELECT * FROM market_admin WHERE password = '$current_password'";

//     $pass = mysqli_query($conn, $current_pass);

//     if (mysqli_num_rows($pass) == 0) {

//         header("Location: ../marketAdView/marketAd_profile.php?error=Your current password does not matches with the password you provided. Please try again.");
//         exit();
//     } else {

//         if ($new_password == $confirm_password) {

//             $select = "UPDATE market_admin SET password ='$new_password' WHERE market_admin_ID='$market_admin_ID'";

//             if (mysqli_query($conn, $select)) {

//                 header("Location: ../marketAdView/marketAd_profile.php?success=Updated Successfully");
//                 exit();
//             } else {

//                 header("Location: ../marketAdView/marketAd_profile.php?error=Update Failed.");
//                 exit();
//             }
//         } else {

//             header("Location: ../marketAdView/marketAd_profile.php?error=Your new password does not matches with the confirmation password you provided. Please try again.");
//             exit();
//         }
//     }
// }

if (isset($_POST['update_marketAd_profile'])) {

    $market_admin_ID = $_POST['market_admin_ID'];
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $current_password = md5($_POST['password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    $checkbox = $_POST['updatepass'];

    $select = "UPDATE market_admin SET contact ='$contact', email ='$email', password ='$new_password' WHERE market_admin_ID='$market_admin_ID'";
    $select1 = "UPDATE market_admin SET contact ='$contact', email ='$email' WHERE market_admin_ID='$market_admin_ID'";

    $current_pass = "SELECT * FROM market_admin WHERE password = '$current_password'";
    $pass = mysqli_query($conn, $current_pass);

    if ($checkbox == 1) {
        if (mysqli_num_rows($pass) == 0) {
            $_SESSION['error'] = "Your current password does not match the password you provided. Please try again";
            header("Location: ../marketAdView/marketAd_profile_edit.php?edit_marketAd=$market_admin_ID");
            exit();
        } else {
            if ($new_password == $confirm_password) {
                if (mysqli_query($conn, $select)) {
                    $_SESSION['success'] = "Updated successfully";
                    header("Location: ../marketAdView/marketAd_profile.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Update Failed";
                    header("Location: ../marketAdView/marketAd_profile.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Your new password does not match the confirmation password you provided. Please try again";
                header("Location: ../marketAdView/marketAd_profile_edit.php?edit_marketAd=$market_admin_ID");
                exit();
            }
        }
    } else {
        mysqli_query($conn, $select1);
        $_SESSION['success'] = "Updated successfully";
        header("Location: ../marketAdView/marketAd_profile.php");
        exit();
    }
}

//Add map
if (isset($_POST['add_map'])) {

    $market_admin_ID = $_POST['market_admin_ID'];
    $map_name = $_POST['map_name'];
    $fileName = $_FILES['path']['name'];
    $fileTmp = $_FILES['path']['tmp_name'];
    $fileSize = $_FILES['path']['size'];
    $fileError = $_FILES['path']['error'];
    $fileType = $_FILES['path']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = ['jpg', 'png', 'jpeg', 'jfif'];
    $market_ID = $_POST['market_ID'];
    $map_floor = $_POST['map_floor'];

    $floor = "SELECT * FROM map WHERE map_floor ='$map_floor' AND map_name ='$map_name'";

    $map_floor1 = mysqli_query($conn, $floor);

    session_start();

    if (mysqli_num_rows($map_floor1) > 0) {
        $_SESSION['error'] = "Map floor is already exist";
        header("Location: ../marketAdView/marketAd_map_add.php");
        exit();
    } else {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) {
                    $fileNameNew = uniqid() . "." . $fileActualExt;
                    $fileDir = "../map_img/" . $fileNameNew;
                    $add_map = "INSERT INTO map (market_admin_ID, market_ID, map_name, map_floor, map_img) VALUES ('$market_admin_ID','$market_ID','$map_name','$map_floor','$fileDir')";
                    $map = mysqli_query($conn, $add_map);
                    if ($map) {
                        move_uploaded_file($fileTmp, $fileDir);
                        $_SESSION['success'] = "Added Successfully";
                        header("Location: ../marketAdView/marketAd_map.php");
                        exit();
                    } else {
                        $_SESSION['error'] = "Upload Failed";
                        header("Location: ../marketAdView/marketAd_map_add.php");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "File is too big";
                    header("Location: ../marketAdView/marketAd_map_add.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Upload Failed";
                header("Location: ../marketAdView/marketAd_map_add.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "File type is not accepted";
            header("Location: ../marketAdView/marketAd_map_add.php");
            exit();
        }
    }
}

//Delete Map
if (isset($_GET['delete_map'])) {

    $map_ID = $_GET['delete_map'];

    $select5 = "DELETE FROM map WHERE map_ID ='$map_ID'";
    $result5 = mysqli_query($conn, $select5);

    if ($result5) {
        $_SESSION['success'] = "Deleted Successfully";
        header("Location: ../marketAdView/marketAd_map.php");
        exit();
    } else {
        $_SESSION['error'] = "Deletion Failed";
        header("Location: ../marketAdView/marketAd_map.php");
        exit();
    }
}

//Update Map
if (isset($_POST['update_map'])) {

    $map_ID = $_POST['map_ID'];
    $map_name = $_POST['map_name'];
    $newMap = $_POST['path'];
    $currentMap = $_POST['current_path'];
    $map_floor = $_POST['map_floor'];
    $fileName = $_FILES['path']['name'];
    $fileTmp = $_FILES['path']['tmp_name'];
    $fileSize = $_FILES['path']['size'];
    $fileError = $_FILES['path']['error'];
    $fileType = $_FILES['path']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = ['jpg', 'png', 'jpeg', 'jfif'];

    if (in_array($fileActualExt, $allowed)) {

        if ($fileError === 0) {

            if ($fileSize < 5000000) {

                $fileNameNew = uniqid() . "." . $fileActualExt;
                $fileDir = "../map_img/" . $fileNameNew;

                $upmap = "UPDATE map SET map_name ='$map_name', map_floor='$map_floor', map_img='$fileDir' WHERE map_ID ='$map_ID'";

                $upmap1 = mysqli_query($conn, $upmap);

                if ($upmap1) {

                    move_uploaded_file($fileTmp, $fileDir);

                    $_SESSION['success'] = "Updated Successfully";
                    header("Location: ../marketAdView/marketAd_map.php");
                    exit();
                } else {

                    $_SESSION['error'] = "Update Failed";
                    header("Location: ../marketAdView/marketAd_map_edit.php?edit_map=$map_ID");
                    exit();
                }
            } else {

                $_SESSION['error'] = "File is too big";
                header("Location: ../marketAdView/marketAd_map_edit.php?edit_map=$map_ID");
                exit();
            }
        } else {

            $_SESSION['error'] = "Update Failed";
            header("Location: ../marketAdView/marketAd_map_edit.php?edit_map=$map_ID");
            exit();
        }
    } else {

        $upcurrentmap = "UPDATE map SET map_name ='$map_name', map_floor='$map_floor', map_img='$currentMap' WHERE map_ID ='$map_ID'";

        $update = mysqli_query($conn, $upcurrentmap);

        $_SESSION['success'] = "Updated Successfully";
        header("Location: ../marketAdView/marketAd_map.php");
        exit();
    }
}

//Update Vendor Account
if (isset($_POST['update_vendor'])) {

    $vendor_ID = $_POST['vendor_ID'];

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);

    $select = "UPDATE vendor SET name ='$name', contact ='$contact', username ='$username', email ='$email', password ='$pass' WHERE vendor_ID='$vendor_ID'";

    if (mysqli_query($conn, $select)) {
        $_SESSION['success'] = "Updated Successfully";
        header("Location: ../marketAdView/marketAd_vendor_acc.php");
        exit();
    } else {
        $_SESSION['error'] = "Update Failed";
        header("Location: ../marketView/marketAd_vendor_edit.php?edit_vendor=$vendor_ID");
        exit();
    }
}

//Delete Vendor Account
if (isset($_GET['delete_vendor'])) {

    $vendor_ID = $_GET['delete_vendor'];

    $select = "DELETE FROM vendor WHERE vendor_ID ='$vendor_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Deleted Successfully";
        header("Location: ../marketAdView/marketAd_vendor_acc.php");
        exit();
    } else {
        $_SESSION['error'] = "Deletion Failed";
        header("Location: ../marketAdView/marketAd_vendor_acc.php");
        exit();
    }
}

//Approve Vendor Registration
if (isset($_POST['approve_vendor'])) {

    $vendor_ID = $_POST['vendor_ID'];
    $ma_ID = $_POST['market_admin_ID'];

    $select = "UPDATE vendor SET vendor_status = '1' WHERE vendor_ID = '$vendor_ID'";
    $result = mysqli_query($conn, $select);

    $vendor = "SELECT * FROM vendor WHERE vendor_ID='$vendor_ID'";
    $vendor_result = mysqli_query($conn, $vendor);
    $row = mysqli_fetch_assoc($vendor_result);
    $stall_name = $row['name'] . " Stall";

    $insert_stall = "INSERT INTO stall (market_admin_ID, vendor_ID, stall_name, stall_status) VALUES ('$ma_ID','$vendor_ID','$stall_name', '1')";
    $stall = mysqli_query($conn, $insert_stall);
    
    if ($stall) {
        if ($result) {
            $_SESSION['success'] = "Approved Successfully";
            header("Location: ../marketAdView/marketAd_vendor_validate.php");
            exit();
        } else {
            $_SESSION['error'] = "Approval Failed";
            header("Location: ../marketAdView/marketAd_vendor_validate.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Approval Failed";
        header("Location: ../marketAdView/marketAd_vendor_validate.php");
        exit();
    }
}

//Deny Vendor Registration
if (isset($_GET['deny_vendor'])) {

    $vendor_ID = $_GET['deny_vendor'];

    $select2 = "DELETE FROM vendor WHERE vendor_ID ='$vendor_ID'";
    $result2 = mysqli_query($conn, $select2);

    if ($result2) {
        $_SESSION['success'] = "Rejected Successfully";
        header("Location: ../marketAdView/marketAd_vendor_validate.php");
        exit();
    } else {
        $_SESSION['error'] = "Rejection Failed";
        header("Location: ../marketAdView/marketAd_vendor_validate.php");
        exit();
    }
}

//plot stall
if (isset($_POST['plot_stall'])) {

    $map_ID = $_POST['map_ID'];
    $stall_ID = $_POST['stall_ID'];
    $lat = $_POST['latitude'];
    $long = $_POST['longitude'];

    if ($stall_ID > 0) {

        $plotstall = "UPDATE stall SET latitude='$lat', longitude='$long', map_ID='$map_ID', stall_status='2' WHERE stall_ID='$stall_ID'";

        if (mysqli_query($conn, $plotstall)) {
            $_SESSION['success'] = "Plotted Successfully";
            header("Location: ../marketAdView/marketAd_map_view.php?map_view=" . $map_ID);
            exit();
        } else {
            $_SESSION['error'] = "Plotting Failed";
            header("Location: ../marketAdView/marketAd_map_view.php?map_view=" . $map_ID);
            exit();
        }
    } else {
        $_SESSION['error'] = "No stall was selected. Please try again";
        header("Location: ../marketAdView/marketAd_map_view.php?map_view=" . $map_ID);
        exit();
    }
}

//Activate vendor stall
if (isset($_POST['activate_stall'])) {

    $stall_ID = $_POST['stall_ID'];
    $vendor_ID = $_POST['vendor_ID'];
    $select = "UPDATE stall SET stall_status = '2' WHERE stall_ID = '$stall_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Activated Successfully";
        header("Location: ../marketAdView/marketAd_vendor_stall.php?view_vendor_stall=$vendor_ID");
        exit();
    } else {
        $_SESSION['error'] = "Activation Failed";
        header("Location: ../marketAdView/marketAd_vendor_stall.php?view_vendor_stall=$vendor_ID");
        exit();
    }
}

//Deactivate vendor stall
if (isset($_POST['deactivate_stall'])) {

    $stall_ID = $_POST['stall_ID'];
    $vendor_ID = $_POST['vendor_ID'];
    $select = "UPDATE stall SET stall_status = '0' WHERE stall_ID = '$stall_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Deactivated Successfully";
        header("Location: ../marketAdView/marketAd_vendor_stall.php?view_vendor_stall=$vendor_ID");
        exit();
    } else {
        $_SESSION['error'] = "Deactivation Failed";
        header("Location: ../marketAdView/marketAd_vendor_stall.php?view_vendor_stall=$vendor_ID");
        exit();
    }
}

// Remove stall from map
if (isset($_POST['remove_stall'])) {

    $market_admin_ID = $_POST['market_admin_ID'];
    $stall_ID = $_POST['stall_ID'];
    $map_ID = $_POST['map_ID'];

    $select = "UPDATE stall SET stall_status = '1', latitude='0', longitude='0' WHERE market_admin_ID='$market_admin_ID' AND stall_ID = '$stall_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Removed successfully";
        header("Location: ../marketAdView/marketAd_map_view.php?map_view=" . $map_ID);
        exit();
    } else {
        $_SESSION['error'] = "Removal Failed";
        header("Location: ../marketAdView/marketAd_map_view.php?map_view=" . $map_ID);
        exit();
    }
}

// if (isset($_POST['accept_reserve_stall'])) {

//     $stall_ID = $_POST['stall_ID'];
//     $map_ID = $_POST['map_ID'];
//     $stall_name = $_POST['stall_name'];

//     $select = "UPDATE stall SET stall_status = '2', stall_name='$stall_name' WHERE stall_ID = '$stall_ID'";
//     $result = mysqli_query($conn, $select);

//     if ($result) {

//         header("Location: ../marketAdView/marketAd_map_view.php?success=Approved successfully.&&map_view=" . $map_ID);
//         exit();
//     } else {

//         header("Location: ../marketAdView/marketAd_map_view.php?error=Approval Failed.&&map_view=" . $map_ID);
//         exit();
//     }
// }

// if (isset($_POST['reject_reserve_stall'])) {

//     $stall_ID = $_POST['stall_ID'];
//     $map_ID = $_POST['map_ID'];

//     $select = "UPDATE stall SET vendor_ID='0', stall_status='0', Stall_name='Available' WHERE stall_ID = '$stall_ID'";
//     $result = mysqli_query($conn, $select);

//     if ($result) {

//         header("Location: ../marketAdView/marketAd_map_view.php?success=Rejected successfully.&&map_view=" . $map_ID);
//         exit();
//     } else {

//         header("Location: ../marketAdView/marketAd_map_view.php?error=Rejection Failed.&&map_view=" . $map_ID);
//         exit();
//     }
// }

// if (isset($_POST['remove_vendor'])) {

//     $stall_ID = $_POST['stall_ID'];
//     $map_ID = $_POST['map_ID'];

//     $select = "UPDATE stall SET vendor_ID='0', stall_status='0', Stall_name='Available' WHERE stall_ID = '$stall_ID'";
//     $result = mysqli_query($conn, $select);

//     if ($result) {

//         header("Location: ../marketAdView/marketAd_map_view.php?success=Removed successfully.&&map_view=" . $map_ID);
//         exit();
//     } else {

//         header("Location: ../marketAdView/marketAd_map_view.php?error=Removal Failed.&&map_view=" . $map_ID);
//         exit();
//     }
// }
