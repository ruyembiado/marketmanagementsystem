<?php
// include_once('config.php');
@include 'includes/index.header.php';

$search = $_GET['search'];
$search1 = htmlspecialchars($search);
if (isset($_GET['search'])) {

    if (strlen($search1)) {

        $product_results = "SELECT * FROM product, vendor, stall WHERE product.stall_ID=stall.stall_ID AND stall.vendor_ID=vendor.vendor_ID AND stall_status='2' AND product_status='1' AND product_name LIKE '%" . $search1 . "%'";

        // OR product_category LIKE '%".$search1."%'

        $market_results = "SELECT * FROM market WHERE market_status='1' AND market_name LIKE '%" . $search1 . "%'";
        $stall_results = "SELECT DISTINCT stall.stall_ID, stall.stall_name, map.map_ID FROM stall, vendor, map WHERE map.map_ID=stall.map_ID AND vendor.vendor_ID=stall.vendor_ID AND stall_status='2' AND stall_name LIKE '%" . $search1 . "%'";

        $result = mysqli_query($conn, $product_results);
        $result2 = mysqli_query($conn, $market_results);
        $result3 = mysqli_query($conn, $stall_results);
    } else {
        $raw_results1 = "SELECT * FROM product, vendor, stall WHERE product.stall_ID=stall.stall_ID AND stall.vendor_ID=vendor.vendor_ID AND stall_status='2' AND product_status='1'";
        $result = mysqli_query($conn, $raw_results1);
    }
}
?>

<div class="row justify-content-center mx-0">
    <div class="col-md-12 text-center text-light p-5">
        <p style="color: #F4D58D; font-size:20px;" class="text-start">Results:</p>
        <hr class="hr text-secondary" />
        <div class="d-flex justify-content-start flex-wrap mt-3">
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($results = mysqli_fetch_array($result)) { ?>
                    <?php $stall_ID = $results['stall_ID']; ?>
                    <div class="col-md-2 rounded mb-3 ms-4" style="background-color: #708D81;">
                        <div class="col-md-11 m-auto mt-3">
                            <img src="product_img/<?= $results['product_img'] ?>" class="m-auto prod-img border border-dark rounded" />
                        </div>
                        <div class="card-info">
                            <p style="font-size: 14px; color: #001427;" class="mb-1">
                                <?= $results['product_name'] ?>
                            </p>
                            <?php if ($results['product_status'] == '1') { ?>
                                <p style="font-size: 14px;" class="form-group mx-0 bg-light text-success mb-1">Available</p>
                            <?php } else { ?>
                                <p style="font-size: 14px;" class="form-group mx-0 bg-light text-danger mb-1">Not Available</p>
                            <?php } ?>
                            <form action="" method="post">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <a href="index_store_view.php?view_stall=<?= $stall_ID ?>" role="button">
                                        <?php $map = "SELECT * FROM stall, map WHERE stall.map_ID=map.map_ID AND stall_ID='$stall_ID'"; ?>
                                        <?php $map_result = mysqli_query($conn, $map); ?>
                                        <?php $map_res = mysqli_fetch_array($map_result); ?>
                                        <p style="margin: 0px; font-size: 15px; color: #001427;" class="stall_name bg-warning">
                                            <?= $results['stall_name'] ?>
                                        </p>
                                    </a>
                                    <p style="margin: 0px; color: #001427; font-size: 15px;" class="map_name">
                                        <?php echo $map_res['map_name']; ?>
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div class="my-auto" style="background-color: #001427;">
                            <div class="mx-3 mt-1 rounded d-flex justify-content-between px-3 py-2 align-items-center">
                                <span style="font-size: 13px; " class="text-light me-2">₱<?= $results['product_price'] ?>/<?= $results['product_unit'] ?>
                                </span>
                                <a class="cart-link" href="#"></a>

                                <?php if ($results['product_status'] === '0') { ?>

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

                <?php } elseif (mysqli_num_rows($result2) > 0) {

                while ($res2 = mysqli_fetch_array($result2)) { ?>

                    <div class="col-md-2 rounded mb-3 py-3 ms-4" style="background-color: #708D81;">
                        <div class="col-md-11 m-auto">
                            <i class='bi bi-shop' style='font-size:100px; color: #001427;'></i>
                        </div>
                        <div class="card-info">
                            <p style="font-size: 14px; color: #001427;" class="bg-light">
                                <?= $res2['market_name'] ?>
                            <div class="form-group mx-1">
                                <div class="row m-auto mx-5">
                                    <a class="btn btn-primary button-size btn-sm text-light" href="index_view_market_product.php?view_market_prod=<?= $res2['market_ID'] ?>" role="button"><i class="fa fa-eye"></i> View</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <?php } elseif (mysqli_num_rows($result3) > 0) {

                while ($res3 = mysqli_fetch_array($result3)) { ?>

                    <div class="col-md-2 ms-4 mb-3 rounded" style="background-color: #708D81;">
                        <div class="col-md-11 m-auto">
                            <i class='bi bi-shop-window' style='font-size:100px; color: #001427;'></i>
                        </div>
                        <p style="font-size: 14px; color: #001427;" class="form-group mx-0 bg-light">
                            <?= $res3['stall_name'] ?>
                        </p>
                        <div class="form-group">
                            <div class="form-group">
                                <div class="row m-auto mx-5">
                                    <a class="btn btn-primary text-light btn-sm button-size" href="index_store_view.php?view_stall=<?= $res3['stall_ID'] ?>" role="button"><i class="fa fa-eye"></i> View</a>
                                </div>
                            </div>
                            <div class="row m-auto mx-5 mt-2">
                                <a class="btn btn-primary text-light btn-sm button-size" href="index_view_market.php?view_map=<?= $res3['stall_ID'] ?>&map_ID=<?= $res3['map_ID'] ?>" role="button"><i class="fa fa-map"></i> Map</a>
                            </div>
                        </div>
                        </p>
                    </div>

                <?php } ?>

            <?php } else { ?>
                <p>No results found.</p>
            <?php } ?>
        </div>
    </div>
</div>
</div>

<?php

@include 'includes/index.footer.php';

?>