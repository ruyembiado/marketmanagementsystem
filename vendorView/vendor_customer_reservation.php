<?php

@include '../includes/vendor.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 p-4 text-center table-responsive-sm text-dark mt-3 mb-3 rounded" style="height: 589px; background-color: #708D81;">
        <div class="col-md-12 text-center mb-3">
            <h5 class="text-center" style="color: #001427;">Customer Reservation</h5>
        </div>
        <div class="d-flex align-items-center mb-2 float-end">
            <form action="vendor_customer_reservation.php" method="get">
                <label for="" style="color: #001427;">Filter from:</label>
                <input type="date" onchange="submit()" class="form-control-sm border-0 me-1" name="date_from" value="<?php echo $_GET['date_from']; ?>" max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">
                <!-- <label for="" class="me-1" style="color: #001427;">to:</label> -->
                <input type="hidden" class="form-control-sm me-1" name="date_to" value="<?php echo $_GET['date_to']; ?>">
            </form>
            <form action="vendor_customer_reservation.php" method="get">
                <!-- <label for="" class="me-1" style="color: #001427;">Filter from:</label> -->
                <input type="hidden" class="form-control-sm me-1" name="date_from" value="<?php echo $_GET['date_from']; ?>">
                <label for="" style="color: #001427;">to:</label>
                <input type="date" onchange="submit()" class="form-control-sm border-0 me-1" name="date_to" value="<?php echo $_GET['date_to']; ?>" min="<?php echo date('Y-m-d'); ?>">
            </form>
        </div>

        <table id="example" class="table table-striped account-table account-table-sm">
            <thead>
                <tr style="background-color: #F4D58D;">
                    <th style="color: #001427;">Reservation Date</th>
                    <th style="color: #001427;">Customer Name</th>
                    <th style="color: #001427;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_GET['date_from'] && $_GET['date_to']) {
                    $date_from = $_GET['date_from'];
                    $date_to = $_GET['date_to'];
                    $sql = "SELECT * 
                    FROM reservation, stall, product, customer
                    WHERE reservation.vendor_ID=stall.vendor_ID
                    AND customer.customer_ID=reservation.customer_ID
                    AND stall.stall_ID=product.stall_ID 
                    AND reservation.product_ID=product.product_ID 
                    AND reservation.vendor_ID='$vendor_ID' 
                    AND reservation.reserve_status <> 0 
                    AND reservation.reservation_date BETWEEN '$date_from' AND '$date_to' 
                    GROUP BY reservation.reservation_date 
                    ORDER BY reservation_date ASC";
                } else {
                    $sql = "SELECT * 
                    FROM reservation, stall, product, customer
                    WHERE reservation.vendor_ID=stall.vendor_ID
                    AND customer.customer_ID=reservation.customer_ID
                    AND stall.stall_ID=product.stall_ID 
                    AND reservation.product_ID=product.product_ID 
                    AND reservation.vendor_ID='$vendor_ID' 
                    AND reservation.reserve_status <> 0 
                    GROUP BY reservation.reservation_date 
                    ORDER BY reservation_date ASC";
                }

                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $reservation_ID = $row['reservation_ID'];
                    $reservation_date = $row['reservation_date'];
                    $name = $row['name'];
                ?>

                    <tr>
                        <td style="color: #001427;" class="text-start">
                            <?php
                            echo $readable_datetime = date('M d, Y h:i:s a', strtotime($reservation_date));
                            ?>
                        </td>
                        <td style="color: #001427;" class="text-start">
                            <?php
                            echo $name;
                            ?>
                        </td>
                        <td style="color: #001427;">
                            <a class="btn btn-primary text-light button-size" href="vendor_customer_reserve_view.php?view_reserve=<?php echo $reservation_date; ?>&status=all" role="button"><i class="fa fa-eye"></i> View</a>
                        </td>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>