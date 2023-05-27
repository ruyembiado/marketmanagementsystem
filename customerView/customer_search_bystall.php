<?php

@include '../includes/customer.header.php';

?>

<div class="container-fluid pt-2 px-2">
    <div class="row bg-dark justify-content-center mx-0" style="height: 580px; overflow-x: hidden; overflow-y: auto;">
        <div class="col-md-12 text-center text-light p-5">

            <!-- <div class="form-group row text-center">
                <?php if (isset($_GET['success'])) { ?>
                    <p class="text-success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
            </div>
            <div class="form-group row text-center">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="text-danger"><?php echo $_GET['error']; ?></p>
                <?php } ?>
            </div> -->

            <div class="form-group">
                <div class="row d-flex justify-content-around mt-3">
                    <?php if (mysqli_num_rows($result) > 0) { ?>
                        <?php while ($results = mysqli_fetch_array($result)) { ?>
                            <div class="col-md-2 rounded bg-dark mb-3 ms-1">
                                <div class="col-md-11 m-auto mt-3">
                                    <img src="../product_img/<?= $results['path'] ?>" class="m-auto prod-img border border-dark rounded" />
                                </div>
                                <div class="card-info">
                                    <h6 style="font-size: 12px;" class="text-title text-light">
                                        <?= $results['product_name'] ?>
                                    </h6>
                                    <h6 class="text-body">
                                        <?php if ($results['product_status'] == '1') { ?>
                                            <h6 style="font-size: 13px;" class="form-group mx-0 text-success">Available</h6>
                                        <?php } else { ?>
                                            <h6 style="font-size: 13px;" class="form-group mx-0 text-danger">Not Available</h6>
                                        <?php } ?>
                                    </h6>
                                    <div class="btn-group">
                                        <div class="form-group mx-1">
                                            <a class=" text-warning" href="customer_store_view.php?view_stall=<?= $results['stall_ID'] ?>" role="button">
                                                <p style="font-size: 15px;" class="form-group m-0 text-warning">
                                                    <?= $results['stall_name'] ?>
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <div class="mb-1 mx-2 bg-warning rounded d-flex justify-content-center px-3 py-2 align-items-center">
                                        <span style="font-size: 13px;" class="text-title text-dark me-2">₱
                                            <?= $results['product_price'] ?> /
                                            <?= $results['product_unit'] ?>
                                        </span>
                                        <a class="cart-link" href="#"></a>

                                        <?php if ($results['product_status'] === '0') { ?>

                                        <?php } else { ?>

                                            <form action="../includes/customer.crud.php" method="post">
                                                <input type="hidden" name="stall_ID" value="<?= $results['stall_ID'] ?>" />
                                                <input type="hidden" name="product_ID" value="<?= $results['product_ID'] ?>" />
                                                <input type="hidden" name="vendor_ID" value="<?= $results['vendor_ID'] ?>" />
                                                <input type="hidden" name="product_price" value="<?= $results['product_price'] ?>" />
                                                <input type="hidden" name="customer_ID" value="<?php echo $customer_ID; ?>" />
                                                <button name="add_reservation" class="rounded-circle bg-dark text-warning border-warning"><i class="fa fa-shopping-cart"></i></button>
                                            </form>

                                        <?php } ?>

                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    <?php } else { ?>

                        <p>No results found.</p>

                    <?php } ?>
                </div>

            </div>

        </div>

    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>