<?php

@include 'includes/index.header.php';

$stall_ID = $_GET['view_stall'];
$sql_stall = "SELECT * FROM stall, vendor, map WHERE stall_ID='$stall_ID' AND vendor.vendor_ID=stall.vendor_ID AND map.map_ID=stall.map_ID";
$stall_res = mysqli_query($conn, $sql_stall);
$stall = mysqli_fetch_assoc($stall_res);
?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 rounded mt-3 mb-3" style="background-color: #001427;">
        <form action="index_store_view.php?view_stall=<?php echo $stall_ID; ?>" method="POST" class="m-0 p-0">
            <div class="d-flex justify-content-between p-3 align-items-center">
                <p class="m-0 d-flex align-items-center" style="color: #F4D58D;">
                    <i class='bi bi-shop me-1'></i>
                    <?php echo $stall['map_name'] . ' ' . '-' . ' ' . $stall['stall_name']; ?>
                </p>
                <div class="d-flex">
                    <input class="form-control text-dark form-control-sm" type="text" name="search" placeholder="Search <?= $stall['stall_name'] ?>  " />
                    <button class="btn btn-primary btn-sm px-3" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-11">
        <div class="row d-flex justify-content-start" style="overflow-y:auto">

            <?php
            if (isset($_POST['search'])) {
                $search1 = $_POST['search'];
                $stall = "SELECT * FROM product, vendor, stall WHERE product.stall_ID='$stall_ID' AND stall.stall_ID=product.stall_ID AND stall.vendor_ID=vendor.vendor_ID AND product_name LIKE '%" . $search1 . "%'";
            } else {
                $stall = "SELECT * FROM stall, product, vendor WHERE product.stall_ID='$stall_ID' AND stall.stall_ID=product.stall_ID AND stall.vendor_ID=vendor.vendor_ID";
            }
            $stall_prod = mysqli_query($conn, $stall);

            if (mysqli_num_rows($stall_prod) > 0) {
            ?>
                <?php while ($row = mysqli_fetch_array($stall_prod)) { ?>
                    <?php $product_status = $row['product_status']; ?>
                    <div class="card col-md-3 rounded mb-3 ms-4 text-center p-0" style="background-color: #708D81;">
                        <div class="col-md-11 m-auto mt-3">
                            <img src="product_img/<?= $row['product_img'] ?>" class="m-auto prod-img border border-dark rounded" />
                        </div>
                        <div class="card-info">
                            <p style="font-size: 15px; color: #001427;" class="mb-1">
                                <?= $row['product_name'] ?>
                            </p>
                            <?php if ($row['product_status'] == '1') { ?>
                                <p style="font-size: 14px;" class="form-group mx-0 bg-light text-success mb-1">Available</p>
                            <?php } else { ?>
                                <p style="font-size: 14px;" class="form-group mx-0 bg-light text-danger mb-1">Not Available</p>
                            <?php } ?>
                            <form action="" method="post">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <a href="index_store_view.php?view_stall=<?= $stall_ID ?>" role="button">
                                        <?php $map = "SELECT * FROM stall, map WHERE stall.map_ID=map.map_ID AND stall_ID='$stall_ID'"; ?>
                                        <?php $map_result = mysqli_query($conn, $map); ?>
                                        <?php $map_res = mysqli_fetch_array($map_result); ?>
                                        <p style="margin: 0px; font-size: 15px; color: #001427;" class="stall_name bg-warning">
                                            <?= $row['stall_name'] ?>
                                        </p>
                                    </a>
                                </div>
                            </form>
                        </div>
                        <div class="mt-4 rounded" style="background-color: #001427;">
                            <div class="mt-1 d-flex justify-content-between px-3 py-2 align-items-center">
                                <span style="font-size: 13px; " class="text-light me-2">₱<?= $row['product_price'] ?>/<?= $row['product_unit'] ?>
                                </span>
                                <a class="cart-link" href="#"></a>
                                <?php if ($row['product_status'] === '0') { ?>
                                <?php } else { ?>
                                    <form action="includes/index.crud.php" method="post">
                                        <input type="hidden" name="stall_ID" value="<?= $row['stall_ID'] ?>" />
                                        <input type="hidden" name="product_ID" value="<?= $row['product_ID'] ?>" />
                                        <input type="hidden" name="vendor_ID" value="<?= $row['vendor_ID'] ?>" />
                                        <input type="hidden" name="product_price" value="<?= $row['product_price'] ?>" />
                                        <button name="add_reservation_index" class="rounded-circle bg-dark text-warning border-warning"><i class="fa fa-shopping-cart"></i></button>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            <?php } else { ?>

                <p class="text-light text-center">No results found.</p>

            <?php } ?>
        </div>
    </div>
</div>

<?php

@include 'includes/index.footer.php';

?>