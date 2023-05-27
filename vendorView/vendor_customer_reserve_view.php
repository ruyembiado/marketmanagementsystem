<?php

@include '../includes/vendor.header.php';

?>

<div class="row mx-auto mt-2">
    <div class="col-md-11 mx-auto p-0">
        <div>
            <?php
            // Set the time zone to your desired timezone
            date_default_timezone_set('Asia/Manila');
            // Get the current year, month, and week number
            $current_year = date('Y');
            $current_month = date('M');
            $current_week = date('w');
            // Calculate the timestamp of the first Monday of the month
            $timestamp = strtotime("Monday, $current_year-$current_month-$current_week");
            // Format the timestamp as a date
            $date = date('Y-m-d', $timestamp);
            ?>
            <a class="btn btn-primary text-light float-start mb-2 button-size px-3" href="vendor_customer_reservation.php?date_from=<?php echo $date; ?>&date_to=<?php echo date('Y-m-d', strtotime('+7 days')) ?>" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<?php
$reservation_date = $_GET['view_reserve'];
$sql = "SELECT * FROM reservation, stall, product, customer WHERE customer.customer_ID=reservation.customer_ID AND reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.vendor_ID='$vendor_ID' AND reservation.reservation_date='$reservation_date' GROUP BY product.product_ID";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {

    $customer_name  = $row['name'];
    $customer_contact  = $row['contact'];
?>
    <div class="row justify-content-center mx-0">
        <div class="col-md-11 p-4 text-center text-dark mt-1 mb-3 rounded" style="background-color: #708D81;">
            <div class="col-md-12 text-center mb-3">
                <h5 class="text-center" style="color: #001427;">Manage Reservation</h5>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="">
                    <p style="color: #001427;" class="text-start text-bold mb-0 pb-0">Customer Name: <?php echo $customer_name; ?></p>
                    <p style="color: #001427;" class="text-start mb-0 pb-0">Contact Number: <?php echo $customer_contact; ?></p>
                    <p style="color: #001427;" class="text-start mb-0 pb-0">Reservation Date: <?php echo date('M d, Y h:i:s a', strtotime($reservation_date)); ?></p>
                </div>
                <div class="col-md-2">
                    <label for="" style="color: #001427;">Filter by:</label>
                    <select class="col-sm-6 rounded form-select-sm" name="status" id="status" onchange="location.href = 'vendor_customer_reserve_view.php?view_reserve=<?php echo $reservation_date; ?>&status=' + this.value;">
                        <option <?php echo $_GET['status'] == 'all' ? 'selected' : '' ?> value="all">All</option>
                        <option <?php echo $_GET['status'] == 'pending' ? 'selected' : '' ?> value="pending">Pending</option>
                        <option <?php echo $_GET['status'] == 'accepted' ? 'selected' : '' ?> value="accepted">Accepted</option>
                        <option <?php echo $_GET['status'] == 'cancelled' ? 'selected' : '' ?> value="cancelled">Cancelled</option>
                        <option <?php echo $_GET['status'] == 'done' ? 'selected' : '' ?> value="done">Done</option>
                    </select>
                </div>
            </div>

            <div class="top-head d-flex align-items-center justify-content-center">
                <div class="col-md-3" style="color: #001427;">Product</div>
                <div class="col-md-1"></div>
                <div class="col-md-3 text-start" style="color: #001427;">Price per unit</div>
                <div class="col-md-2" style="color: #001427;">Quantity</div>
                <div class="col-md-2" style="color: #001427;">Total Price</div>
            </div>
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'all') {
                $status = "all";
                $sql2 = "SELECT ROUND(SUM(reservation.quantity * product.product_price), 2) as grand_total FROM reservation, product WHERE reservation.product_ID=product.product_ID AND reservation.vendor_ID = '$vendor_ID' AND reservation.reservation_date='$reservation_date'";
                $result = mysqli_query($conn, $sql2);
                $total = mysqli_fetch_array($result);

                $sql = "SELECT DISTINCT stall.stall_name, reservation.reservation_date, reservation.reserve_status, reservation.reservation_expdate, vendor.contact, stall.stall_ID, stall.map_ID, reservation.reserve_index FROM reservation, stall, product, vendor WHERE stall.vendor_ID=vendor.vendor_ID AND reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.vendor_ID='$vendor_ID' AND reservation.reservation_date='$reservation_date'";
                $result = mysqli_query($conn, $sql);
            } else if (isset($_GET['status']) && $_GET['status'] == 'pending') {
                $status = "pending";
                $sql2 = "SELECT ROUND(SUM(reservation.quantity * product.product_price), 2) as grand_total FROM reservation, product WHERE reservation.product_ID=product.product_ID AND reservation.vendor_ID = '$vendor_ID' AND reservation.reservation_date='$reservation_date' AND reservation.reserve_status='1'";
                $result = mysqli_query($conn, $sql2);
                $total = mysqli_fetch_array($result);

                $sql = "SELECT DISTINCT stall.stall_name, reservation.reservation_date, reservation.reserve_status, reservation.reservation_expdate, vendor.contact, stall.stall_ID, stall.map_ID, reservation.reserve_index FROM reservation, stall, product, vendor WHERE stall.vendor_ID=vendor.vendor_ID AND reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.vendor_ID='$vendor_ID' AND reservation.reservation_date='$reservation_date'AND reservation.reserve_status='1'";
                $result = mysqli_query($conn, $sql);
            } else if (isset($_GET['status']) && $_GET['status'] == 'done') {
                $status = "done";
                $sql2 = "SELECT ROUND(SUM(reservation.quantity * product.product_price), 2) as grand_total FROM reservation, product WHERE reservation.product_ID=product.product_ID AND reservation.vendor_ID = '$vendor_ID' AND reservation.reservation_date='$reservation_date' AND reservation.reserve_status='3'";
                $result = mysqli_query($conn, $sql2);
                $total = mysqli_fetch_array($result);

                $sql = "SELECT DISTINCT stall.stall_name, reservation.reservation_date, reservation.reserve_status, reservation.reservation_expdate, vendor.contact, stall.stall_ID, stall.map_ID, reservation.reserve_index FROM reservation, stall, product, vendor WHERE stall.vendor_ID=vendor.vendor_ID AND reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.vendor_ID='$vendor_ID' AND reservation.reservation_date='$reservation_date'AND reservation.reserve_status='3'";
                $result = mysqli_query($conn, $sql);
            } else if (isset($_GET['status']) && $_GET['status'] == 'cancelled') {
                $status = "cancelled";
                $sql2 = "SELECT ROUND(SUM(reservation.quantity * product.product_price), 2) as grand_total FROM reservation, product WHERE reservation.product_ID=product.product_ID AND reservation.vendor_ID = '$vendor_ID' AND reservation.reservation_date='$reservation_date' AND reservation.reserve_status='5'";
                $result = mysqli_query($conn, $sql2);
                $total = mysqli_fetch_array($result);

                $sql = "SELECT DISTINCT stall.stall_name, reservation.reservation_date, reservation.reserve_status, reservation.reservation_expdate, vendor.contact, stall.stall_ID, stall.map_ID, reservation.reserve_index FROM reservation, stall, product, vendor WHERE stall.vendor_ID=vendor.vendor_ID AND reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.vendor_ID='$vendor_ID' AND reservation.reservation_date='$reservation_date'AND reservation.reserve_status='5'";
                $result = mysqli_query($conn, $sql);
            } else if (isset($_GET['status']) && $_GET['status'] == 'accepted') {
                $status = "accepted";
                $sql2 = "SELECT ROUND(SUM(reservation.quantity * product.product_price), 2) as grand_total FROM reservation, product WHERE reservation.product_ID=product.product_ID AND reservation.vendor_ID = '$vendor_ID' AND reservation.reservation_date='$reservation_date' AND reservation.reserve_status='4'";
                $result = mysqli_query($conn, $sql2);
                $total = mysqli_fetch_array($result);

                $sql = "SELECT DISTINCT stall.stall_name, reservation.reservation_date, reservation.reserve_status, reservation.reservation_expdate, vendor.contact, stall.stall_ID, stall.map_ID, reservation.reserve_index FROM reservation, stall, product, vendor WHERE stall.vendor_ID=vendor.vendor_ID AND reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.vendor_ID='$vendor_ID' AND reservation.reservation_date='$reservation_date'AND reservation.reserve_status='4'";
                $result = mysqli_query($conn, $sql);
            }


            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $contact = $row['contact'];
                    $stall_name = $row['stall_name'];
                    $stall_ID = $row['stall_ID'];
                    $map_ID = $row['map_ID'];
                    $reservation_date = $row['reservation_date'];
                    $exp_date = $row['reservation_expdate'];
                    $reserve_status = $row['reserve_status'];
                    $reserve_index = $row['reserve_index'];

                    $sub = "SELECT ROUND(SUM(reservation.quantity * product.product_price), 2) as sub_total FROM reservation, product, stall WHERE stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.vendor_ID = '$vendor_ID' AND reservation.reservation_date='$reservation_date' AND stall.stall_ID='$stall_ID'";
                    $sub2 = mysqli_query($conn, $sub);
                    $subtotal = mysqli_fetch_array($sub2);

            ?>
                    <div class="stall-cont p-2 mb-2 rounded" style="background-color: #001427;">
                        <div class="text-dark text-start rounded p-2 mb-2" style="background-color: #F4D58D;">
                            <div class="d-flex flex-row align-items-center justify-content-start">
                                <div class="d-flex align-items-center col-md-8">
                                    <p style="color: #001427;" class="text-bold mb-0 pb-0"><?php echo $stall_name; ?></p>
                                </div>
                                <div class="d-flex align-items-center col-md-4">
                                    <div style="color: #001427;" class="me-2">Action:</div>
                                    <?php if ($reserve_status == '1') { ?>
                                        <a class="btn btn-primary text-light button-size me-2" href="../includes/vendor.crud.php?accept_reserve=<?php echo $reservation_date; ?>&reserve_index=<?php echo $reserve_index; ?>&status=<?php echo $status; ?>" role="button"><i class="fa fa-check"></i> Accept</a>
                                        <a class="btn btn-danger text-light cancel button-size me-2" href="../includes/vendor.crud.php?cancel_reserve=<?php echo $reservation_date; ?>&reserve_index=<?php echo $reserve_index; ?>&status=<?php echo $status; ?>" role="button"><i class="fa fa-remove"></i> Cancel</a>
                                    <?php } else if ($reserve_status == '4') { ?>
                                        <a class="btn btn-success text-light button-size me-2" href="../includes/vendor.crud.php?done_reserve=<?php echo $reservation_date; ?>&reserve_index=<?php echo $reserve_index; ?>&status=<?php echo $status; ?>" role="button"><i class="fa fa-check"></i> Done</a>
                                        <a class="btn btn-danger text-light cancel button-size me-2" href="../includes/vendor.crud.php?cancel_reserve=<?php echo $reservation_date; ?>&reserve_index=<?php echo $reserve_index; ?>&status=<?php echo $status; ?>" role="button"><i class="fa fa-remove"></i> Cancel</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <p style="color: #001427;" class="mb-0 pb-0 me-2 h6">Expiration Date:
                                    <?php if ($exp_date == NULL) {
                                        echo "None";
                                    } else {
                                        echo date('M d, Y h:i:s a', strtotime($exp_date));
                                    } ?>
                                </p>

                                <?php
                                if ($reserve_status == '1') { ?>
                                    <p style="color: #001427;" class="mb-0 pb-0 me-2 h6">
                                        Status: Pending
                                    </p>
                                <?php } else if ($reserve_status == '3') { ?>
                                    <p style="color: #001427;" class="mb-0 pb-0 me-2 h6">
                                        Status: Done
                                    </p>
                                <?php } else if ($reserve_status == '4') { ?>
                                    <p style="color: #001427;" class="mb-0 pb-0 me-2 h6">
                                        Status: Accepted
                                    </p>
                                <?php } else if ($reserve_status == '5') { ?>
                                    <p style="color: #001427;" class="mb-0 pb-0 me-2 h6">
                                        Status: Cancelled
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php

                        $sql = "SELECT * FROM reservation, stall, product WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.vendor_ID='$vendor_ID' AND stall.stall_ID='$stall_ID' AND reservation.reservation_date='$reservation_date'";

                        $result2 = mysqli_query($conn, $sql);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $map_ID = $row2['map_ID'];
                            $stall_ID = $row2['stall_ID'];
                            $reserve_index = $row2['reserve_index'];
                            $reservation_ID = $row2['reservation_ID'];
                            $product_img = $row2['product_img'];
                            $product_name = $row2['product_name'];
                            $product_price = $row2['product_price'];
                            $quantity = $row2['quantity'];
                            $product_unit = $row2['product_unit'];
                            $reservation_date = $row2['reservation_date'];

                        ?>
                            <div class="d-flex align-items-center rounded justify-content-between product-cont p-2 mb-1" style="background-color: #F4D58D;">
                                <img src="<?= $row2['product_img'] ?>" class="img-fluid rounded mb-1 ms-1" style="height: 100px; width: 100px;" alt="">
                                <p style="color: #001427;" class="col-md-3 text-start"><?php echo $product_name; ?></p>
                                <p style="color: #001427;" class="col-md-2 text-start">
                                    ₱
                                    <?php echo $product_price; ?>/
                                    <?php echo $product_unit; ?>
                                </p>
                                <p style="color: #001427;" class="col-md-2 d-flex justify-content-center">
                                    <?php echo $quantity; ?>
                                </p>
                                <p style="color: #001427;" class="col-md-2">
                                    ₱
                                    <?php echo $product_price * $quantity; ?>
                                </p>
                            </div>
                        <?php } ?>
                        <div class="d-flex align-items-center justify-content-end mt-2">
                            <div class="col-md-2">
                                <div class="d-flex align-items-center justify-content-end">
                                    <p style="color: #F4D58D;" class="me-2 mb-0 pb-0">Total:</p>
                                    <p style="color: #F4D58D;" class="mb-0 pb-0 me-2">
                                        ₱<?php echo $subtotal['sub_total']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-12 checkout-cont mt-1 d-flex align-items-center justify-content-end">
                    <div class="col-md-3 pt-2 rounded d-flex align-items-center justify-content-center" style="background-color: #F4D58D;">
                        <p style="color: #001427;" class="me-2">Grand Total:</p>
                        <p class="text-dark" class="mb-0">
                            <?php if ($total['grand_total']) { ?>
                                ₱<?php echo $total['grand_total']; ?>
                            <?php } else {
                            } ?>
                        </p>
                    </div>
                </div>
            <?php } else { ?>
                <p class="mt-3" style="color: #001427;">No data found</p>
            <?php } ?>
        </div>
    </div>
<?php } ?>
<?php

@include '../includes/all.footer.php';

?>