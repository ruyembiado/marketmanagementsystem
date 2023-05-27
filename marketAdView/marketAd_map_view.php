<?php

@include '../includes/marketAd.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size px-4" href="marketAd_map.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="row justify-content-center rounded">
        <div class="col-md-11 mb-5 align-items-center justify-content-center bg-light text-dark rounded">
            <?php
            $map_ID = $_GET['map_view'];
            $sql = "SELECT * FROM stall, map WHERE map.map_ID='$map_ID' AND map.map_ID=stall.map_ID AND map.market_admin_ID='$ma_ID'";
            $result = mysqli_query($conn, $sql);
            ?>
            <div class="row m-auto">

                <?php
                $map = "SELECT * FROM map, market_admin WHERE market_admin.market_admin_ID='$ma_ID' AND map.map_ID ='$map_ID' LIMIT 1";
                $map1 = mysqli_query($conn, $map);
                $row1 = mysqli_fetch_assoc($map1);

                ?>
                <div class="mt-4">
                    <h4 class="text-dark text-center">
                        <?php echo $row1['map_name'] ?>
                    </h4>
                </div>
                <div class="col-md-10 border border-secondary rounded shadow m-auto mt-3 p-0" id="map" style="position: relative;">
                    <?php
                    //Pins
                    while ($row = mysqli_fetch_assoc($result)) {

                        if ($row['stall_status'] == '0') {
                            echo '<p class="stallname m-0 p-1 border shadow text-center bg-danger" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row['stall_ID'] . '"style="position: absolute; cursor: pointer; font-size: 9px; left:' . $row['latitude'] . '%; top: ' . ($row['longitude'] - 6) . '%;">' . $row['stall_name'] . '</p>';
                            echo '<img src="../pin.png" id="pin" class="pin" style="position: absolute; left: ' . ($row['latitude'] - 0.38) . '%; top: ' . ($row['longitude'] - 2) . '%;">';
                        } else if ($row['stall_status'] == '2') {
                            echo '<p class="stallname m-0 p-1 border shadow text-center bg-warning" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row['stall_ID'] . '"style="position: absolute; cursor: pointer; font-size: 9px; left:' . $row['latitude'] . '%; top: ' . ($row['longitude'] - 6) . '%;">' . $row['stall_name'] . '</p>';
                            echo '<img src="../pin.png" id="pin" class="pin" style="position: absolute; left: ' . ($row['latitude'] - 0.38) . '%; top: ' . ($row['longitude'] - 2) . '%;">';
                        }
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
                                        <form method="post" action="../includes/marketAd.crud.php">
                                            <input type="hidden" name="stall_ID" value="<?= $row['stall_ID'] ?>">
                                            <input type="hidden" name="map_ID" value="<?= $row['map_ID'] ?>">
                                            <input type="hidden" name="market_admin_ID" value="<?= $row['market_admin_ID'] ?>">
                                            <button type="submit" name="remove_stall" class="btn btn-danger">Remove</button>
                                        </form>
                                        <button type="button" class="btn btn-primary text-light" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <img src="<?= $row1['map_img'] ?>" class="fit-image img-fluid" id="mapimage" alt="market map" />
                </div>
            </div>

            <div class="row m-auto mb-2 mt-2">
                <div class="col-md-10 m-auto p-0">
                    <button type="button" class="btn btn-primary float-end text-light button-size" id="plot"><i class="fa fa-map-marker"></i> Plot Stall</button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <div class="d-flex justify-content-between col-md-12">
                                <h5 class="modal-title text-light" id="exampleModalLabel">Plot Stall</h5>
                                <div class="col-md-7">
                                    <div class="d-flex align-items-center">
                                        <label for="" class="me-2">Search:</label>
                                        <input type="search" value="" name="search_stall" class="form-control-sm rounded" id="stallSearch">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body px-5">
                            <form method="post" action="../includes/marketAd.crud.php">
                                <!-- Map ID -->
                                <input type="hidden" name="map_ID" value="<?php echo $row1['map_ID']; ?>">
                                <input type="hidden" name="market_admin_ID" value="<?php echo $ma_ID; ?>">
                                <div class="form-group mb-2">
                                    <label class="text-light">Select Stall:</label>
                                    <select class="form-select text-dark" name="stall_ID" id="stallSelect">
                                        
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <!-- <label class="text-light">Latitude</label> -->
                                    <input id="latitude" type="hidden" class="form-control text-dark" name="latitude">
                                </div>
                                <div class="form-group">
                                    <!-- <label class="text-light">Longitude</label> -->
                                    <input id="longitude" type="hidden" class="form-control text-dark" name="longitude">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger button-size text-light" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                    <button type="submit" name="plot_stall" class="btn btn-primary button-size text-light"><i class="fa fa-check"></i>
                                        Plot</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
<script>
    $(document).ready(function() {
        function stallSearch(url) {
            $.ajax({
                url: url,
                success: function(result) {
                    $("#stallSelect").html(result);
                }
            });
        }
        // Call stallSearch() initially to populate the adviser list
        stallSearch("http://localhost/market/marketAdView/getStall.php?normal");
        // Use debounce to reduce the number of requests made while typing
        $("#exampleModal").on("input","#stallSearch", function() {
            var searchStall = $(this).val();
            if (searchStall.length > 0) {
                var timeoutId = setTimeout(function() {
                    stallSearch("http://localhost/market/marketAdView/getStall.php?search&stallSearch=" + searchStall);
                }, 500);
            } else {
                // Call stallSearch() with no search query when input is cleared
                stallSearch("http://localhost/market/marketAdView/getStall.php?normal");
            }
        });
    });
</script>