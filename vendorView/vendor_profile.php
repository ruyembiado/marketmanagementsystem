<?php

@include '../includes/vendor.header.php';

?>

<div class="row justify-content-center mx-0" style="height:608px">
    <div class="col-6 sm-profile h-80 w-75 p-3 text-center text-dark mt-3 mb-3 rounded" style="background-color: #708D81;">
        <?php
        $sql = "SELECT * FROM vendor WHERE vendor_ID='$vendor_ID'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $vendor_ID = $row['vendor_ID'];
                $vendor_name = $row['name'];
                $vendor_user = $row['username'];
                $vendor_contact = $row['contact'];
                $vendor_email = $row['email'];
            }
        }
        ?>
        <div class="card-cont">
            <img src="https://www.ateneo.edu/sites/default/files/styles/large/public/2021-11/istockphoto-517998264-612x612.jpeg?itok=aMC1MRHJ" alt="Avatar"s style="width:30%">
            <div class="card-des mt-4">
                <h1 style="color: #001427; font-size: 25px;" class="">
                    <?php echo $vendor_name; ?>
                </h1>
                <div class="text-start col-md-4 m-auto mt-4">
                    <p style="color: #001427;" class=" m-0">
                        Username:
                        <?php echo $vendor_user; ?>
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p style="color: #001427;" class=" m-0">
                            Email:
                            <?php echo $vendor_email; ?>
                        </p>
                        <a href="vendor_profile_edit.php?edit_vendor=<?php echo $vendor_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p style="color: #001427;" class=" m-0">
                            Contact:
                            <?php echo $vendor_contact; ?>
                        </p>
                        <a href="vendor_profile_edit.php?edit_vendor=<?php echo $vendor_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p style="color: #001427;" class=" m-0">
                            Password: *************
                        </p>
                        <a href="vendor_profile_edit.php?edit_vendor=<?php echo $vendor_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>