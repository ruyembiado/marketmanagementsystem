<?php

@include '../includes/admin.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class=" form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size px-4" href="admin_vendor_acc.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="col-md-5 p-5 mb-5 mt-3 text-dark rounded" style="background-color: #708D81;">
        <div class="col-md-4 m-auto">
            <img class="logo-user img-fluid" src="../img/user-logo.png" style="height:123px" />
        </div>
        <form action="../includes/admin.crud.php" method="post">
            <div>
                <div class="form-group row">
                    <label>
                        <p class="text-center mb-0" style="font-size: 20px; color: #001427;">Add Vendor</h5>
                    </label>
                </div>
                <div class="form-group row text-center">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="text-danger"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                </div>
                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 me-1">
                        <label style=" color: #001427;" class="text-size">Name:</label>
                        <div class="col-sm-12 mb-2">
                            <input class="form-control text-dark" type="text" name="name" required placeholder="Enter your name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label style=" color: #001427;" class="text-size">Contact:</label>
                        <div class="col-sm-12 mb-2">
                            <input class="form-control text-dark" type="text" name="contact" required placeholder="Enter your contact" value="">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <?php
                    $query = "SELECT * FROM market, market_admin WHERE market_admin.market_ID=market.market_ID AND market.market_ID=market_admin.market_ID AND market_status='1' ORDER BY market_name ASC";
                    $result = mysqli_query($conn, $query);
                    ?>
                    <label style=" color: #001427;" class="text-size">Market:</label>
                    <select class="mb-2 form-select  text-dark" name="market_admin_ID">
                        <?php if (mysqli_num_rows($result) > 0) { ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <?php
                                $market_admin_ID = $row['market_admin_ID'];
                                $market_name = $row['market_name'];
                                ?>
                                <option value="<?php echo $market_admin_ID; ?>"><?php echo $market_name; ?>
                                <?php } ?>
                            <?php } else { ?>
                                <option value="0">No market registered</option>
                            <?php } ?>
                    </select>
                </div>

                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 me-1">
                        <label style=" color: #001427;" class="text-size">Username:</label>
                        <div class="col-sm-12 mb-2">
                            <input class="form-control text-dark" type="text" name="username" required placeholder="Enter your username" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label style=" color: #001427;" class="text-size">Email:</label>
                        <div class="col-sm-12 mb-2">
                            <input class="form-control text-dark" type="email" name="email" required placeholder="Enter your email" value="">
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 me-1">
                        <label style=" color: #001427;" class="text-size">Password:</label>
                        <div class="col-sm-12 mb-2">
                            <input class="form-control text-dark" type="password" name="password" required placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label style=" color: #001427;" class="text-size">Confirm Password:</label>
                        <div class="col-sm-12 mb-2">
                            <input class="form-control text-dark" type="password" name="cpassword" required placeholder="Confirm your password">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row m-auto">
                        <input class="btn btn-primary text-light button-size" type="submit" name="vendor_add" value="Register">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>