<?php

@include '../config.php';

session_start();

//Admin CRUD Functions//

// //Update Admin Profile
// if (isset($_POST['update_admin'])) {

//     $admin_ID = $_POST['admin_ID'];

//     $name = mysqli_real_escape_string($conn, $_POST['name']);
//     $contact = mysqli_real_escape_string($conn, $_POST['contact']);
//     $email = mysqli_real_escape_string($conn, $_POST['email']);

//     $select = "UPDATE admin SET name ='$name', contact ='$contact', email ='$email' WHERE admin_ID='$admin_ID'";

//     if (mysqli_query($conn, $select)) {

//         header("Location: ../adminView/admin_profile.php?success=Updated Successfully.");
//         exit();
//     } else {

//         header("Location: ../adminView/admin_profile_edit.php?error=Update Failed.");
//         exit();
//     }
// }

//Update Admin Profile
if (isset($_POST['update_admin_profile'])) {

    $admin_ID = $_POST['admin_ID'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $current_password = md5($_POST['password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    $checkbox = $_POST['updatepass'];

    $select = "UPDATE admin SET name='$name', contact ='$contact', email ='$email', password ='$new_password' WHERE admin_ID='$admin_ID'";
    $select1 = "UPDATE admin SET name='$name', contact ='$contact', email ='$email' WHERE admin_ID='$admin_ID'";

    $current_pass = "SELECT * FROM admin WHERE password = '$current_password'";
    $pass = mysqli_query($conn, $current_pass);

    if ($checkbox == 1) {

        if (!isset($current_password)) {
            $_SESSION['error'] = "Enter your current password";
            header("Location: ../adminView/admin_profile_edit.php?edit_admin=$admin_ID");
            exit();
        } else {
            $pass = mysqli_query($conn, "SELECT * FROM admin WHERE admin_ID='$admin_ID' AND password='$current_password'");
            if (mysqli_num_rows($pass) == 0) {
                $_SESSION['error'] = "Your current password does not match the password you provided";
                header("Location: ../adminView/admin_profile_edit.php?edit_admin=$admin_ID");
                exit();
            } else {
                if (!isset($new_password) || !isset($confirm_password)) {
                    $_SESSION['error'] = "Please fill up the new password and confirm password fields";
                    header("Location: ../adminView/admin_profile_edit.php?edit_admin=$admin_ID");
                    exit();
                } else {
                    if ($new_password == $confirm_password) {
                        $select = "UPDATE admin SET password='$new_password' WHERE admin_ID='$admin_ID'";
                        if (mysqli_query($conn, $select)) {
                            $_SESSION['success'] = "Updated successfully";
                            header("Location: ../adminView/admin_profile.php");
                            exit();
                        } else {
                            $_SESSION['error'] = "Update Failed";
                            header("Location: ../adminView/admin_profile.php");
                            exit();
                        }
                    } else {
                        $_SESSION['error'] = "Your new password does not match the confirmation password you provided. Please try again";
                        header("Location: ../adminView/admin_profile_edit.php?edit_admin=$admin_ID");
                        exit();
                    }
                }
            }
        }
    } else {
        (mysqli_query($conn, $select1));
        $_SESSION['success'] = "Updated successfully";
        header("Location: ../adminView/admin_profile.php");
        exit();
    }
}

//Create Market
if (isset($_POST['create_market'])) {

    $admin_ID = $_POST['admin_ID'];

    $market_name = mysqli_real_escape_string($conn, $_POST['market_name']);
    $market = "SELECT * FROM market WHERE market_name = '$market_name'";

    $marketname = mysqli_query($conn, $market);

    if (mysqli_num_rows($marketname) > 0) {
        $_SESSION['error'] = "Market already exist";
        header("Location: ../adminView/admin_market.php");
        exit();
    } else {

        $cmarket = "INSERT INTO market (market_name, admin_ID, market_status) VALUES ('$market_name','$admin_ID','0')";

        if (mysqli_query($conn, $cmarket)) {
            $_SESSION['success'] = "Created Successfully";
            header("Location: ../adminView/admin_market.php");
            exit();
        } else {
            $_SESSION['error'] = "Creation Failed";
            header("Location: ../adminView/admin_market_add.php");
            exit();
        }
    }
}

//Delete Market
if (isset($_POST['delete_market'])) {

    $market_ID = $_POST['market_ID'];
    $admin_ID = $_POST['admin_ID'];

    $select = "DELETE FROM market WHERE market_ID ='$market_ID' AND admin_ID ='$admin_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Deleted Successfully";
        header("Location: ../adminView/admin_market.php");
        exit();
    } else {
        $_SESSION['error'] = "Deletion Failed";
        header("Location: ../adminView/admin_market.php");
        exit();
    }
}

//Update Market
if (isset($_POST['update_market'])) {

    $market_ID = $_POST['market_ID'];

    $market_name = $_POST['market_name'];

    $sec = "SELECT market_name FROM market WHERE market_name='$market_name'";
    $check = mysqli_query($conn, $sec);
    if (mysqli_num_rows($check) > 0) {
        $_SESSION['error'] = "Market already exist";
        header("Location: ../adminView/admin_market.php");
        exit();
    } else {
        $select = "UPDATE market SET market_name ='$market_name' WHERE market_ID='$market_ID'";
        if (mysqli_query($conn, $select)) {
            $_SESSION['success'] = "Updated Successfully";
            header("Location: ../adminView/admin_market.php");
            exit();
        } else {
            $_SESSION['error'] = "Update Failed";
            header("Location: ../adminView/admin_market.php");
            exit();
        }
    }
}

//Update Customer Account
if (isset($_POST['update_customer'])) {

    $customer_ID = $_POST['customer_ID'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    $checkbox = $_POST['updatepass'];

    $select = "UPDATE customer SET name ='$name', contact ='$contact', username ='$username', email ='$email', password ='$pass' WHERE customer_ID='$customer_ID'";
    $select1 = "UPDATE customer SET name ='$name', contact ='$contact', username ='$username', email ='$email' WHERE customer_ID='$customer_ID'";

    if ($checkbox == 1) {
        if ($pass == $confirm_password) {

            if (mysqli_query($conn, $select)) {
                $_SESSION['success'] = "Updated Successfully";
                header("Location: ../adminView/admin_customer_acc.php");
                exit();
            } else {
                $_SESSION['error'] = "Update Failed";
                header("Location: ../adminView/admin_customer_acc.php?edit_customer=$customer_ID");
                exit();
            }
        } else {
            $_SESSION['error'] = "error=Your new password does not matches with the confirmation password you provided. Please try again";
            header("Location: ../adminView/admin_customer_edit.php?edit_customer=$customer_ID");
            exit();
        }
    } else {
        if (mysqli_query($conn, $select1)) {
            $_SESSION['success'] = "Updated Successfully";
            header("Location: ../adminView/admin_customer_acc.php");
            exit();
        } else {
            $_SESSION['error'] = "Update Failed";
            header("Location: ../adminView/admin_customer_edit.php");
            exit();
        }
    }
}

//Delete Customer Account
if (isset($_GET['delete_customer'])) {

    $customer_ID = $_GET['delete_customer'];

    $select = "DELETE FROM customer WHERE customer_ID ='$customer_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Delete Successfully";
        header("Location: ../adminView/admin_customer_acc.php");
        exit();
    } else {
        $_SESSION['error'] = "Deletion Failed";
        header("Location: ../adminView/admin_customer_acc.php");
        exit();
    }
}

//Update Market Admin Account
if (isset($_POST['update_marketAd'])) {

    $market_admin_ID = $_POST['market_admin_ID'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    $checkbox = $_POST['updatepass'];
    $select = "UPDATE market_admin SET name ='$name', contact ='$contact', username ='$username', email ='$email', password ='$pass' WHERE market_admin_ID='$market_admin_ID'";
    $select1 = "UPDATE market_admin SET name ='$name', contact ='$contact', username ='$username', email ='$email' WHERE market_admin_ID='$market_admin_ID'";
    if ($checkbox == 1) {

        if ($pass == $confirm_password) {

            if (mysqli_query($conn, $select)) {

                $_SESSION['success'] = "Updated successfully";
                header("Location: ../adminView/admin_marketAd_acc.php");
                exit();
            } else {

                $_SESSION['error'] = "Update Failed";
                header("Location: ../adminView/admin_marketAd_edit.php?edit_marketAd=$market_admin_ID");
                exit();
            }
        } else {

            $_SESSION['error'] = "Your new password does not match with the confirmation password you provided. Please try again";
            header("Location: ../adminView/admin_marketAd_edit.php?edit_marketAd=$market_admin_ID");
            exit();
        }
    } else {
        if (mysqli_query($conn, $select1)) {
            $_SESSION['success'] = "Updated Successfully";
            header("Location: ../adminView/admin_marketAd_acc.php");
            exit();
        } else {
            $_SESSION['error'] = "Update Failed";
            header("Location: ../adminView/admin_marketAd_edit.php?edit_marketAd=$market_admin_ID");
            exit();
        }
    }
}

//Delete Market Admin Account
if (isset($_GET['delete_marketAd'])) {

    $market_admin_ID = $_GET['delete_marketAd'];

    $select = "DELETE FROM market_admin WHERE market_admin_ID ='$market_admin_ID'";

    $update = "UPDATE market, market_admin SET market_status='0' WHERE market_admin_ID='$market_admin_ID' AND market.market_ID=market_admin.market_ID";

    if ($market = mysqli_query($conn, $update)) {
        if ($result = mysqli_query($conn, $select)) {
            $_SESSION['success'] = 'Deleted Successfully';
            header("Location: ../adminView/admin_marketAd_acc.php");
            exit();
        }
    } else {
        $_SESSION['error'] = 'Deletion Failed';
        header("Location: ../adminView/admin_marketAd_acc.php");
        exit();
    }
}

//Approve Market Admin Registration
if (isset($_POST['approve_marketAd'])) {

    $market_admin_ID = $_POST['market_admin_ID'];
    $market_ID = $_POST['market_ID'];

    $select = "UPDATE market_admin SET market_admin_status = '1' WHERE market_admin_ID = '$market_admin_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $market = "UPDATE market SET market_status = '1' WHERE market_ID = '$market_ID'";
        $result1 = mysqli_query($conn, $market);
        if ($result1) {
            $_SESSION['success'] = "Approved Successfully";
            header("Location: ../adminView/admin_marketAd_validate.php");
            exit();
        } else {
            $_SESSION['error'] = "Approval Failed";
            header("Location: ../adminView/admin_marketAd_validate.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Approval Failed";
        header("Location: ../adminView/admin_marketAd_validate.php");
        exit();
    }
}

//Deny Market Admin Registration
if (isset($_GET['deny_marketAd'])) {

    $market_admin_ID = $_GET['deny_marketAd'];

    $select2 = "DELETE FROM market_admin WHERE market_admin_ID ='$market_admin_ID'";
    $delete = mysqli_query($conn, $select2);

    if ($delete) {
        $_SESSION['success'] = "Rejected Successfully";
        header("Location: ../adminView/admin_marketAd_validate.php");
        exit();
    } else {
        $_SESSION['error'] = "Rejection Failed";
        header("Location: ../adminView/admin_marketAd_validate.php");
        exit();
    }
}

//Add Market Admin
if (isset($_POST['marketAd_add'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $market_ID = mysqli_real_escape_string($conn, $_POST['market_ID']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    if ($market_ID > '0') {

        $sql0 = "SELECT * FROM market_admin WHERE username='$username'";

        $result0 = mysqli_query($conn, $sql0);

        if (mysqli_num_rows($result0) > 0) {

            $_SESSION['error'] = "The username is already exist";
            header("Location: ../adminView/admin_marketAd_acc.php");
            exit();
        } else {

            if ($pass === $cpass) {

                $sql1 = "INSERT INTO market_admin (name, contact, admin_ID, market_ID, market_admin_status, username, email, password) VALUES ('$name','$contact','1','$market_ID','1','$username','$email','$pass')";

                $update = "UPDATE market SET market_status='1' WHERE market_ID='$market_ID'";
                if (mysqli_query($conn, $sql1)) {

                    if (mysqli_query($conn, $update)) :

                        $_SESSION['success'] = "Added Successfully";
                        header("Location: ../adminView/admin_marketAd_acc.php");
                        exit();

                    endif;
                } else {

                    $_SESSION['error'] = "Addition Failed.";
                    header("Location: ../adminView/admin_marketAd_acc.php");
                    exit();
                }
            } else {

                $_SESSION['error'] = "Password does not matches with the confirmation password you provided. Please try again";
                header("Location: ../adminView/admin_marketAd_acc.php");
                exit();
            }
        }
    } else {

        $_SESSION['error'] = "No market was selected. Please try again";
        header("Location: ../adminView/admin_marketAd_acc.php");
        exit();
    }
}

//Add Vendor
if (isset($_POST['vendor_add'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $market_admin_ID = mysqli_real_escape_string($conn, $_POST['market_admin_ID']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    if ($market_admin_ID > '0') {
        $sql2 = "SELECT * FROM vendor WHERE username='$username'";
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            $_SESSION['error'] = "The username is already exist";
            header("Location: ../adminView/admin_vendor_acc.php");
            exit();
        } else {
            if ($pass === $cpass) {
                $sql3 = "INSERT INTO vendor (name, contact, email, market_admin_ID, username, password, vendor_status) VALUES ('$name','$contact','$email','$market_admin_ID','$username','$pass','1')";
                if (mysqli_query($conn, $sql3)) {
                    $_SESSION['success'] = "Added Successfully";
                    header("Location: ../adminView/admin_vendor_acc.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Addition Failed";
                    header("Location: ../adminView/admin_vendor_acc.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Password does not matches with the confirmation password you provided. Please try again";
                header("Location: ../adminView/admin_vendor_acc.php");
                exit();
            }
        }
    } else {
        $_SESSION['error'] = "No market was selected. Please try again";
        header("Location: ../adminView/admin_vendor_acc.php");
        exit();
    }
}

//delete vendor acc
if (isset($_GET['delete_vendor'])) {

    $vendor_ID = $_GET['delete_vendor'];

    $select = "DELETE FROM vendor WHERE vendor_ID ='$vendor_ID'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        $_SESSION['success'] = "Delete Successfully";
        header("Location: ../adminView/admin_vendor_acc.php");
        exit();
    } else {
        $_SESSION['error'] = "Deletion Failed";
        header("Location: ../adminView/admin_vendor_acc.php");
        exit();
    }
}

// update vendor 
if (isset($_POST['update_vendor'])) {

    $vendor_ID = $_POST['vendor_ID'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    $checkbox = $_POST['updatepass'];

    $select = "UPDATE vendor SET name ='$name', contact ='$contact', username ='$username', email ='$email', password ='$pass' WHERE vendor_ID='$vendor_ID'";
    $select1 = "UPDATE vendor SET name ='$name', contact ='$contact', username ='$username', email ='$email' WHERE vendor_ID='$vendor_ID'";
    if ($checkbox == 1) {
        if ($pass == $confirm_password) {
            if (mysqli_query($conn, $select)) {
                $_SESSION['success'] = "Updated successfully";
                header("Location: ../adminView/admin_vendor_acc.php");
                exit();
            } else {
                $_SESSION['error'] = "Update Failed";
                header("Location: ../adminView/admin_vendor_edit.php?edit_vendor=$vendor_ID");
                exit();
            }
        } else {

            $_SESSION['error'] = "Your new password does not match with the confirmation password you provided. Please try again";
            header("Location: ../adminView/admin_vendor_edit.php?edit_vendor=$vendor_ID");
            exit();
        }
    } else {
        if (mysqli_query($conn, $select1)) {
            $_SESSION['success'] = "Updated Successfully";
            header("Location: ../adminView/admin_vendor_acc.php");
            exit();
        } else {
            $_SESSION['error'] = "Update Failed";
            header("Location: ../adminView/admin_vendor_acc.php");
            exit();
        }
    }
}
//Add Customer
if (isset($_POST['customer_add'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    $sql4 = "SELECT * FROM customer WHERE username='$username'";

    $result4 = mysqli_query($conn, $sql4);

    if (mysqli_num_rows($result4) > 0) {
        $_SESSION['error'] = "The username already exists";
        header("Location: ../adminView/admin_customer_acc.php");
        exit();
    } else {
        if ($pass === $cpass) {
            $sql5 = "INSERT INTO customer (name, contact, username, email, password) VALUES ('$name','$contact','$username','$email','$pass')";

            if (mysqli_query($conn, $sql5)) {
                $_SESSION['success'] = "Added successfully";
                header("Location: ../adminView/admin_customer_acc.php");
                exit();
            } else {
                $_SESSION['error'] = "Addition failed.";
                header("Location: ../adminView/admin_customer_acc.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Password does not match with the confirmation password you provided. Please try again";
            header("Location: ../adminView/admin_customer_acc.php");
            exit();
        }
    }
}
