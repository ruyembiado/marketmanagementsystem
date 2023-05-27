<?php

@include '../includes/admin.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 text-center text-light px-5 pt-3 rounded">
        <div class="form-group">
            <div class="row d-flex justify-content-start">
                <h3 style="color: #F4D58D;" class=" text-start">Dashboard</h3>
                <hr class="hr text-secondary" />
                <div class="col-md-12 col-sm-12 p-4 table-responve-sm rounded" style="background-color: #708D81;">
                    <p class="mb-2" style="color:#001427;">Market Admin</p>
                    <table class="table table-admin">
                        <thead style="background-color: #001427;">
                            <tr>
                                <th style="display:none"></th>
                                <th style="color: #F4D58D;">Market</th>
                                <th style="color: #F4D58D;">Name</th>
                                <th style="color: #F4D58D;">Contact</th>
                            </tr>
                        </thead>
                        <?php
                        $sql = "SELECT * FROM market, market_admin WHERE market.market_ID=market_admin.market_ID AND market_admin_status='1' ORDER BY market_admin_ID ASC";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $market_admin_ID = $row['market_admin_ID'];
                                $market_name = $row['market_name'];
                                $name = $row['name'];
                                $contact = $row['contact'];
                                $username = $row['username'];
                                $email = $row['email'];
                                $pass = $row['password'];
                                $market_admin_status = $row['market_admin_status'];
                        ?>
                                <tr>
                                    <td style="display:none" style="color: #001427;">
                                        <?php echo $market_admin_ID; ?>
                                    </td>
                                    <td style="color: #001427;">
                                        <?php echo $market_name; ?>
                                    </td>
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
                                <?php echo "<tr><td colspan='7' class='text-light'>No records found.</td></tr>"; ?>
                            <?php
                        }
                            ?>
                    </table>
                </div>

                <hr class="hr text-dark" />

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM market WHERE market_status='1'";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="bi bi-shop pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p class="text-center mb-4" style="color: #001427;">Total Market</p>
                    </div>
                </div>

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM market_admin WHERE market_admin_status='1'";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="bi bi-person-lines-fill pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p style="color: #001427;">Total Market Admin</p>
                    </div>
                </div>

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM vendor WHERE vendor_status='1'";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="bi bi-person-lines-fill pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p class="mb-4" style="color: #001427;">Total Vendor</p>
                    </div>
                </div>

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM map";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fa fa-map pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p class="mb-4" style="color: #001427;">Total Map</p>
                    </div>
                </div>

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM stall WHERE stall_status='2'";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="bi bi-shop-window pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p class="mb-4" style="color: #001427;">Total Stall</p>
                    </div>
                </div>

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM product";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fas fa-fish pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p class="mb-4" style="color: #001427;">Total Product</p>
                    </div>
                </div>

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM customer";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="bi bi-person-lines-fill pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p class="mb-4" style="color: #001427;">Total Customer</p>
                    </div>
                </div>

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM reservation, stall, product WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reserve_status='1' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fa fa-file-text pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p style="color: #001427;">Total Pending Reservation</p>
                    </div>
                </div>

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM reservation, stall, product WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reserve_status='4' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fa fa-file-text pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p style="color: #001427;">Total Accepted Reservation</p>
                    </div>
                </div>

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM reservation, stall, product WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reserve_status='5' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fa fa-file-text pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p style="color: #001427;">Total Cancelled Reservation</p>
                    </div>
                </div>

                <div class="card col-md-3 mb-3 me-4" style="background-color: #708D81;">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM reservation, stall, product WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reserve_status='3' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fa fa-file-text pb-3" style="color:#001427; font-size: 80px;"></i>
                        <h1 class="mb-4" style="color:#001427;">
                            <?php echo $count; ?>
                        </h1>
                    </div>
                    <div class="card-footer rounded d-flex justify-content-center" style="background-color: #F4D58D;">
                        <p style="color: #001427;">Total Finished Reservation</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


<?php

@include '../includes/all.footer.php';

?>