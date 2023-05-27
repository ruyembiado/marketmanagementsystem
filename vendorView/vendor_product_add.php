<?php

@include '../includes/vendor.header.php';

?>
<?php $stall_ID = $_GET['add_product']; ?>

<div class="row justify-content-center mx-0">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size" href="vendor_product_rec.php?manage_stall=<?php echo $stall_ID; ?>" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="col-md-5 p-5 mb-5 align-items-center justify-content-center text-dark rounded" style="height: 560px; background-color: #708D81;">
        <form action="../includes/vendor.crud.php" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label>
                <p class="text-center mb-0" style="font-size: 20px; color: #001427;">Add Product</h4>
                </label>
            </div>

            <div class="form-group mb-2">
                <label style="color: #001427;" class="text-size">Product Name:</label>
                <input class="form-control text-dark" type="text" name="product_name" required placeholder="Enter your product name">
            </div>

            <div class="form-group mb-2">
                <label style="color: #001427;" class="text-size">Product Image:</label>
                <input class="form-control text-dark" type="file" accept=".png, .jpg, .jpeg, .jfif" name="path">
            </div>

            <div class="form-group mb-2">
                <label style="color: #001427;" class="text-size">Product Category:</label>
                <select class="col-sm-12 text-dark form-select" required name="product_category">
                    <option selected>--Select Product Category--</option>
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

            <div class="form-group mb-2">
                <label style="color: #001427;" class="text-size">Product Unit:</label>
                <select class="col-sm-12 text-dark form-select" required name="product_unit">
                    <option selected>--Select Product Unit--</option>
                    <option value="Kilo">Kilogram</option>
                    <option value="Pc.">Piece</option>
                    <option value="L">Liter</option>
                    <option value="Gallon">Gallon</option>
                    <option value="Pack">Pack</option>
                    <option value="Meter">Meter</option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label style="color: #001427;" class="text-size">Product Price:</label>
                <input class="form-control text-dark" type="text" name="product_price" required placeholder="Enter your product price">
            </div>

            <div class="form-group mb-5">
                <div class="row m-auto">
                    <input type="hidden" name="stall_ID" value="<?php echo $stall_ID; ?>" />
                    <input class="text-light text-size btn btn-primary" type="submit" name="add_product" value="Add">
                </div>
            </div>
        </form>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>