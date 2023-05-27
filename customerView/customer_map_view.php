<?php

@include '../includes/customer.header.php';

$reservation_date = $_GET['view_reserve'];
?>

<div class="row justify-content-center pt-0 mx-0" style="height: 700px;">
    <div class="row justify-content-center rounded mt-2 mb-2">
        <div class="col-md-11 mx-auto p-0">
            <div>
                <a class="btn btn-primary text-light float-start mb-2 button-size px-3" href="customer_reserve_view.php?view_reserve=<?php echo $reservation_date;?>&status=all" role="button"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>

        <div class="col-md-10 mb-5 pb-5 align-items-center justify-content-center bg-light text-dark rounded">

            <?php
            $stall_ID = $_GET['view_stall'];
            $map_ID = $_GET['view_map'];
            $sql = "SELECT * FROM stall, market_admin, map, vendor WHERE vendor.vendor_ID=stall.vendor_ID AND map.map_ID ='$map_ID' AND stall.stall_ID='$stall_ID' AND stall.map_ID=map.map_ID";
            $result = mysqli_query($conn, $sql);
            ?>
            <div class="row m-auto">
                <?php
                $map = "SELECT * FROM map WHERE map_ID ='$map_ID'";
                $map1 = mysqli_query($conn, $map);
                $row1 = mysqli_fetch_assoc($map1);
                ?>
                <div class="mt-4">
                    <h4 style="color: #001427;" class="text-center">
                        <?= $row1['map_name'] ?>
                    </h4>
                </div>
                <div class="col-md-10 border border-secondary rounded shadow m-auto mt-3 p-0" id="map" style="position: relative;">
                    <?php
                    //Pin
                    while ($row = mysqli_fetch_assoc($result)) :

                        if ($row['stall_status'] == '0') {
                            echo '<p class="stallname m-0 p-1 border text-center bg-danger" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row['stall_ID'] . '"style="position: absolute; cursor: pointer; font-size: 9px; left:' . $row['latitude'] . '%; top: ' . ($row['longitude'] - 6) . '%;">' . $row['stall_name'] . '</p>';
                            echo '<img src="../pin.png" id="pin" class="pin" style="position: absolute; left: ' . ($row['latitude'] - 0.38) . '%; top: ' . ($row['longitude'] - 2) . '%;">';
                        } else {
                            echo '<p class="stallname m-0 p-1 border text-center bg-warning" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row['stall_ID'] . '"style="position: absolute; cursor: pointer; font-size: 9px; left:' . $row['latitude'] . '%; top: ' . ($row['longitude'] - 6) . '%;">' . $row['stall_name'] . '</p>';
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
                                                <?= $row['name'] ?>
                                            </label>
                                        </div>
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Contact Number:
                                                <?= $row['contact'] ?>
                                            </label>
                                        </div>
                                        <div class="form-group row mx-5">
                                            <label class="text-dark ">Email:
                                                <?= $row['email'] ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- endmodal -->
                    <?php endwhile; ?>
                    <img src="<?= $row1['map_img'] ?>" class="fit-image img-fluid" style="pointer-events: none;" id="mapimage" alt="market map" />
                </div>
            </div>
        </div>
    </div>

    <?php

    @include '../includes/all.footer.php';

    ?>