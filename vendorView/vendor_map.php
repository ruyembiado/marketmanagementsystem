<?php

@include '../includes/vendor.header.php';

?>

<?php $map_ID = $_GET['map_view']; ?>
<div class="row justify-content-center mx-0">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-warning text-dark button-size text-bold px-4" href="vendor_market_list.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="row justify-content-center rounded">
        <div class="col-md-11 mb-5 align-items-center justify-content-center bg-light text-dark rounded">
            <?php
            $sql = "SELECT * FROM stall, map WHERE map.map_ID='$map_ID' AND stall.map_ID=map.map_ID";
            $result = mysqli_query($conn, $sql);
            ?>
            <div class="row m-auto">

                <?php
                $map = "SELECT * FROM map, market_admin, vendor WHERE market_admin.market_admin_ID=vendor.market_admin_ID AND map.market_admin_ID=market_admin.market_admin_ID AND map.map_ID='$map_ID' LIMIT 1";
                $map1 = mysqli_query($conn, $map);
                $row1 = mysqli_fetch_assoc($map1);
                ?>
                <div class="mt-4">
                    <h4 class="text-dark text-center">
                        <?php echo $row1['map_name'] ?> - Floor <?php echo $row1['map_floor'] ?>
                    </h4>
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
                </div>
                <div class="col-md-10 border border-secondary rounded shadow m-auto mt-3 mb-5 p-0" id="map" style="position: relative;">
                    <?php
                    //Pins
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['stall_status'] == '0') {
                            echo '<p class="stallname m-0 p-1 border shadow text-center bg-success" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row['stall_ID'] . '"style="position: absolute; cursor: pointer; font-size: 9px; left:' . $row['latitude'] . '%; top: ' . ($row['longitude'] - 6) . '%;">' . $row['stall_name'] . '</p>';
                            echo '<img src="../pin.png" id="pin" class="pin" style="position: absolute; left: ' . ($row['latitude'] - 0.38) . '%; top: ' . ($row['longitude'] - 2) . '%;">';
                        } else if ($row['stall_status'] == '1') {
                            echo '<p class="stallname m-0 p-1 border shadow text-center bg-danger" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row['stall_ID'] . '"style="position: absolute; cursor: pointer; font-size: 9px; left:' . $row['latitude'] . '%; top: ' . ($row['longitude'] - 6) . '%;">' . $row['stall_name'] . '</p>';
                            echo '<img src="../pin.png" id="pin" class="pin" style="position: absolute; left: ' . ($row['latitude'] - 0.38) . '%; top: ' . ($row['longitude'] - 2) . '%;">';
                        } else if ($row['stall_status'] == '3') {
                            echo '<p class="stallname m-0 p-1 border shadow text-center bg-primary" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row['stall_ID'] . '"style="position: absolute; cursor: pointer; font-size: 9px; left:' . $row['latitude'] . '%; top: ' . ($row['longitude'] - 6) . '%;">' . $row['stall_name'] . '</p>';
                            echo '<img src="../pin.png" id="pin" class="pin" style="position: absolute; left: ' . ($row['latitude'] - 0.38) . '%; top: ' . ($row['longitude'] - 2) . '%;">';
                        } else if ($row['stall_status'] == '2') {
                            echo '<p class="stallname m-0 p-1 border shadow text-center bg-warning" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row['stall_ID'] . '"style="position: absolute; cursor: pointer; font-size: 9px; left:' . $row['latitude'] . '%; top: ' . ($row['longitude'] - 6) . '%;">' . $row['stall_name'] . '</p>';
                            echo '<img src="../pin.png" id="pin" class="pin" style="position: absolute; left: ' . ($row['latitude'] - 0.38) . '%; top: ' . ($row['longitude'] - 2) . '%;">';}
                    ?>
                        <!--Details Modal -->
                        <div class="modal fade my-modal" id="detailsModal<?= $row['stall_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="detailsModal<?= $row['stall_ID'] ?>">
                                            <?= $row['stall_name'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <?php
                                    $stallID = $row['stall_ID'];
                                    $vendor = "SELECT * FROM vendor, stall WHERE vendor.vendor_ID=stall.vendor_ID AND stall.stall_ID='$stallID'";
                                    $vendor1 = mysqli_query($conn, $vendor);
                                    $vendor2 = mysqli_fetch_assoc($vendor1);
                                    ?>
                                    <div class="modal-body">
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Market:
                                                <?= $row1['map_name'] ?>
                                            </label>
                                        </div>
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Market Floor:
                                                <?= $row1['map_floor'] ?>
                                            </label>
                                        </div>
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Vendor:
                                                <?php if (empty($vendor2['name'])) { ?>
                                                    No vendor
                                                <?php } else { ?>
                                                    <?= $vendor2['name'] ?>
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Contact Number:
                                                <?php if (empty($vendor2['contact'])) { ?>
                                                    No contact
                                                <?php } else { ?>
                                                    <?= $vendor2['contact'] ?>
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Email:
                                                <?php if (empty($vendor2['email'])) { ?>
                                                    No email
                                                <?php } else { ?>
                                                    <?= $vendor2['email'] ?>
                                                <?php } ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?php if (empty($vendor2)) : ?>
                                            <form method="post" action="../includes/vendor.crud.php">
                                                <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID ?>">
                                                <input type="hidden" name="stall_ID" value="<?= $row['stall_ID'] ?>">
                                                <input type="hidden" name="stall_name" value="Requested">
                                                <input type="hidden" name="map_ID" value="<?php echo $map_ID; ?>">
                                                <button type="submit" name="request_stall" class="btn btn-primary">Request</button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if (empty($vendor2)) {
                                        } else { ?>
                                            <?php if ($vendor2['vendor_ID'] === $vendor_ID) : ?>
                                                <?php if ($vendor2['stall_status'] === '2') { ?>
                                                <?php } else { ?>
                                                    <form action="../includes/vendor.crud.php" method="post">
                                                        <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID ?>">
                                                        <input type="hidden" name="stall_ID" value="<?= $row['stall_ID'] ?>">
                                                        <input type="hidden" name="map_ID" value="<?php echo $map_ID; ?>">
                                                        <button type="submit" name="cancel_request" class="btn btn-danger cancel">Cancel</button>
                                                    </form>
                                                <?php } ?>
                                            <?php endif; ?>
                                        <?php } ?>
                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <img src="<?= $row1['path'] ?>" class="fit-image img-fluid" id="mapimage" alt="market map" />
                </div>
            </div>

            <!-- <div class="row m-auto mb-2 mt-2">
                <div class="col-md-10 m-auto p-0">
                    <button type="button" class="btn btn-warning float-end button-size text-bold" id="plot"><i class="fa fa-map-marker"></i> Plot Stall</button>
                </div>
            </div> -->

            <!-- Modal -->
            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title text-light" id="exampleModalLabel">Plot Stall</h5>
                        </div>
                        <div class="modal-body px-5">
                            <form method="post" action="../includes/marketAd.crud.php">

                                Map ID
                                <input type="hidden" name="map_ID" value="<?php echo $row1['map_ID']; ?>">

                                <div class="form-group mb-2">
                                    <label class="text-light">Select Stall:</label>
                                    <select class="form-select text-dark" name="stall_ID">
                                        <?php
                                        $sql1 = "SELECT * FROM stall, vendor WHERE stall_status='1' AND stall.market_admin_ID='$ma_ID' AND vendor.vendor_ID=stall.vendor_ID";
                                        $result_stall = mysqli_query($conn, $sql1);
                                        ?>
                                        <?php if (mysqli_num_rows($result_stall) > 0) { ?>
                                            <?php while ($row = mysqli_fetch_assoc($result_stall)) { ?>
                                                <?php
                                                $stall_ID = $row['stall_ID'];
                                                $stall_name = $row['stall_name'];
                                                $vendor_ID = $row['vendor_ID'];
                                                $vendor_name = $row['name'];
                                                ?>
                                                <option value="<?php echo $stall_ID; ?>"><?php echo $stall_name; ?> -
                                                    <?php echo $vendor_name; ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="0">No stall available</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="text-light">Latitude</label>
                                    <input id="latitude" class="form-control text-dark" name="latitude">
                                </div>
                                <div class="form-group">
                                    <label class="text-light">Longitude</label>
                                    <input id="longitude" class="form-control text-dark" name="longitude">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary button-size text-bold" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                    <button type="submit" name="plot_stall" class="btn btn-primary button-size text-bold"><i class="fa fa-check"></i>
                                        Save</button>
                                </div>
                        </div>

                    </div>

                    </form>
                </div>
            </div> -->
        </div>
    </div>
</div>


<?php

@include '../includes/all.footer.php';

?>

<script>
    $(document).ready(function() {
        $("#plot").on("click", function() {
            if ($(this).text() == "Cancel") {
                $(this).text("Plot Stall");
                $("#mapimage").off("click");
                $("#mapimage").css("cursor", 'auto');
            } else {
                $(this).text("Cancel");
                $("#mapimage").css("cursor", 'pointer');
                $("#mapimage").on("click", function(event) {
                    var x = event.pageX;
                    var y = event.pageY;
                    // Get the position and size of the image
                    var imageOffset = $('#mapimage').offset();
                    var imageWidth = $('#mapimage').width();
                    var imageHeight = $('#mapimage').height();
                    // Calculate the percentage of the coordinates
                    var xPercent = (x - imageOffset.left) / imageWidth * 100;
                    var yPercent = (y - imageOffset.top) / imageHeight * 100;
                    // Set the coordinates in the input fields
                    $('#latitude').val(xPercent);
                    $('#longitude').val(yPercent);
                    $('#exampleModal').modal('show');
                });
            }
        });
    });
</script>