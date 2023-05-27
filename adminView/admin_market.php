<?php

@include '../includes/admin.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 text-center text-light px-5 pt-3 pb-5 mb-5 rounded">
        <h5 class="text-start" style="color: #F4D58D;">Manage Market</h5>
        <hr class="hr text-secondary my-1" />
        <div class="form-group">
            <div class="row content-sm d-flex justify-content-start m-auto mt-3">
                <div class="card col-md-3 mb-3 me-4" style="height: fit-content; background-color: #708D81;">
                    <div class="card-info d-flex justify-content-center" style="height:312px">
                        <i class="fa fa-plus-circle text-dark align-self-center" style="font-size:40px; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#addmarket"></i>
                    </div>
                </div>
                <?php
                $sql = "SELECT * FROM market WHERE market.admin_ID='$admin_ID' ORDER BY market_ID ASC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $market_ID = $row['market_ID'];
                        $market_name = $row['market_name'];
                        $market_status = $row['market_status'];
                ?>
                        <div class="card col-md-3 mb-3 me-4" style="height: fit-content; background-color: #708D81;">
                            <div class="col-md-11 m-auto">
                                <i class="bi bi-shop-window" style="font-size: 120px;color: #001427;"></i>
                            </div>
                            <div class="card-info">
                                <p style="font-size: 14px; color: #001427;" class="">
                                    <?php echo $market_name; ?>
                                </p>
                                <?php if ($market_status == '0') { ?>
                                    <p style="font-size: 13px;" class="text-danger bg-light">No Admin
                                    </p>
                                <?php } else { ?>
                                    <p style="font-size: 13px;" class="text-success bg-light">Admin Registered
                                    </p>
                                <?php } ?>
                                </p>
                                <div class="btn-group mb-3">
                                    <div class="mx-1">
                                        <button class=" btn btn-primary text-light" role="button" data-bs-toggle="modal" data-bs-target="#editmarket<?php echo $market_ID; ?>"><i class="fa fa-edit"></i> Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- update Modal -->
                        <div class="modal fade" id="editmarket<?php echo $market_ID; ?>" tabindex="-1" aria-labelledby="Add Market" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Update Market</h1>
                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                    </div>
                                    <form method="post" action="../includes/admin.crud.php">
                                        <div class="modal-body">
                                            <div class="form-group px-3">
                                                <label class="float-start mb-1">Market Name</label>
                                                <input class="form-control text-dark" type="text" name="market_name" value="<?php echo $market_name; ?>" required placeholder="Enter your Market Name" value="">
                                            </div>
                                            <input type="hidden" name="market_ID" value="<?php echo $market_ID; ?>" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger text-light button-size" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                            <button type="submit" class="btn btn-primary text-light button-size" name="update_market"><i class="fa fa-check"></i> Update Market</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal -->
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-light">No market available.</p>
                <?php } ?>

                <!-- Add Modal -->
                <div class="modal fade" id="addmarket" tabindex="-1" aria-labelledby="Add Market" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Create Market</h1>
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                            </div>
                            <form method="post" action="../includes/admin.crud.php">
                                <div class="modal-body">
                                    <div class="form-group px-3">
                                        <label class="float-start mb-1">Market Name</label>
                                        <input class="form-control text-dark" type="text" name="market_name" required placeholder="Enter your Market Name">
                                    </div>
                                    <?php
                                    $admin_ID = $_SESSION['admin_ID'];
                                    ?>
                                    <input type="hidden" name="admin_ID" value="<?php echo $admin_ID; ?>" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger button-size" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                    <button type="submit" class="btn btn-primary text-light button-size" name="create_market"><i class="fa fa-check"></i> Create Market</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- modal -->
            </div>
        </div>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>