<?php

@include '../includes/vendor.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 p-4 table-responsive-sm text-center bg-dark text-dark mt-3 mb-3 rounded" style="height: 576px;">
        <h5 class="text-light">Manage Customer Reservation</h5>
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
                    <th style="display:none">Reservation ID</th>
                    <th class="text-dark">Stall Name</th>
                    <th class="text-dark">Customer Name</th>
                    <!-- <th class="text-dark">Total Price</th> -->
                    <th class="text-dark">Date</th>
                    <th class="text-dark">Expiration Date</th>
                    <th class="text-dark">Status</th>
                    <th class="text-dark">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM reservation, stall, product, customer WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.customer_ID=customer.customer_ID AND reservation.vendor_ID='$vendor_ID' GROUP BY reservation_date, stall_name ORDER BY reservation_date ASC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $reservation_ID = $row['reservation_ID'];
                        $stall_ID = $row['stall_ID'];
                        $stall_name = $row['stall_name'];
                        $customer_ID = $row['customer_ID'];
                        $customer_name = $row['name'];
                        $reservation_date = $row['reservation_date'];
                        $reserve_index = $row['reserve_index'];
                        $reservation_expdate = $row['reservation_expdate'];
                        $reserve_status = $row['reserve_status'];
                        $product_name = $row['product_name'];
                        $product_price = $row['product_price'];
                        $quantity = $row['quantity'];
                        $product_unit = $row['product_unit'];
                ?>
                        <tr>
                            <?php if ($reserve_status === '0') { ?>

                            <?php } else { ?>

                                <td style="display:none"></td>

                                <td class="text-light"><?php echo $stall_name; ?></td>
                                <td class="text-light"><?php echo $customer_name; ?></td>

                            <?php } ?>

                            <?php
                            $sql2 = "SELECT ROUND(SUM(reservation.quantity * product.product_price), 2) AS grand_total, reservation_date AS grand_date FROM reservation, product WHERE reservation.product_ID=product.product_ID AND reservation.customer_ID='$customer_ID' GROUP BY reservation_date ORDER BY reservation_date ASC";
                            $total_prize = mysqli_query($conn, $sql2);
                            if (mysqli_num_rows($total_prize) > 0) {
                                while ($row = mysqli_fetch_assoc($total_prize)) {
                                    $grand_total = $row['grand_total'];
                                    $grand_date = $row['grand_date'];
                            ?>
                                    <?php if ($reserve_status === '0') { ?>

                                    <?php } else { ?>

                                        <?php if ($reservation_date === $grand_date) { ?>

                                            <!-- <td class="text-light">Php <?php echo $grand_total; ?></td> -->

                                        <?php } ?>

                                    <?php } ?>

                            <?php }
                            } else {
                            } ?>

                            <?php if ($reserve_status == '0') { ?>

                            <?php } else { ?>
                                <td class="text-light"><?php echo $readable_datetime = date('M d, Y h:i:s a', strtotime($reservation_date)); ?></td>
                                <?php if (empty($reservation_expdate)) { ?>
                                    <td>
                                        <div class="form-group mx-1 text-danger">Pending</div>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-light"><?php echo $readable_expdatetime = date('M d, Y h:i:s a', strtotime($reservation_expdate)); ?></td>
                                <?php } ?>
                            <?php } ?>

                            <?php if ($reserve_status == '1') { ?>
                                <td>
                                    <div class="form-group mx-1 text-danger">Pending</div>
                                </td>
                            <?php } elseif ($reserve_status == '3') { ?>
                                <td>
                                    <div class="form-group mx-1 text-success">Done</div>
                                </td>
                            <?php } elseif ($reserve_status == '4') { ?>
                                <td>
                                    <div class="form-group mx-1 text-primary">Accepted</div>
                                </td>
                            <?php } elseif ($reserve_status == '5') { ?>
                                <td>
                                    <div class="form-group mx-1 text-danger">Cancelled</div>
                                </td>
                            <?php } else { ?>

                            <?php } ?>

                            <?php if ($reserve_status == '1') { ?>
                                <td>
                                    <form action="" method="post">
                                        <div class="btn-group">
                                            <div class="form-group mx-1">
                                                <a class="btn btn-secondary btn-sm text-dark button-size text-bold" href="vendor_customer_reserve_view.php?view_reserve=<?php echo $reservation_date; ?>&stall_ID=<?php echo $stall_ID; ?>" role="button"><i class="fa fa-eye"></i> View</a>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <div class="form-group mx-1">
                                                <a class="btn btn-warning btn-sm text-dark button-size text-bold" href="../includes/vendor.crud.php?accept_reserve=<?php echo $reservation_date; ?>&reserve_index=<?php echo $reserve_index; ?>" role="button"><i class="fa fa-check"></i> Accept</a>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <div class="form-group mx-1">
                                                <a class="btn btn-danger btn-sm text-dark cancel button-size text-bold" href="../includes/vendor.crud.php?cancel_reserve=<?php echo $reservation_date; ?>" role="button"><i class="fa fa-times"></i> Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            <?php } elseif ($reserve_status == '3') { ?>
                                <td>
                                    <form action="" method="post">
                                        <div class="btn-group">
                                            <div class="form-group mx-1">
                                                <a class="btn btn-secondary btn-sm text-dark button-size text-bold" href="vendor_customer_reserve_view.php?view_reserve=<?php echo $reservation_date; ?>&stall_ID=<?php echo $stall_ID; ?>" role="button"><i class="fa fa-eye"></i> View</a>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            <?php } elseif ($reserve_status == '4') { ?>
                                <td>
                                    <form action="" method="post">
                                        <div class="btn-group">
                                            <div class="form-group mx-1">
                                                <a class="btn btn-secondary btn-sm text-dark button-size text-bold" href="vendor_customer_reserve_view.php?view_reserve=<?php echo $reservation_date; ?>&stall_ID=<?php echo $stall_ID; ?>" role="button"><i class="fa fa-eye"></i> View</a>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <div class="form-group mx-1">
                                                <a class="btn btn-info btn-sm text-dark button-size text-bold" href="../includes/vendor.crud.php?done_reserve=<?php echo $reservation_date; ?>" role="button"><i class="fa fa-check"></i> Done</a>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <div class="form-group mx-1">
                                                <a class="btn btn-danger btn-sm text-dark cancel button-size text-bold" href="../includes/vendor.crud.php?cancel_reserve=<?php echo $reservation_date; ?>" role="button"><i class="fa fa-times"></i> Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            <?php } elseif ($reserve_status == '5') { ?>
                                <td>
                                    <form action="" method="post">
                                        <div class="btn-group">
                                            <div class="form-group mx-1">
                                                <a class="btn btn-secondary btn-sm text-dark button-size text-bold" href="vendor_customer_reserve_view.php?view_reserve=<?php echo $reservation_date; ?>&stall_ID=<?php echo $stall_ID; ?>" role="button"><i class="fa fa-eye"></i> View</a>
                                            </div>
                                        </div>
                                </td>
                            <?php } else { ?>

                            <?php } ?>
                        </tr>
                    <?php
                    }
                    ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>