<?php

@include '../includes/admin.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size px-4" href="admin_customer_acc.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="col-md-5 p-5 mb-5 align-items-center justify-content-center text-light rounded" style="background-color: #708D81;">
        <div class="col-md-4 m-auto">
            <img class="logo-user img-fluid" src="../img/user-logo.png" style="height:123px" />
        </div>
        <form action="../includes/admin.crud.php" method="post">
            <div class="">
                <div class="form-group row">
                    <label>
                        <p class="text-center mb-0" style="font-size: 20px; color: #001427;">Update Customer Profile</h5>
                    </label>
                </div>
                <?php
                $customer_ID = $_GET['edit_customer'];
                $sql = "SELECT * FROM customer WHERE customer_ID ='$customer_ID'";
                $result2 = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result2)) {
                    $customer_ID = $row['customer_ID'];
                    $name = $row['name'];
                    $contact = $row['contact'];
                    $username = $row['username'];
                    $email = $row['email'];
                }
                ?>

                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 mb-2 me-1">
                        <label style="color: #001427;" class="text-size">Name:</label>
                        <input class="form-control text-dark" type="text" name="name" required placeholder="Enter your name" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label style="color: #001427;" class="text-size">Contact:</label>
                        <input class="form-control text-dark" type="text" name="contact" required placeholder="Enter your contact" value="<?php echo $contact; ?>">
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 mb-2 me-1">
                        <label style="color: #001427;" class="text-size">Username:</label>
                        <input class="form-control text-dark" type="text" name="username" required placeholder="Enter your username" value="<?php echo $username; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label style="color: #001427;" class="text-size">Email:</label>
                        <input class="form-control text-dark" type="email" name="email" required placeholder="Enter your email" value="<?php echo $email; ?>">
                    </div>
                </div>

                <div class="form-group mb-1">
                    <div class="d-flex align-items-center">
                        <input class="form-check-input" name="updatepass" id="checkbox" value="1" type="checkbox" />
                        <label style="color: #001427;" class="align-self-center ms-1"><i style="font-size:10px">check to update
                                password</i></label>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 mb-2 me-1">
                        <label style="color: #001427;" class="text-size">New Password:</label>
                        <input class="form-control text-dark" id="password" type="password" name="password" placeholder="Enter new password" value="">
                    </div>
                    <div class="form-group mb-2">
                        <label style="color: #001427;" class="text-size">Confirm New Password:</label>
                        <input class="form-control text-dark" type="password" name="confirm_password" placeholder="Confirm new password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row m-auto">
                        <input type="hidden" name="customer_ID" value="<?php echo $customer_ID; ?>" />
                        <input class="text-light button-size btn btn-primary" id="submitedit" type="submit" name="update_customer" value="Update">
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>