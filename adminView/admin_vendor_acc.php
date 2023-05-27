<?php

@include '../includes/admin.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="form-group">
        <div class="btn-group">
            <a class="btn btn-primary btn-sm text-light float-start button-size mb-2 ms-5 mt-3" href="admin_add_vendor.php" role="button"><i class="fa fa-plus-circle"></i> Add Vendor</a>
        </div>
    </div>
    <div class="col-md-11 p-4 text-center table-responsive-sm text-dark mt-2 mb-3 rounded" style="height: 700px; background-color: #708D81;">
        <h5 style="color: #001427;">Manage Vendor Account</h5>
        <table id="example" class="table table-striped account-table">
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
                $sql = "SELECT * FROM vendor ORDER BY vendor_ID ASC";
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
                                $i++; // increment $i by 1
                                echo $i; // Output: 2
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
                                <?php if ($vendor_status == '0') {
                                } else { ?>
                                    <div class="d-flex align-items-center justify-content-center">

                                        <form action="" method="post">
                                            <div class="btn-group">
                                                <div class="form-group mx-1">
                                                    <a class="btn btn-primary text-light button-size btn-sm" href="admin_vendor_edit.php?edit_vendor=<?php echo $vendor_ID; ?>" role="button"><i class="fa fa-edit"></i> Update</a>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- <form action="" method="">
                                                <div class="btn-group">
                                                    <a class="btn btn-danger btn-sm text-dark button-size text-bold delete" role="button" href="../includes/admin.crud.php?delete_vendor=<?php echo $vendor_ID; ?>"><i class="fa fa-close"></i>
                                                        Delete</a>
                                                </div>
                                            </form> -->
                                    </div>
                                <?php } ?>
                            </td>
                        <?php
                    }
                        ?>
                    <?php }
                    ?>
                        </tr>
            </tbody>
        </table>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>