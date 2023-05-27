<?php

@include '../includes/customer.header.php';

?>
<?php
$stall_ID = $_GET['view_map'];
$map_ID = $_GET['market_ID'];
?>

<div class="row justify-content-center mt-1 mb-1 mx-0">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size px-4" href="customer_page.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="row justify-content-center rounded">
        <div class="col-md-10 mb-3 pb-5 align-items-center justify-content-center bg-light text-dark rounded">
            <?php
            $sql = "SELECT * FROM stall, market_admin, map WHERE stall.stall_ID ='$stall_ID' AND stall_status='2' AND stall.map_ID=map.map_ID";
            $result = mysqli_query($conn, $sql);
            ?>
            <div class="row m-auto">
                <?php
                $map = "SELECT * FROM map WHERE map_ID ='$map_ID'";
                $map1 = mysqli_query($conn, $map);
                $row1 = mysqli_fetch_assoc($map1);
                ?>
                <div class="mt-4">
                    <h4 class="text-dark text-center">
                        <?= $row1['map_name'] ?>
                    </h4>
                </div>
                <div class="col-md-10 border border-secondary rounded shadow m-auto mt-3 p-0" id="map" style="position: relative;">
                    <?php
                    //Pin
                    while ($row = mysqli_fetch_assoc($result)) :
                        echo '<p class="stallname m-0 p-1 border text-center bg-warning" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row['stall_ID'] . '"style="position: absolute; cursor: pointer; font-size: 9px; left:' . $row['latitude'] . '%; top: ' . ($row['longitude'] - 6) . '%;">' . $row['stall_name'] . '</p>';
                        echo '<img src="../pin.png" id="pin" class="pin" style="position: absolute; left: ' . ($row['latitude'] - 0.38) . '%; top: ' . ($row['longitude'] - 2) . '%;">';
                    ?>
                        <!--Details Modal -->
                        <div class="modal fade my-modal" id="detailsModal<?= $row['stall_ID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="detailsModal<?= $row['stall_ID'] ?>">
                                            <?= $row['stall_name'] ?></h1>
                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
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
                                                <?= $row['map_name'] ?>
                                            </label>
                                        </div>
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Market Floor:
                                                <?= $row['map_floor'] ?>
                                            </label>
                                        </div>
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Vendor:
                                                <?= $vendor2['name'] ?>
                                            </label>
                                        </div>
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Contact Number:
                                                <?= $vendor2['contact'] ?>
                                            </label>
                                        </div>
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Email:
                                                <?= $vendor2['email'] ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" href="customer_store_view.php?view_stall=<?php echo $stallID; ?>" class="text-light btn btn-primary">View Stall</a>
                                        <button type="button" class="text-light btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- endmodal -->
                    <?php endwhile; ?>
                    <img src="<?= $row1['map_img'] ?>" class="fit-image img-fluid" style="pointer-events: none;" id="mapimage" alt="market map"/>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>