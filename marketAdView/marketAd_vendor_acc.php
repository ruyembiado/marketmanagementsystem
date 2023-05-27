<?php

@include '../includes/marketAd.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 p-4 text-center text-dark mt-3 mb-3 rounded table-responsive-sm" style="height: 700px; background-color: #708D81;">
        <h5 style="color: #001427;">Vendor List</h5>
        <table id="example" class="table account-table">
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
                $sql = "SELECT * FROM vendor WHERE vendor.market_admin_ID='$ma_ID' AND vendor_status='1' ORDER BY vendor_status ASC";
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
                            <td style="color: #001427;" class="">
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
                                <?php if ($vendor_status == '1') { ?>
                                    <div class="form-group mx-1 text-success"><a class="btn btn-primary text-light button-size" href="marketAd_vendor_stall.php?view_vendor_stall=<?php echo $vendor_ID; ?>" role="button"><i class="fa fa-eye"></i> View Stalls</a></div>
                                <?php } else { ?>
                                    <!-- <a class="btn btn-primary button-size text-bold btn-sm"><i class="fa fa-check"></i> Approve</a> -->
                                <?php } ?>
                                </form>
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