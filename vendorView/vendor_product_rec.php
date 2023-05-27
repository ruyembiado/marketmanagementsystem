<?php

@include '../includes/vendor.header.php';

?>
<?php
if (isset($_GET['manage_stall'])) {
    $stall_ID = $_GET['manage_stall'];
}
?>
<div class="d-flex justify-content-between mx-auto">
    <div class="form-group">
        <div class="btn-group">
            <a class="btn btn-primary btn-sm text-light float-start button-size mb-2 ms-5 mt-3" href="vendor_product_add.php?add_product=<?php echo $stall_ID; ?>" role="button"><i class="fa fa-plus"></i> Add
                Product</a>
        </div>
    </div>
    <div class="form-group">
        <div class="btn-group">
            <a class="btn btn-primary text-light mb-2 me-5 mt-3 button-size" href="vendor_stall.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>
<div class="row justify-content-center mx-0">
    <div class="col-md-11 p-4 table-responsive-sm text-dark text-center mt-2 mb-3 rounded" style="background-color: #708D81;">
        <h5 class="text-center" style="color: #001427;">Manage Products</h5>
        <table id="example" class="table table-striped account-table">

            <?php
            $stall_ID = $_GET['manage_stall'];
            $sql = "SELECT * FROM product, stall, vendor WHERE vendor.vendor_ID='$vendor_ID' AND stall.stall_ID='$stall_ID' AND product.stall_ID=stall.stall_ID ORDER BY product_category, product_name ASC";
            ?>
            <thead>
                <tr style="background-color: #F4D58D;">
                    <th style="display:none"></th>
                    <th style="display:none"></th>
                    <th style="color: #001427;">Product Name</th>
                    <th style="color: #001427;">Product</th>
                    <th style="color: #001427;">Product Category</th>
                    <th style="color: #001427;">Product Price</th>
                    <th style="color: #001427;">Status</th>
                    <th style="color: #001427;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $stall_ID = $row['stall_ID'];
                        $product_ID = $row['product_ID'];
                        $path = $row['product_img'];
                        $product_name = $row['product_name'];
                        $product_category = $row['product_category'];
                        $product_price = $row['product_price'];
                        $product_unit = $row['product_unit'];
                        $product_status = $row['product_status'];
                ?>
                        <tr>
                            <td style="display:none" class="text-dark"><?php echo $stall_ID; ?></td>
                            <td style="display:none" class="text-dark"><?php echo $product_ID; ?></td>
                            <td class="text-start" style="color: #001427;"><?php echo $product_name; ?></td>
                            <td><?php echo "<img src='{$row['product_img']}' width='80px' height='80px'</img>" ?></td>
                            <td class="text-start" style="color: #001427;"><?php echo $product_category; ?></td>
                            <td style="color: #001427;">₱ <?php echo $product_price; ?> / <?php echo $product_unit; ?></td>
                            <td>
                                <a class="text-decoration-none" href="../includes/vendor.crud.php?product_status=<?php echo $product_ID; ?>&stall_ID=<?php echo $stall_ID; ?>"><?php if ($product_status == '1') { ?>
                                        <div class="form-group mx-0">
                                            <div class="btn btn-success btn-sm text-light button-size"><i class="fa fa-refresh"></i> Available</div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group mx-0">
                                            <div class="btn btn-danger btn-sm text-light button-size"><i class="fa fa-refresh"></i> Not Available</div>
                                        </div>
                                    <?php } ?>
                                </a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="form-group mx-0">
                                        <a class="btn btn-warning text-light button-size btn-sm rounded" href="vendor_product_edit.php?edit_product=<?php echo $product_ID; ?>&stall_ID=<?php echo $stall_ID; ?>" role="button"><i class="fa fa-edit"></i> Update</a>
                                    </div>
                                    <div class="form-group mx-1">
                                        <a class="btn btn-danger btn-sm text-light delete button-size rounded" href="../includes/vendor.crud.php?delete_product=<?php echo $product_ID; ?>&stall_ID=<?php echo $stall_ID; ?>" role="button"><i class="fa fa-trash text-light"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>