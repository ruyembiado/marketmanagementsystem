<?php

@include '../includes/admin.header.php';

?>

<div class="row justify-content-center mx-0" style="height:608px">
    <div class="col-6 sm-profile h-80 w-75 p-3 text-center text-dark mt-3 mb-3 rounded" style="background-color: #708D81;">
        <?php
        $sql = "SELECT * FROM admin WHERE admin_ID='$admin_ID'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $admin_ID = $row['admin_ID'];
                $admin_name = $row['name'];
                $admin_user = $row['username'];
                $admin_contact = $row['contact'];
                $admin_email = $row['email'];
            }
        }
        ?>
        <div class="card-cont">
            <!-- <img src="../profile.png" alt="Avatar"s style="width:30%"> -->
            <img src="https://www.ateneo.edu/sites/default/files/styles/large/public/2021-11/istockphoto-517998264-612x612.jpeg?itok=aMC1MRHJ" alt="Avatar"s style="width:30%">
            <div class="card-des mt-4" style="color: #001427;">
                <p class="mb-0 pb-0" style="font-size: 25px;">
                    <?php echo $admin_name; ?>
                </p>
                <div class="text-start col-md-4 m-auto mt-4">
                    <p class="m-0">
                        Username:
                        <?php echo $admin_user; ?>
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="m-0">
                            Email:
                            <?php echo $admin_email; ?>
                        </p>
                        <a href="admin_profile_edit.php?edit_admin=<?php echo $admin_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="m-0">
                            Contact:
                            <?php echo $admin_contact; ?>
                        </p>
                        <a href="admin_profile_edit.php?edit_admin=<?php echo $admin_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="m-0">
                            Password: *************
                        </p>
                        <a href="admin_profile_edit.php?edit_admin=<?php echo $admin_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>