<?php

@include '../includes/admin.header.php';

?>

<div class="row justify-content-center mx-0" style="height:830px">
    <div class="form-group mx-5 mb-0">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size px-4" href="admin_profile.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="col-md-5 p-5 pb-0 mb-5 align-items-center justify-content-center rounded" style="color: #001427; background-color: #708D81;">
        <div class="col-md-4 m-auto">
            <img class="logo-user img-fluid" src="../img/user-logo.png" style="height:123px" />
        </div>
        <form action="../includes/admin.crud.php" method="post">
            <div>
                <div class="form-group row">
                    <label>
                    <p class="text-center" style="font-size: 20px; color: #001427;">Update Profile</p>
                    </label>
                </div>
                <?php
                $admin_ID = $_GET['edit_admin'];
                $sql1 = "SELECT * FROM admin WHERE admin_ID ='$admin_ID'";
                $result2 = mysqli_query($conn, $sql1);
                while ($row = mysqli_fetch_assoc($result2)) {
                    $admin_ID = $row['admin_ID'];
                    $name = $row['name'];
                    $contact = $row['contact'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $pass = $row['password'];
                }
                ?>

                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 mb-2 me-1">
                        <label style="color: #001427;">Name:</label>
                        <input class="form-control text-dark" type="text" name="name" required placeholder="Enter your name" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label style="color: #001427;">Contact:</label>
                        <input class="form-control text-dark" type="text" name="contact" required placeholder="Enter your contact" value="<?php echo $contact; ?>">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label style="color: #001427;">Email:</label>
                    <input class="form-control text-dark" type="email" name="email" required placeholder="Enter your email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group mb-1">
                    <div class="d-flex align-items-center">
                        <input class="form-check-input" name="updatepass" id="checkbox" value="1" type="checkbox" />
                        <label style="color: #001427;" class="align-self-center ms-1"><i style="font-size:10px">check to update
                                password</i></label>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label style="color: #001427;">Current Password:</label>
                    <input class="form-control text-dark" id="password" type="password" name="password" placeholder="Enter your current password" value="">
                </div>
                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 mb-2 me-1">
                        <label style="color: #001427;">New Password:</label>
                        <input class="form-control text-dark" type="password" name="new_password" placeholder="Enter your new password" value="">
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #001427;">Confirm New Password:</label>
                        <input class="form-control text-dark" type="password" name="confirm_password" placeholder="Confirm your new password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row m-auto">
                        <input type="hidden" name="admin_ID" value="<?php echo $admin_ID; ?>" />
                        <input class="btn btn-primary button-size text-light" type="submit" name="update_admin_profile" value="Update">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>