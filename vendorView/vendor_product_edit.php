<?php

@include '../includes/vendor.header.php';

?>
<?php $stall_ID = $_GET['stall_ID']; ?>

<div class="row justify-content-center mx-0">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size" href="vendor_product_rec.php?manage_stall=<?php echo $stall_ID; ?>" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="col-md-5 p-5 mb-5 align-items-center justify-content-center text-dark rounded" style="height: 540px; background-color: #708D81;">
        <form action="../includes/vendor.crud.php" method="post" enctype="multipart/form-data">
            <div class="text-light">
                <div class="form-group row">
                    <label>
                    <p class="text-center mb-0" style="font-size: 20px; color: #001427;">Update Product</h4>
                    </label>
                </div>

                <?php
                $product_ID = $_GET['edit_product'];
                $sql0 = "SELECT * FROM product WHERE product_ID ='$product_ID'";
                $result = mysqli_query($conn, $sql0);
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_ID = $row['product_ID'];
                    $product_name = $row['product_name'];
                    $path = $row['product_img'];
                    $product_price = $row['product_price'];
                    $product_unit = $row['product_unit'];
                    $product_category = $row['product_category'];
                }
                ?>

                <div class="form-group row">
                    <label style="color: #001427;" class="text-size">Product Name:</label>
                    <div class="col-sm-12 mb-2">
                        <input class="form-control text-dark" type="text" name="product_name" required placeholder="Enter your product name" value="<?php echo $product_name; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label style="color: #001427;" class="text-size">Product Image:</label>
                    <div class="col-sm-12 mb-2">
                        <input class="form-control text-dark" type="file" accept=".png, .jpg, .jpeg, .jfif" name="path" value="">
                        <input type="hidden" name="current_path" value="<?php echo $path; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="text-light">Product Category:</label>
                    <div class="col-sm-12 mb-0">
                        <select class="col-sm-12 mb-2 text-dark form-select" name="product_category">
                            <option value="">--Select Product Category--</option>
                            <option value="<?php echo $product_category; ?>" selected><?php echo $product_category; ?></option>
                            <option value="Beverages">Beverages</option>
                            <option value="Bread/Bakery">Bread/Bakery</option>
                            <option value="Canned/Jarred Goods">Canned/Jarred Goods</option>
                            <option value="Dairy">Dairy</option>
                            <option value="Dry/Baking Goods">Dry/Baking Goods</option>
                            <option value="Frozen Goods">Frozen Goods</option>
                            <option value="Snacks">Snacks</option>
                            <option value="Meat">Meat</option>
                            <option value="Fish">Fish</option>
                            <option value="Fruits/Vegetables">Fruits/Vegetables</option>
                            <option value="Cleaners">Cleaners</option>
                            <option value="Paper Goods">Paper Goods</option>
                            <option value="Personal Care">Personal Care</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
            </div>

            <div class="form-group row">
                <label style="color: #001427;" class="text-size">Product Unit:</label>
                <div class="col-sm-12 mb-0">
                    <select class="col-sm-12 mb-2 text-dark form-select" name="product_unit" value="">
                        <option value="">--Select Product Unit--</option>
                        <option value="<?php echo $product_unit; ?>" selected><?php echo $product_unit; ?></option>
                        <option value="Kilo">Kilogram</option>
                        <option value="Pc.">Piece</option>
                        <option value="L">Liter</option>ssss
                        <option value="Gallon">Gallon</option>
                        <option value="Pack">Pack</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label style="color: #001427;" class="text-size">Product Price:</label>
                <div class="col-sm-12 mb-2">
                    <input class="form-control text-dark" type="text" name="product_price" required placeholder="Enter your product price" value="<?php echo $product_price; ?>">
                </div>
            </div>
            <div class="form-group mb-5">
                <div class="row m-auto">
                    <input type="hidden" name="stall_ID" value="<?php echo $stall_ID; ?>" />
                    <input type="hidden" name="product_ID" value="<?php echo $product_ID; ?>" />
                    <input class="text-light text-size btn btn-primary" type="submit" name="update_product" value="Update">
                </div>
            </div>
    </div>
    </form>
</div>

<?php

@include '../includes/all.footer.php';

?>