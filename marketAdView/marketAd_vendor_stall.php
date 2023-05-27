<?php

@include '../includes/marketAd.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size px-4" href="marketAd_vendor_acc.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="col-md-11 p-4 text-center text-dark mb-3 rounded" style="height: 700px;  background-color: #708D81;">
        <?php
        $vendor_ID = $_GET['view_vendor_stall'];
        $sql = "SELECT * FROM vendor WHERE vendor.vendor_ID='$vendor_ID'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $vendor_name = $row['name'];
        }
        ?>
        <h5 style="color: #001427;">
            Manage <?php echo $vendor_name; ?>`s Stalls
        </h5>
        <table id="example" class="table account-table">
            <thead>
                <tr style="background-color: #F4D58D;">
                    <th style="color: #001427;">No.</th>
                    <th style="color: #001427;">Stall Name</th>
                    <th style="color: #001427;">Status</th>
                    <th style="color: #001427;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $sql = "SELECT * FROM stall WHERE stall.vendor_ID='$vendor_ID' ORDER BY stall_ID ASC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $stall_ID = $row['stall_ID'];
                        $stall_name = $row['stall_name'];
                        $stall_status = $row['stall_status'];
                ?>
                        <tr>
                            <td style="color: #001427;">
                                <?php
                                $i++;
                                echo $i;
                                ?>
                            </td>
                            <td class="text-start" style="color: #001427;">
                                <?php echo $stall_name; ?>
                            </td>
                            <td style="color: #001427;">
                                <?php if ($stall_status == '1') { ?>
                                    <div class="form-group mx-1 bg-light text-danger">Deactivated</div>
                                <?php } elseif ($stall_status == '2') { ?>
                                    <div class="form-group mx-1 bg-light text-success">Activated</div>
                                <?php } else { ?>
                                    <div class="form-group mx-1 bg-light text-danger">Deactivated</div>
                                <?php } ?>
                            </td>
                            <?php if ($stall_status == '1') { ?>
                                <td>
                                    <form action="../includes/marketAd.crud.php " method="post">
                                        <div class="col-4 m-auto">
                                            <input type="hidden" name="stall_ID" value="<?php echo $stall_ID; ?>" />
                                            <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID; ?>" />
                                            <div class="row m-auto">
                                                <button class="btn btn-warning btn-sm rounded button-size text-light" type="submit" name="activate_stall">
                                                    <i class="fa fa-power-off "></i> Activate</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            <?php } elseif ($stall_status == '2') { ?>
                                <td>
                                    <form action="../includes/marketAd.crud.php " method="post">
                                        <div class="col-4 mx-auto">
                                            <input type="hidden" name="stall_ID" value="<?php echo $stall_ID; ?>" />
                                            <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID; ?>" />
                                            <div class="row m-auto">
                                                <button class="btn btn-danger btn-sm rounded button-size text-light" type="submit" name="deactivate_stall">
                                                    <i class="fa fa-power-off text-light"></i> Deactivate</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            <?php } elseif ($stall_status == '3') { ?>
                                <td></td>
                            <?php } else { ?>
                                <td class="">
                                    <form action="../includes/marketAd.crud.php " method="post">
                                        <input type="hidden" name="stall_ID" value="<?php echo $stall_ID; ?>" />
                                        <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID; ?>" />
                                        <div class="col-4 m-auto">
                                            <div class="row m-auto">
                                                <button class="btn btn-primary btn-sm rounded button-size text-light" type="submit" name="activate_stall">
                                                    <i class="fa fa-power-off"></i> Activate</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            <?php } ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>