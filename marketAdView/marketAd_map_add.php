<?php

@include '../includes/marketAd.header.php';

?>

<div class="row justify-content-center mx-0" style="height: 621px;">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size" href="marketAd_map.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="col-md-5 p-5 mb-5 pb-0 align-items-center justify-content-center text-dark rounded" style=" background-color: #708D81; height: 350px;">
        <form action="../includes/marketAd.crud.php" method="post" enctype="multipart/form-data">
            <div>
                <div class=" form-group row">
                    <label>
                        <p style="color:#001427; font-size: 20px;" class="mb-0 text-center mt-2">Add Market Map</h4>
                    </label>
                </div>

                <?php
                $market = "SELECT * FROM market, market_admin WHERE market_admin.market_ID=market.market_ID AND market_admin.market_admin_ID='$ma_ID'";
                $result_market = mysqli_query($conn, $market);
                $row = mysqli_fetch_assoc($result_market);
                ?>

                <div class="d-flex flex-row justify-content-evenly">
                    <div class="form-group mb-2 me-1">
                        <label style="color:#001427; " class="text-size">Map Name:</label>
                        <input class="form-control text-dark" type="text" name="map_name" required placeholder="Enter your map name" value="<?= $row['market_name']; ?>">
                    </div>

                    <div class="form-group mb-2">
                        <label style="color:#001427; " class=" text-size">Floor:</label>
                        <input class="form-control text-dark" type="number" name="map_floor" required placeholder="Enter your map floor">
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label style="color:#001427; " class="text-size">Market Map:</label>
                    <input class="form-control text-dark" type="file" accept=".png, .jpg, .jpeg, .jfif" name="path">
                </div>
                <div class="form-group mb-5">
                    <div class="row m-auto">
                        <input type="hidden" name="market_ID" value="<?php echo $result['market_ID']; ?>">
                        <input type="hidden" name="market_admin_ID" value="<?php echo $ma_ID; ?>" />
                        <input class="text-light text-size btn btn-primary" type="submit" name="add_map" value="Add">
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>