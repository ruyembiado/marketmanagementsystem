<?php

@include '../includes/vendor.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 p-4 text-center bg-dark text-dark mt-3 mb-3 rounded table-responsive-sm vh-100">
        <h5 class="text-light"><?php echo $result['market_name']; ?> Map List</h5>
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
        <table id="example" class="table table-striped account-table">
            <thead>
                <tr class="bg-warning">
                    <th style="display:none">Map ID</th>
                    <th style="display:none">Market ID</th>
                    <!-- <th class="text-dark text-start">Market</th> -->
                    <th class="text-dark text-start">Map</th>
                    <th class="text-dark text-start">Floor</th>
                    <th class="text-dark">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM map, market, vendor WHERE map.market_admin_ID=vendor.market_admin_ID AND market.market_ID=map.market_ID AND vendor.vendor_ID='$vendor_ID' ORDER BY map_name ASC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $map_ID = $row['map_ID'];
                        $market_ID = $row['market_ID'];
                        $market_name = $row['market_name'];
                        // $path = $row['path'];
                        $map_floor = $row['map_floor'];
                ?>
                        <tr>
                            <td style="display:none" class="text-light">
                                <?php echo $map_ID; ?>
                            </td>
                            <td style="display:none" class="text-light">
                                <?php echo $market_ID; ?>
                            </td>
                            <!-- <td class="text-light text-start">
                                <?php echo $market_name; ?>
                            </td> -->
                            <td class="text-start">
                                <?php echo "<img src='{$row['map_img']}' width='100px' height='100px'</img>" ?>
                            </td>
                            <td class="text-light text-start">
                                <?php echo $map_floor; ?>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary text-dark button-size text-bold btn-sm rounded px-3" href="vendor_map.php?map_view=<?php echo $map_ID; ?>" role="button"><i class="fa fa-eye"></i> View</a>
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