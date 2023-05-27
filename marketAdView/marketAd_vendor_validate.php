<?php

@include '../includes/marketAd.header.php';

?>

<div class="row justify-content-center mx-0" style="height: 620px;">
    <div class="col-md-11 px-5 py-3 text-center text-dark mt-3 mb-3 rounded table-responsive-sm" style="height: 630px; background-color: #708D81;">

        <table id="example" class="table account-table">
            <h5 style="color: #001427;">Manage Vendor Registration</h3>
                <thead>
                    <tr style="background-color: #F4D58D;">
                        <th style="color: #001427;">No.</th>
                        <th style="color: #001427;">Name</th>
                        <th style="color: #001427;">Contact</th>
                        <th style="color: #001427;">Username</th>
                        <th style="color: #001427;">Email</th>
                        <th style="color: #001427;">Status</th>
                        <th style="color: #001427;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $sql = "SELECT * FROM vendor WHERE vendor.market_admin_ID='$ma_ID' AND vendor_status='0' ORDER BY vendor_ID ASC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $vendor_ID = $row['vendor_ID'];
                            $name = $row['name'];
                            $contact = $row['contact'];
                            $username = $row['username'];
                            $email = $row['email'];
                            $vendor_status = $row['vendor_status'];
                    ?>
                            <tr>
                                <td style="color: #001427;">
                                    <?php
                                    $i++;
                                    echo $i;
                                    ?>
                                </td>
                                <td class="text-start" style="color: #001427;">
                                    <?php echo $name; ?>
                                </td>
                                <td class="text-start" style="color: #001427;">
                                    <?php echo $contact; ?>
                                </td>
                                <td class="text-start" style="color: #001427;">
                                    <?php echo $username; ?>
                                </td>
                                <td class="text-start" style="color: #001427;">
                                    <?php echo $email; ?>
                                </td>
                                <td style="color: #001427;">
                                    <?php if ($vendor_status == '1') { ?>
                                        <div class="form-group mx-1 bg-light text-success">Approved</div>
                                    <?php } else { ?>
                                        <div class="form-group mx-1 bg-light text-danger">Pending</div>
                                    <?php } ?>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <form action="../includes/marketAd.crud.php " method="post">
                                            <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID; ?>" />
                                            <input type="hidden" name="market_admin_ID" value="<?php echo $ma_ID; ?>">
                                            <button class="btn btn-primary btn-sm text-light button-size rounded me-3" type="submit" name="approve_vendor" value="Approve"><i class="fa fa-check"></i>
                                                Approve</button>
                                        </form>
                                        <form action="" method="">
                                            <div class="btn-group">
                                                <a class="btn btn-danger btn-sm text-light button-size reject rounded" role="button" href="../includes/marketAd.crud.php?deny_vendor=<?php echo $vendor_ID; ?>"><i class="fa fa-close"></i>
                                                    Reject</a>
                                            </div>
                                        </form>
                                    </div>
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