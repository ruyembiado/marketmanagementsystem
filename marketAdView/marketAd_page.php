<?php

@include '../includes/marketAd.header.php';

?>
<div class="row justify-content-center mx-0">
    <div class="col-md-11 text-center text-light px-5 pt-3 rounded">
        <div class="form-group">
            <h3 style="color: #F4D58D;" class="h3 text-start">Dashboard</h3>
            <hr class="hr text-secondary" />
            <div class="col-md-12 m-auto p-4 rounded" style="background-color: #708D81;">
                <p class="mb-2" style="color:#001427;">Vendors</p>
                <table class="table account-table">
                    <thead style="background-color: #001427;">
                        <th style="display:none"></th>
                        <th style="color: #F4D58D;">Name</th>
                        <th style="color: #F4D58D;">Contact</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM vendor WHERE vendor.market_admin_ID='$ma_ID' AND vendor_status='1' ORDER BY vendor.vendor_ID ASC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $vendor_ID = $row['vendor_ID'];
                            $name = $row['name'];
                            $contact = $row['contact'];
                    ?>
                            <tr>
                                <th style="display:none">
                                    <?php echo $vendor_ID; ?>
                                </th>
                                <td style="color: #001427;">
                                    <?php echo $name; ?>
                                </td>
                                <td style="color: #001427;">
                                    <?php echo $contact; ?>
                                </td>
                            <?php
                        }
                            ?>
                        <?php } else { ?>
                            <?php echo "<tr><td colspan='7' class='text-light'>No vendor.</td></tr>"; ?>
                        <?php
                    }
                        ?>
                </table>
            </div>
            <div class="form-group">
                <div class="row d-flex justify-content-start mt-3">
                    <hr class="hr text-secondary" />

                    <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                        <div class="col-md-11 m-auto">
                            <?php
                            $sql = "SELECT * FROM map WHERE market_admin_ID='$ma_ID'";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            ?>
                            <i class="fa fa-map pb-3" style="color:#001427; font-size: 80px;"></i>
                            <h1 style="color:#001427;" class="mb-4">
                                <?php echo $count; ?>
                            </h1>
                        </div>
                        <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                            <p class="mb-4" style="color: #001427;">Total Map</h6>
                        </div>
                    </div>

                    <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                        <div class="col-md-11 m-auto">
                            <?php
                            $sql = "SELECT * FROM vendor WHERE vendor.market_admin_ID='$ma_ID' AND vendor_status='1' ORDER BY vendor.vendor_ID ASC";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            ?>
                            <i class="bi bi-person-lines-fill pb-3" style="color:#001427; font-size: 80px;"></i>
                            <h1 style="color:#001427;" class="mb-4">
                                <?php echo $count; ?>
                            </h1>
                        </div>
                        <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                            <p class="mb-4" style="color: #001427;">Total Vendor</h6>
                        </div>
                    </div>

                    <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                        <div class="col-md-11 m-auto">
                            <?php
                            $sql = "SELECT * FROM product, stall, vendor, market_admin WHERE product.stall_ID=stall.stall_ID AND vendor.vendor_ID=stall.vendor_ID AND vendor.market_admin_ID=market_admin.market_admin_ID AND market_admin.market_admin_ID='$ma_ID'";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            ?>
                            <i class="fas fa-fish pb-3" style="color:#001427; font-size: 80px;"></i>
                            <h1 style="color:#001427;" class="mb-4">
                                <?php echo $count; ?>
                            </h1>
                        </div>
                        <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                            <p class="mb-4" style="color: #001427;">Total Product</h6>
                        </div>
                    </div>

                    <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                        <div class="col-md-11 m-auto">
                            <?php
                            $sql = "SELECT * FROM customer";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            ?>
                            <i class="bi bi-person-lines-fill pb-3" style="color:#001427; font-size: 80px;"></i>
                            <h1 style="color:#001427;" class="mb-4">
                                <?php echo $count; ?>
                            </h1>
                        </div>
                        <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                            <p class="mb-4" style="color: #001427;">Total Customer</h6>
                        </div>
                    </div>

                    <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                        <div class="col-md-11 m-auto">
                            <?php
                            $sql = "SELECT * FROM reservation, stall, product, vendor, market_admin WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reserve_status='1' AND vendor.market_admin_ID=market_admin.market_admin_ID AND market_admin.market_admin_ID='$ma_ID' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            ?>
                            <i class="fa fa-file-text pb-3" style="color:#001427; font-size: 80px;"></i>
                            <h1 style="color:#001427;" class="mb-4">
                                <?php echo $count; ?>
                            </h1>
                        </div>
                        <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                            <p class="mb-4" style="color: #001427;">Total Pending Reservation</h6>
                        </div>
                    </div>

                    <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                        <div class="col-md-11 m-auto">
                            <?php
                            $sql = "SELECT * FROM reservation, stall, product, vendor, market_admin WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reserve_status='4' AND vendor.market_admin_ID=market_admin.market_admin_ID AND market_admin.market_admin_ID='$ma_ID' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            ?>
                            <i class="fa fa-file-text pb-3" style="color:#001427; font-size: 80px;"></i>
                            <h1 style="color:#001427;" class="mb-4">
                                <?php echo $count; ?>
                            </h1>
                        </div>
                        <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                            <p class="mb-4" style="color: #001427;">Total Accepted Reservation</h6>
                        </div>
                    </div>

                    <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                        <div class="col-md-11 m-auto">
                            <?php
                            $sql = "SELECT * FROM reservation, stall, product, vendor, market_admin WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reserve_status='5' AND vendor.market_admin_ID=market_admin.market_admin_ID AND market_admin.market_admin_ID='$ma_ID' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            ?>
                            <i class="fa fa-file-text pb-3" style="color:#001427; font-size: 80px;"></i>
                            <h1 style="color:#001427;" class="mb-4">
                                <?php echo $count; ?>
                            </h1>
                        </div>
                        <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                            <p class="mb-4" style="color: #001427;">Total Cancelled Reservation</h6>
                        </div>
                    </div>

                    <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                        <div class="col-md-11 m-auto">
                            <?php
                            $sql = "SELECT * FROM reservation, stall, product, vendor, market_admin WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reserve_status='3' AND vendor.market_admin_ID=market_admin.market_admin_ID AND market_admin.market_admin_ID='$ma_ID' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            ?>
                            <i class="fa fa-file-text pb-3" style="color:#001427; font-size: 80px;"></i>
                            <h1 style="color:#001427;" class="mb-4">
                                <?php echo $count; ?>
                            </h1>
                        </div>
                        <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                            <p class="mb-4" style="color: #001427;">Total Finished Reservation</h6>
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