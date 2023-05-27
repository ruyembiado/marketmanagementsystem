<?php

@include '../includes/marketAd.header.php';

?>

<div class="row justify-content-center mx-0" style="height:608px">
    <div class="col-6 sm-profile h-80 w-75 p-3 text-center text-dark mt-3 mb-3 rounded" style="background-color: #708D81;">
        <?php
        $sql = "SELECT * FROM market_admin WHERE market_admin_ID='$ma_ID'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ma_admin_ID = $row['market_admin_ID'];
                $marketAd_name = $row['name'];
                $marketAd_user = $row['username'];
                $marketAd_contact = $row['contact'];
                $marketAd_email = $row['email'];
            }
        }
        ?>
        <div class="card-cont">
            <img src="https://www.ateneo.edu/sites/default/files/styles/large/public/2021-11/istockphoto-517998264-612x612.jpeg?itok=aMC1MRHJ" alt="Avatar" s style="width:30%">
            <div class="card-des mt-4" style="color: #001427;">
                <p class="mb-0 pb-0" style="font-size: 25px;">
                    <?php echo $marketAd_name; ?>
                </p>
                <div class="text-start col-md-4 m-auto mt-4">
                    <p class="m-0">
                        Username:
                        <?php echo $marketAd_user; ?>
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="m-0">
                            Email:
                            <?php echo $marketAd_email; ?>
                        </p>
                        <a href="marketAd_profile_edit.php?edit_marketAd=<?php echo $ma_admin_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="m-0">
                            Contact:
                            <?php echo $marketAd_contact; ?>
                        </p>
                        <a href="marketAd_profile_edit.php?edit_marketAd=<?php echo $ma_admin_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="m-0">
                            Password: *************
                        </p>
                        <a href="marketAd_profile_edit.php?edit_marketAd=<?php echo $ma_admin_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>