<?php

@include '../includes/customer.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 p-4 text-center bg-dark text-dark mt-3 mb-3 rounded" style="height:589px; overflow-y:auto">
        <h5 class="text-white">Cart</h5>
        <!-- <div class="form-group row text-center">
            <?php if (isset($_GET['error'])) { ?>
                <p class="text-danger"><?php echo $_GET['error']; ?></p>
            <?php } ?>
        </div> -->
        <table id="example" class="table table-striped bg-dark account-table account-table-sm">
            <thead>
                <tr class="bg-warning">
                    <th style="display:none">Reservation ID</th>
                    <th class="text-dark">Stall Name</th>
                    <th class="text-dark">Product Name</th>
                    <th class="text-dark">Product Price</th>
                    <th class="text-dark">Quantity</th>
                    <th class="text-dark">Total Price</th>
                    <th class="text-dark">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM reservation, stall, product WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.customer_ID='$customer_ID' AND reserve_status='0' GROUP BY product.product_ID";

                $sql2 = "SELECT ROUND(SUM(reservation.quantity * product.product_price), 2) as grand_total FROM reservation, product WHERE reservation.product_ID=product.product_ID AND reservation.customer_ID = '$customer_ID' AND reserve_status='0'";
                $result = mysqli_query($conn, $sql2);
                $total = mysqli_fetch_array($result);

                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        $reservation_ID = $row['reservation_ID'];
                        $stall_ID = $row['stall_ID'];
                        $vendor_ID = $row['vendor_ID'];
                        $stall_name = $row['stall_name'];
                        $product_name = $row['product_name'];
                        $product_price = $row['product_price'];
                        $quantity = $row['quantity'];
                        $reserve_status = $row['reserve_status'];
                        $product_unit = $row['product_unit'];
                        $reservation_date = $row['reservation_date'];
                        // $reserve_index = $row['reserve_index'];
                ?>

                        <tr>
                            <td style="display:none" class="text-dark">
                                <?php echo $reservation_ID; ?>
                            </td>
                            <td class="text-light"><a class="text-warning" href="customer_store_view.php?view_stall=<?php echo $stall_ID; ?>" role="button">
                                    <h6 class="text-success">
                                        <?php echo $stall_name; ?>
                                    </h6>
                                </a></td>
                            <td class="text-light">
                                <?php echo $product_name; ?>
                            </td>
                            <td class="text-light">₱
                                <?php echo $product_price; ?>/
                                <?php echo $product_unit; ?>
                            </td>
                            <td class="text-light d-flex justify-content-center">
                                <form action="../includes/customer.crud.php" method="post">
                                    <div class="d-flex align-items-center">
                                        <input type="hidden" name="reservation_ID" value="<?php echo $reservation_ID; ?>">
                                        <div class="col-4 co me-1">
                                            <input class="rounded form-control form-control-sm text-dark" type="number" name="quantity" min="1" step="1" value="<?php echo $quantity; ?>" />
                                        </div>
                                        <button class="btn btn-warning button-size text-bold btn-sm" type="submit" name="update_qty"><i class="fa fa-edit"></i> Update</button>
                                    </div>
                                </form>
                            </td>
                            <td class="text-light">₱
                                <?php echo $product_price * $quantity; ?>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="btn-group">
                                        <div class="form-group mx-1">
                                            <a class="btn btn-danger button-size text-bold text-dark btn-sm delete" href="../includes/customer.crud.php?delete_cart=<?php echo $reservation_ID; ?>" role="button"><i class="fa fa-trash"></i> Remove</a>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php } else { ?>
                    <?php echo "<tr><td class='text-white' colspan='6'>No data found.</td></tr>"; ?>
                <?php
                }
                ?>
                <th class="text-light bg-dark colspan='1'">Grand Total</th>
                <?php if ($total['grand_total']) { ?>
                    <td class="text-light">₱
                        <?php echo $total['grand_total']; ?>
                    </td>
                <?php } else {
                } ?>
                <td>
                    <?php if ($total['grand_total']) { ?>
                        <div class="form-group mx-1">
                            <form action="../includes/customer.crud.php" method="post">
                                <input type="hidden" name="reserve_status" value="<?php echo $reserve_status; ?>">
                                <input type="hidden" name="customer_ID" value="<?php echo $customer_ID; ?>">
                                <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID; ?>">
                                <input type="hidden" name="stall_ID" value="<?php echo $stall_ID; ?>">
                                <button class="btn btn-warning text-dark button-size text-bold btn-sm" type="submit" name="checkout"><i class="fa fa-money"></i> Checkout</button>
                            </form>
                        </div>
                    <?php } else {
                    } ?>
                </td>
            </tbody>
        </table>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>