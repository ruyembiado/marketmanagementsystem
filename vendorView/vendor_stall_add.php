<?php

@include '../includes/vendor.header.php';

?>

<div class="container-fluid pt-2 px-2">
    <div class="row bg-dark justify-content-center mx-0" style="height: 580px; overflow-x: hidden; overflow-y: auto;">
        <div class="form-group mx-5">
            <div class="btn-group p-2">
                <a class="btn btn-warning text-dark" href="vendor_stall.php" role="button">Back</a>
            </div>
        </div>
        <div class="col-md-4 w-40 p-5 mb-5 mt-5 bg-light text-dark rounded">

            <form action="../includes/vendor.crud.php" method="post">
                <div class="bg-light text-dark">
                    <div class="form-group row">
                        <label>
                            <h4 class="text-dark mb-3 text-center">Create Stall</h4>
                        </label>
                    </div>

                    <div class="form-group row mx-5">
                        <label class="text-dark ">Stall Name:</label>
                        <div class="col-sm-12 mb-3">
                            <input class="form-control text-dark" type="text" name="stall_name" required
                                placeholder="Enter your stall name" value="">
                        </div>
                    </div>

                    <div class="form-group mx-5">
                        <?php 
                        $result = "SELECT *FROM vendor, market_admin WHERE market_admin.market_admin_ID=vendor.market_admin_ID AND vendor_ID='$vendor_ID'";
                        $ma = mysqli_query($conn, $result);
                        while($row = mysqli_fetch_assoc($ma)){
                            $market_admin_ID = $row['market_admin_ID'];
                        }
                        ?>
                        <div class="btn-group p-2">
                            <input type="hidden" name="vendor_ID" value="<?php echo $vendor_ID;?>" />
                            <input type="hidden" name="market_admin_ID" value="<?php echo $market_admin_ID;?>" />
                            <input class="form-control bg-warning text-dark" type="submit" name="add_stall"
                                value="Add">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>