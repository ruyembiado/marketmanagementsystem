<?php

@include '../includes/customer.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-11 p-4 text-center text-dark mt-3 mb-3 rounded" style="background-color: #708D81;">
        <h2 class="" style="color: #001427;">CART</h2>
        <div class="top-head d-flex align-items-center justify-content-center">
            <div class="col-md-2" style="color: #001427;">Product</div>
            <div class="col-md-2" style="color: #001427;"></div>
            <div class="col-md-2" style="color: #001427;">Price per unit</div>
            <div class="col-md-2" style="color: #001427;">Quantity</div>
            <div class="col-md-2" style="color: #001427;">Total Price</div>
            <div class="col-md-2" style="color: #001427;">Action</div>
        </div>
        <?php

        $sql2 = "SELECT ROUND(SUM(reservation.quantity * product.product_price), 2) as grand_total FROM reservation, product WHERE reservation.product_ID=product.product_ID AND reservation.customer_ID = '$customer_ID' AND reserve_status='0'";
        $result = mysqli_query($conn, $sql2);
        $total = mysqli_fetch_array($result);

        $sql = "SELECT DISTINCT stall.stall_name, stall.stall_ID FROM reservation, stall, product WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.customer_ID='$customer_ID' AND reserve_status='0'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result)) {

            while ($row = mysqli_fetch_assoc($result)) {
                $stall_name = $row['stall_name'];
                $stall_ID = $row['stall_ID'];
        ?>
                <div class="stall-cont p-2 mb-2 rounded" style="background-color: #001427;">
                    <h6 class="text-start rounded p-2 mb-2" style="background-color: #F4D58D; color: #001427;"><?php echo $stall_name; ?></h6>
                    <?php
                    $sql = "SELECT * FROM reservation, stall, product WHERE reservation.vendor_ID=stall.vendor_ID AND stall.stall_ID=product.stall_ID AND reservation.product_ID=product.product_ID AND reservation.customer_ID='$customer_ID' AND stall.stall_ID='$stall_ID' AND reserve_status='0' ORDER BY reservation_ID DESC";
                    $result2 = mysqli_query($conn, $sql);
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $stall_ID = $row2['stall_ID'];
                        $reservation_ID = $row2['reservation_ID'];
                        $product_img = $row2['product_img'];
                        $product_name = $row2['product_name'];
                        $product_price = $row2['product_price'];
                        $quantity = $row2['quantity'];
                        $product_unit = $row2['product_unit'];
                        $reserve_index = $row2['reserve_index'];
                    ?>
                        <div class="d-flex align-items-center rounded justify-content-between product-cont p-2 mb-1" style="background-color: #F4D58D; color: #001427;">
                            <img src="<?= $row2['product_img'] ?>" class="img-fluid" style="height: 100px; width: 100px;" alt="">
                            <p class="col-md-2 text-dark text-start"><?php echo $product_name; ?></p>
                            <p class="col-md-2 text-dark text-start">
                                ₱
                                <?php echo $product_price; ?>/
                                <?php echo $product_unit; ?>
                            </p>
                            <h6 class="col-md-2 text-light d-flex justify-content-center">
                                <form action="../includes/customer.crud.php" method="post">
                                    <div class="d-flex align-items-center">
                                        <input type="hidden" name="reservation_ID" value="<?php echo $reservation_ID; ?>">
                                        <div class="col-4 me-1">
                                            <input class="rounded form-control form-control-sm text-dark" type="number" name="quantity" min="1" step="1" value="<?php echo $quantity; ?>" />
                                        </div>
                                        <button class="btn btn-primary text-light button-size btn-sm" type="submit" name="update_qty"><i class="fa fa-edit"></i> Update</button>
                                    </div>
                                </form>
                            </h6>
                            <p class="col-md-2 text-dark">
                                ₱
                                <?php echo $product_price * $quantity; ?>
                            </p>
                            <p>
                            <form action="" method="post">
                                <div class="btn-group">
                                    <div class="form-group mx-1">
                                        <a class="btn btn-danger button-size text-light btn-sm delete" href="../includes/customer.crud.php?delete_cart=<?php echo $reservation_ID; ?>" role="button"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </form>
                            </p>
                        </div>
                    <?php } ?>
                </div>

            <?php } ?>
            <div class="col-md-12 checkout-cont mt-3 d-flex pt-2 align-items-center justify-content-end">
                <div class="col-md-4 p-2 d-flex align-items-center rounded" style="background-color: #F4D58D;">
                    <p style="color: #001427;" class="ms-4 me-2 mb-1">Grand Total</p>
                    <?php if ($total['grand_total']) { ?>
                        <p style="color: #001427;" class="me-5 mb-1">
                            ₱<?php echo $total['grand_total']; ?>
                        </p>
                    <?php } else {
                    } ?>

                    <?php if ($total['grand_total']) { ?>
                        <div class="form-group mx-1 me-4">
                            <form action="../includes/customer.crud.php" method="post">
                                <input type="hidden" name="reserve_status" value="<?php echo $reserve_status; ?>">
                                <input type="hidden" name="customer_ID" value="<?php echo $customer_ID; ?>">
                                <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID; ?>">
                                <input type="hidden" name="stall_ID" value="<?php echo $stall_ID; ?>">
                                <button class="btn btn-primary text-light button-size btn-sm" type="submit" name="checkout"><i class="fa fa-money"></i> Checkout</button>
                            </form>
                        </div>
                    <?php } else {
                    } ?>
                </div>
            </div>
        <?php } else { ?>
            <p class="mt-3" style="color: #001427;">No data found</p>
        <?php } ?>

    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>