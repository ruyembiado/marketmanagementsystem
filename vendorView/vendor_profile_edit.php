<?php

@include '../includes/vendor.header.php';

?>

<div class="row justify-content-center mx-0" style="height:621px">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size px-4" href="vendor_profile.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="col-md-5 p-5 mb-5 align-items-center justify-content-center text-dark rounded" style="background-color: #708D81;">
        <div class="col-md-4 m-auto">
            <img class="logo-user img-fluid" src="../img/user-logo.png" style="height:123px" />
        </div>
        <form class="" action="../includes/vendor.crud.php" method="post">
            <div>
                <div class="form-group row">
                    <label>
                        <p style="font-size: 20px;color: #001427;" class="mb-0 text-center">Update Profile</p>
                    </label>
                </div>

                <?php
                $vendor_ID = $_GET['edit_vendor'];
                $sql1 = "SELECT * FROM vendor WHERE vendor_ID ='$vendor_ID'";
                $result2 = mysqli_query($conn, $sql1);
                while ($row = mysqli_fetch_assoc($result2)) {
                    $vendor_ID = $row['vendor_ID'];
                    $name = $row['name'];
                    $contact = $row['contact'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $pass = $row['password'];
                }
                ?>

                <div class="form-group mb-2">
                    <!-- <label class="text-light text-size">Name:</label> -->
                    <input class="form-control text-dark" type="hidden" name="name" required placeholder="Enter your name" value="<?php echo $name; ?>">
                </div>
                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 mb-2 me-1">
                        <label style="color: #001427;" class="text-size">Contact:</label>
                        <input class="form-control text-dark" type="text" name="contact" required placeholder="Enter your contact" value="<?php echo $contact; ?>">
                    </div>
                    <div class="form-group mb-1">
                        <label style="color: #001427;" class="text-size">Email:</label>
                        <input class="form-control text-dark" type="email" name="email" required placeholder="Enter your email" value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="form-group mb-1">
                    <div class="d-flex align-items-center">
                        <input class="form-check-input" name="updatepass" id="checkbox" value="1" type="checkbox" />
                        <label class="align-self-center ms-1" style="color: #001427;"><i style="font-size:10px">check to update
                                password</i></label>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label style="color: #001427;" class="text-size">Current Password:</label>
                    <input class="form-control text-dark" type="password" name="password" placeholder="Enter your current password" value="">
                </div>
                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 mb-2 me-1">
                        <label style="color: #001427;" class="text-size">New Password:</label>
                        <input class="form-control text-dark" type="password" name="new_password" placeholder="Enter your new password" value="">
                    </div>
                    <div class="form-group mb-2">
                        <label style="color: #001427;" class="text-size">Confirm New Password:</label>
                        <input class="form-control text-dark" type="password" name="confirm_password" placeholder="Confirm your new password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row m-auto">
                        <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID; ?>" />
                        <input class="btn btn-primary button-size text-light" type="submit" name="update_vendor_profile" value="Update">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?php

@include '../includes/all.footer.php';

?>