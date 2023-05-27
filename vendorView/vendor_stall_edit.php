<?php

@include '../includes/vendor.header.php';

?>

<div class="container-fluid pt-2 px-2">
    <div class="row bg-dark justify-content-center mx-0" style="height: 580px; overflow-x: hidden; overflow-y: auto;">
        <div class="form-group">
            <div class="btn-group p-2">
                <a class="btn btn-warning text-dark" href="vendor_stall.php" role="button">Back</a>
            </div>
        </div>
        <div class="col-md-4 w-40 p-5 mb-5 align-items-center justify-content-center bg-light text-dark rounded">

            <form action="../includes/vendor.crud.php" method="post">
                <div class="bg-light text-dark">
                    <div class="form-group row">
                        <label>
                            <h4 class="text-dark mb-3 text-center">Update Stall</h4>
                        </label>
                    </div>

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

                    <?php 
                    $stall_ID = $_GET['edit_stall'];
                    $sql = "SELECT * FROM stall WHERE stall_ID ='$stall_ID'";
                    $result2 = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result2)){
                        $stall_ID = $row['stall_ID'];
                        $stall_name = $row['stall_name'];
                    }
                    ?>

                    <div class="form-group row mx-5">
                        <label class="text-dark ">Stall Name:</label>
                        <div class="col-sm-12 mb-3">
                            <input class="form-control text-dark" type="text" name="name" required
                                placeholder="Enter your market name" value="<?php echo $stall_name;?>">
                        </div>
                    </div>

                    <div class="form-group mx-5">
                        <div class="btn-group p-2">
                            <input type="hidden" name="stall_ID" value="<?php echo $stall_ID;?>" />
                            <input class="form-control bg-warning text-dark" type="submit" name="update_stall"
                                value="Update">
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