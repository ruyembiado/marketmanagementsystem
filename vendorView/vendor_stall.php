<?php

@include '../includes/vendor.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 text-center text-light px-5 pt-3 pb-5 mb-5 rounded">

        <h5 class="text-start" style="color: #F4D58D;">Manage Stalls</h3>
            <hr class="hr text-secondary my-1" />
            <div class="form-group">
                <div class="row content-sm d-flex justify-content-start m-auto mt-3">
                    <div class="card col-md-3 mb-3 me-4" style="height: fit-content; background-color: #708D81;">
                        <div class="card-info d-flex justify-content-center" style="height:312px">
                            <i class="fa fa-plus-circle text-dark align-self-center" style="font-size:40px; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#addmarket"></i>
                        </div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM stall WHERE stall.vendor_ID='$vendor_ID' ORDER BY stall_ID ASC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $stall_ID = $row['stall_ID'];
                            $stall_name = $row['stall_name'];
                            $stall_status = $row['stall_status'];
                    ?>
                            <div class="card col-md-3 mb-3 me-4" style="height: fit-content;background-color: #708D81;">
                                <div class="col-md-11 m-auto">
                                    <i class="bi bi-shop-window" style="font-size: 85px;color: #001427;"></i>
                                </div>
                                <div class="card-info">
                                    <p style="font-size: 14px; color: #001427;" class="">
                                        <?php echo $stall_name; ?>
                                    </p>
                                    <?php if ($stall_status === '0') { ?>
                                        <p style="font-size: 13px;" class=" bg-light text-danger">Deactivated
                                        </p>
                                    <?php } else { ?>
                                        <p style="font-size: 13px;" class="bg-light text-success">Activated
                                        </p>
                                    <?php } ?>
                                    </p>
                                    <div class="btn-group mb-2">
                                        <div class="mx-1">
                                            <button class=" btn btn-primary text-light" role="button" data-bs-toggle="modal" data-bs-target="#editmarket<?php echo $stall_ID; ?>"><i class="fa fa-edit"></i> Update</button>
                                        </div>
                                    </div><!-- update Modal -->
                                    <div class="modal fade" id="editmarket<?php echo $stall_ID; ?>" tabindex="-1" aria-labelledby="Add Market" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Update Stall</h1>
                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                </div>
                                                <form method="post" action="../includes/vendor.crud.php">
                                                    <div class="modal-body">
                                                        <div class="form-group px-3">
                                                            <label class="float-start mb-1">Stall Name</label>
                                                            <input class="form-control text-dark" type="text" name="stall_name" value="<?php echo $stall_name; ?>" required placeholder="Enter your stall name" value="">
                                                        </div>
                                                        <input type="hidden" name="stall_ID" value="<?php echo $stall_ID; ?>" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger text-light button-size" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                                        <button type="submit" class="btn btn-primary text-light button-size" name="update_stall"><i class="fa fa-check"></i> Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal -->
                                    <div class="btn-group mb-4">
                                        <div class="mx-1">
                                            <a class="btn btn-success text-light" href="vendor_product_rec.php?manage_stall=<?php echo $stall_ID; ?>"><i class="fa fa-tasks" aria-hidden="true"></i> Manage</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    <?php } else { ?>
                        <p class="text-light">No stall found</p>
                    <?php } ?>

                </div>
                <!-- Add Modal -->
                <div class="modal fade" id="addmarket" tabindex="-1" aria-labelledby="Add Market" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Add Stall</h1>
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                            </div>
                            <form method="post" action="../includes/vendor.crud.php">
                                <div class="modal-body">
                                    <div class="form-group px-3">
                                        <label class="float-start mb-1">Stall Name</label>
                                        <input class="form-control text-dark" type="text" name="stall_name" required placeholder="Enter your stall name" value="">
                                    </div>
                                </div>
                                <?php
                                $result = "SELECT *FROM vendor, market_admin WHERE market_admin.market_admin_ID=vendor.market_admin_ID AND vendor_ID='$vendor_ID'";
                                $ma = mysqli_query($conn, $result);
                                while ($row = mysqli_fetch_assoc($ma)) {
                                    $market_admin_ID = $row['market_admin_ID'];
                                }
                                ?>

                                <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID; ?>" />
                                <input type="hidden" name="market_admin_ID" value="<?php echo $market_admin_ID; ?>" />
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger button-size" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                    <button type="submit" class="btn btn-primary text-light button-size" name="add_stall"><i class="fa fa-check"></i> Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- modal -->


</div>

</div>

</div>


<?php

@include '../includes/all.footer.php';

?>