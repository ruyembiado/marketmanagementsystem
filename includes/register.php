<?php

@include '../config.php';

session_start();

//Market Admin Registration
if(isset($_POST['marketAd_reg'])){
	
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $market_ID = mysqli_real_escape_string($conn, $_POST['market_ID']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$pass = md5($_POST['password']);
	$cpass = md5($_POST['cpassword']);

    if($market_ID > '0'){

        $sql0 = "SELECT * FROM market_admin WHERE username='$username'";
    
        $result0 = mysqli_query($conn, $sql0);
    
        if(mysqli_num_rows($result0) > 0){
    
            $_SESSION['error'] = "The username is already exist";
            header("Location: ../marketAd_reg.php");
            exit();
    
        }else{
    
            if($pass === $cpass){
    
                $sql1 = "INSERT INTO market_admin (name, contact, admin_ID, market_ID, market_admin_status, username, email, password) VALUES ('$name','$contact','1','$market_ID','0','$username','$email','$pass')";
    
                if(mysqli_query($conn, $sql1)){
    
                    $_SESSION['success'] = "Your account has been created successfully. Wait for the admin to verify your account";
                    header("Location: ../marketAd_reg.php");
                    exit();
    
                }else{
    
                    $_SESSION['error'] = "Something went wrong";
                    header("Location: ../marketAd_reg.php");
                    exit();
    
                }
    
            }else{
    
                $_SESSION['error'] = "Password are not matched";
                header("Location: ../marketAd_reg.php");
                exit();

            }
        }
    }else{
        $_SESSION['error'] = "No market was selected. Please try again";
        header("Location: ../marketAd_reg.php");
        exit();
    }    
}

//Vendor Registration
if (isset($_POST['vendor_reg'])){
	
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $market_admin_ID = mysqli_real_escape_string($conn, $_POST['market_admin_ID']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$pass = md5($_POST['password']);
	$cpass = md5($_POST['cpassword']);

    if($market_admin_ID > '0'){

        $sql2 = "SELECT * FROM vendor WHERE username='$username'";
    
        $result2 = mysqli_query($conn, $sql2);
    
        if(mysqli_num_rows($result2) > 0){
    
            $_SESSION['error'] = "The username is already exist";
            header("Location: ../vendor_reg.php");
            exit();
    
        }else{
    
            if($pass === $cpass){
    
                $sql3 = "INSERT INTO vendor (name, contact, email, market_admin_ID, username, password, vendor_status) VALUES ('$name','$contact','$email','$market_admin_ID','$username','$pass','0')";
    
                if(mysqli_query($conn, $sql3)){
    
                    $_SESSION['success'] = "Your account has been created successfully. Wait for the admin to verify your account";
                    header("Location: ../vendor_reg.php");
                    exit();
    
                }else{
    
                    $_SESSION['error'] = "Something went wrong";
                    header("Location: ../vendor_reg.php");
                    exit();
    
                }
    
            }else{
    
                $_SESSION['error'] = "Password are not matched";
                header("Location: ../vendor_reg.php");
                exit();
    
            }
        }
    
    }else{
    
        $_SESSION['error'] = "No market was selected. Please try again";
        header("Location: ../vendor_reg.php");
        exit();
    
    }
    
}

//Customer Registration
if (isset($_POST['customer_reg'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$pass = md5($_POST['password']);
	$cpass = md5($_POST['cpassword']);
	
	$sql4 = "SELECT * FROM customer WHERE username='$username'";

	$result4 = mysqli_query($conn, $sql4);

	if(mysqli_num_rows($result4) > 0){

		$_SESSION['error'] = "The username is already exist";
		header("Location: ../customer_reg.php");
	    exit();

	}else{

        if($pass === $cpass){

            $sql5 = "INSERT INTO customer (name, contact, username, email, password) VALUES ('$name','$contact','$username','$email','$pass')";

            if(mysqli_query($conn, $sql5)){

                $_SESSION['success'] = "Your account has been created successfully";
                header("Location: ../customer_reg.php");
	            exit();

            }else{

                $_SESSION['error'] = "Something went wrong";
                header("Location: ../customer_reg.php");
                exit();
            
            }

        }else{

            $_SESSION['error'] = "Password are not matched";
            header("Location: ../customer_reg.php");
		    exit();

        }
    }
}
