<?php

@include '../includes/admin.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size px-4" href="admin_customer_acc.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
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
                        <p class="text-center mb-0" style="font-size: 20px; color: #001427;">Add Customer</h5>
                    </label>
                </div>
                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 mb-2 me-1">
                        <label style="color: #001427;" class="text-size">Name:</label>
                        <input class="form-control text-dark" type="text" name="name" required placeholder="Enter your name" value="">
                    </div>
                    <div class="form-group mb-2">
                        <label style="color: #001427;" class="text-size">Contact:</label>
                        <input class="form-control text-dark" type="text" name="contact" required placeholder="Enter your contact" value="">
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 mb-2 me-1">
                        <label style="color: #001427;" class="text-size">Username:</label>
                        <input class="form-control text-dark" type="text" name="username" required placeholder="Enter your username" value="">
                    </div>
                    <div class="form-group mb-2">
                        <label style="color: #001427;" class="text-size">Email:</label>
                        <input class="form-control text-dark" type="email" name="email" required placeholder="Enter your email" value="">
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-evenly">
                    <div class="col-md-6 mb-2 me-1">
                        <label style="color: #001427;" class="text-size">Password:</label>
                        <input class="form-control text-dark" type="password" name="password" required placeholder="Enter your password" value="">
                    </div>
                    <div class="form-group mb-2">
                        <label style="color: #001427;" class="text-size">Confirm Password:</label>
                        <input class="form-control text-dark" type="password" name="cpassword" required placeholder="Confirm your password" value="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="row m-auto">
                        <input class=" button-size btn btn-primary text-light" type="submit" name="customer_add" value="Register">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>