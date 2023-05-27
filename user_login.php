<?php

@include 'config.php';
@include 'includes/index.header.php';

?>

<div class="row justify-content-center mx-0" style="height: 612px;">
    <div class="col-md-4 mb-5 mt-5 text-dark rounded p-5" style="background-color: #708D81;">
        <div class="col-md-4 m-auto">
            <img class="logo-user img-fluid" src="img/user-logo.png" style="height:110px" />
        </div>
        <p class="text-center" style="font-size: 20px; color: #001427;">Login to your Account</p>
        <form action="includes/login.php?" method="post">
            <div class="form-group mb-2">
                <label style="color: #001427;">Username:</label>
                <div class="d-flex">
                    <i class="fa fa-user position-absolute align-self-center ms-2 border-end border-secondary pe-1"></i>
                    <input class="login-form form-control text-dark" type="text" name="username" required placeholder="Enter your username" value="<?php if (isset($_GET['username'])) : echo $_GET['username'];
                                                                                                                                                    endif; ?>">
                </div>
            </div>
            <div class="form-group mb-2">
                <label style="color: #001427;">Password:</label>
                <div class="d-flex">
                    <i class="fa fa-lock position-absolute align-self-center ms-2 border-end border-secondary pe-1"></i>
                    <input class="login-form form-control text-dark" type="password" name="password" placeholder="Enter your password" required value="">
                </div>
            </div>
            <!-- <?php if (isset($_SESSION['cart'])) { ?>
                <input type="hidden" name="cart" value="<?php echo htmlspecialchars(serialize($_SESSION['cart'])); ?>">
            <?php } ?> -->
            <div class="form-group">
                <div class="row m-auto">
                    <input class="btn btn-primary text-light" type="submit" name="login_user" value="Login">
                </div>
            </div>
    </div>
    </form>
</div>


<?php

@include 'includes/index.footer.php';

?>