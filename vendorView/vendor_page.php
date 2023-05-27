<?php

@include '../includes/vendor.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 text-center text-light px-5 pt-3 rounded">
        <div class="form-group">
            <div class="row d-flex justify-content-start">
                <h3 style="color: #F4D58D;" class="text-start">Dashboard</h3>
                <hr class="hr text-secondary" />
                <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM product, stall, vendor WHERE product.stall_ID=stall.stall_ID AND vendor.vendor_ID=stall.vendor_ID AND vendor.vendor_ID='$vendor_ID'";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fas fa-fish pb-3 " style="color:#001427; font-size: 80px;"></i>
                        <h1 class=" mb-4"><?php echo $count; ?></h1>
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
                        <i class="bi bi-person-lines-fill pb-3 " style="color:#001427; font-size: 80px;"></i>
                        <h1 class=" mb-4"><?php echo $count; ?></h1>
                    </div>
                    <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                        <p class="mb-4" style="color: #001427;">Total Customer</h6>
                    </div>
                </div>

                <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM reservation, stall, product, customer WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.customer_ID=customer.customer_ID AND reservation.vendor_ID='$vendor_ID' AND reserve_status='1' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fa fa-file-text pb-3 " style="color:#001427; font-size: 80px;"></i>
                        <h1 class=" mb-4"><?php echo $count; ?></h1>
                    </div>
                    <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                        <p class="mb-4" style="color: #001427;">Total Pending Reservation</h6>
                    </div>
                </div>

                <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM reservation, stall, product, customer WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.customer_ID=customer.customer_ID AND reservation.vendor_ID='$vendor_ID' AND reserve_status='4' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fa fa-file-text pb-3 " style="color:#001427; font-size: 80px;"></i>
                        <h1 class=" mb-4"><?php echo $count; ?></h1>
                    </div>
                    <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                        <p class="mb-4" style="color: #001427;">Total Accepted Reservation</h6>
                    </div>
                </div>

                <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM reservation, stall, product, customer WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.customer_ID=customer.customer_ID AND reservation.vendor_ID='$vendor_ID' AND reserve_status='5' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fa fa-file-text pb-3 " style="color:#001427; font-size: 80px;"></i>
                        <h1 class=" mb-4"><?php echo $count; ?></h1>
                    </div>
                    <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                        <p class="mb-4" style="color: #001427;">Total Cancelled Reservation</h6>
                    </div>
                </div>

                <div style="background-color: #708D81;" class="card col-md-3 mb-3 me-4">
                    <div class="col-md-11 m-auto">
                        <?php
                        $sql = "SELECT * FROM reservation, stall, product, customer WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.customer_ID=customer.customer_ID AND reservation.vendor_ID='$vendor_ID' AND reserve_status='3' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        ?>
                        <i class="fa fa-file-text pb-3 " style="color:#001427; font-size: 80px;"></i>
                        <h1 class=" mb-4"><?php echo $count; ?></h1>
                    </div>
                    <div style="background-color: #F4D58D;" class="card-footer rounded d-flex justify-content-center">
                        <p class="mb-4" style="color: #001427;">Total Finished Reservation</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>