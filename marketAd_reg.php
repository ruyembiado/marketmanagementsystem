<?php

@include 'config.php';
@include 'includes/index.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="col-md-7 p-5 mb-4 mt-4 text-dark rounded" style="background-color: #708D81;">
        <div class="col-md-12 m-auto">
            <div class="d-flex align-items-center justify-content-center">
                <img class="img-fluid logo-user me-3" src="img/user-logo.png" style="height: 20%; width: 20%" />
                <p class="text-center" style="color: #001427; font-size:20px;">Register as Market Admin</p>
            </div>
        </div>
        <form action="includes/register.php" method="post">
            <div class="d-flex flex-row justify-content-evenly">
                <div class="col-md-6 mb-2 me-1">
                    <label class="" style="color: #001427;">Name:</label>
                    <input class="form-control text-dark" type="text" name="name" required placeholder="Enter your name">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="" style="color: #001427;">Contact:</label>
                    <input class="form-control text-dark" type="text" name="contact" required placeholder="Enter your contact" value="">
                </div>
            </div>
            <div class="d-flex flex-row justify-content-evenly">
                <div class="col-md-12 mb-2">
                    <?php
                    $query = "SELECT * FROM market WHERE market_status='0' ORDER BY market_name ASC";
                    $result = mysqli_query($conn, $query);
                    ?>
                    <label class="" style="color: #001427;">Market:</label>
                    <select class="col-sm-12 form-select text-dark" name="market_ID">
                        <?php if (mysqli_num_rows($result) > 0) { ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <?php
                                $market_ID = $row['market_ID'];
                                $market_name = $row['market_name'];
                                ?>
                                <option value="<?php echo $market_ID; ?>"><?php echo $market_name; ?></option>
                            <?php } ?>
                        <?php } else { ?>
                            <option value="0">No market available</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-evenly">
                <div class="col-md-6 mb-2 me-1">
                    <label class="" style="color: #001427;">Username:</label>
                    <input class="form-control text-dark" type="text" name="username" required placeholder="Enter your username" value="">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="" style="color: #001427;">Email:</label>
                    <input class="form-control text-dark" type="email" name="email" required placeholder="Enter your email" value="">
                </div>
            </div>
            <div class="d-flex flex-row justify-content-evenly">
                <div class="col-md-6 me-1 mb-2">
                    <label class="" style="color: #001427;">Password:</label>
                    <input class="form-control text-dark" type="password" name="password" required placeholder="Enter your password">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="" style="color: #001427;">Confirm Password:</label>
                    <input class="form-control text-dark" type="password" name="cpassword" required placeholder="Confirm your password">
                </div>
            </div>
            <div class="mb-3">
                <div class="row m-auto">
                    <input class="btn btn-primary text-light" type="submit" name="marketAd_reg" value="Register">
                </div>
            </div>
        </form>
    </div>
</div>

<?php

@include 'includes/index.footer.php';

?>