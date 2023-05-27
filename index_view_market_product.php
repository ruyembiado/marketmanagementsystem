<?php

@include 'includes/index.header.php';

?>
<?php
$market_ID = $_GET['view_market_prod'];

$market = "SELECT * FROM market WHERE market_ID='$market_ID'";
$market1 = mysqli_query($conn, $market);
$market2 = mysqli_fetch_array($market1);
?>
<div class="form-group mx-5">
    <div class="btn-group p-2">
        <a class="btn btn-primary text-light button-size px-4" href="index.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>
<div class="row justify-content-center mx-0">
    <div class="col-md-11 text-center text-light px-5 pt-3 pb-5 mb-5 rounded">
        <h3 class="mb-2 h4 text-start" style="color: #F4D58D;"><?= $market2['market_name'] ?></h3>
        <hr class="hr text-secondary" />
        <?php
        $sql = "SELECT * FROM market, map WHERE market.market_ID='$market_ID' AND map.market_ID=market.market_ID";
        $result = mysqli_query($conn, $sql);
        ?>
        <div class="d-flex m-auto justify-content-start cards-sm-flex flex-wrap">

            <?php if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {
                    $map_ID = $row['map_ID']
            ?>
                    <div class="col-md-12 rounded mb-3 text-center">
                        <div class="product-floor">
                            <h6 style="color: #F4D58D;" class="text-start">Floor <?= $row['map_floor'] ?></h6>
                            <hr class="hr text-secondary" />
                            <?php
                            $product_results = "SELECT * FROM product, vendor, stall, map WHERE map.map_ID='$map_ID' AND map.map_ID=stall.map_ID AND product.stall_ID=stall.stall_ID AND stall.vendor_ID=vendor.vendor_ID AND stall_status='2' AND product_status='1' ORDER BY date_added DESC";
                            $result5 = mysqli_query($conn, $product_results);
                            ?>
                            <div class="d-flex m-auto justify-content-start cards-sm-flex flex-wrap">
                                <?php if (mysqli_num_rows($result5) > 0) {
                                    while ($results = mysqli_fetch_array($result5)) {
                                        $stall_ID = $results['stall_ID']; ?>
                                        <div class="col-md-2 rounded mb-3 ms-4" style="background-color: #708D81;">
                                            <div class="col-md-11 m-auto mt-3">
                                                <img src="product_img/<?= $results['product_img'] ?>" class="m-auto prod-img border border-dark rounded" />
                                            </div>
                                            <div class="card-info">
                                                <p style="font-size: 13px; color: #001427;" class="mb-1">
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
                                                            <input type="hidden" name="stall_ID" value="<?= $results['stall_ID'] ?>" />
                                                            <input type="hidden" name="product_ID" value="<?= $results['product_ID'] ?>" />
                                                            <input type="hidden" name="vendor_ID" value="<?= $results['vendor_ID'] ?>" />
                                                            <input type="hidden" name="product_price" value="<?= $results['product_price'] ?>" />
                                                            <button name="add_reservation_index" class="rounded-circle bg-dark text-warning border-warning"><i class="fa fa-shopping-cart"></i></button>
                                                        </form>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <p class="text-light">No product available.</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p class="text-light">No map available.</p>
            <?php } ?>
        </div>
    </div>
</div>
<?php

@include 'includes/index.footer.php';

?>