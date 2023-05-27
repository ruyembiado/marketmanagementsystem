<?php

@include '../includes/customer.header.php';

?>

<div class="row justify-content-center mx-0" style="height:621px">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-warning text-dark button-size text-bold" href="customer_profile.php" role="button"><i
                    class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="col-md-5 p-5 mb-5 align-items-center justify-content-center bg-dark text-dark rounded">
        <div class="col-md-4 m-auto">
            <img class="logo-user img-fluid" src="../img/user-logo.png" style="height:123px" />
        </div>
        <form action="../includes/customer.crud.php" method="post">
            <div class="">
                <div class="form-group row">
                    <label>
                        <h4 class="text-light mb-3 text-center">Update Password</h4>
                    </label>
                </div>
                <!-- <div class="form-group row text-center">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="text-danger"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                </div> -->
                <?php
                $customer_ID = $_GET['edit_customer'];
                $sql1 = "SELECT * FROM customer WHERE customer_ID ='$customer_ID'";
                $result2 = mysqli_query($conn, $sql1);
                while ($row = mysqli_fetch_assoc($result2)) {
                    $customer_ID = $row['customer_ID'];
                    $name = $row['name'];
                    $contact = $row['contact'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $pass = $row['password'];
                }
                ?>
                <div class="form-group mb-2">
                    <label class="text-light text-size">Current Password:</label>
                    <input class="form-control text-dark" type="password" name="password" required
                        placeholder="Enter your current password" value="">
                </div>
                <div class="form-group  mb-2">
                    <label class="text-light text-size ">New Password:</label>
                    <input class="form-control text-dark" type="password" name="new_password" required
                        placeholder="Enter your new password" value="">
                </div>
                <div class="form-group  mb-3">
                    <label class="text-light text-size ">Confirm New Password:</label>
                    <input class="form-control text-dark" type="password" name="confirm_password" required
                        placeholder="Confirm your new password" value="">
                </div>
                <div class="form-group">
                    <div class="row m-auto">
                        <input type="hidden" name="customer_ID" value="<?php echo $customer_ID; ?>" />
                        <input class="btn btn-warning button-size text-bold text-light" type="submit"
                            name="update_customer_pass" value="Update">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>