<?php

@include '../includes/customer.header.php';

?>

<div class="row justify-content-center mx-0" style="height:608px">
    <div class="col-6 sm-profile h-80 w-75 p-3 text-center text-dark mt-3 mb-3 rounded" style="background-color: #708D81;">
        <?php
        $sql = "SELECT * FROM customer WHERE customer_ID='$customer_ID'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $customer_ID = $row['customer_ID'];
                $customer_name = $row['name'];
                $customer_user = $row['username'];
                $customer_contact = $row['contact'];
                $customer_email = $row['email'];
            }
        }
        ?>
        <div class="card-cont">
            <img src="https://www.ateneo.edu/sites/default/files/styles/large/public/2021-11/istockphoto-517998264-612x612.jpeg?itok=aMC1MRHJ" alt="Avatar" s style="width:30%">

            <div class="card-des mt-4">
                <h1 style="color: #001427; font-size: 25px;" class="">
                    <?php echo $customer_name; ?>
                </h1>
                <div class="text-start col-md-4 m-auto mt-4">
                    <p style="color: #001427;" class=" m-0">
                        Username:
                        <?php echo $customer_user; ?>
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                        <p style="color: #001427;" class=" m-0">
                            Email:
                            <?php echo $customer_email; ?>
                        </p>
                        <a href="customer_profile_edit.php?edit_customer=<?php echo $customer_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p style="color: #001427;" class=" m-0">
                            Contact:
                            <?php echo $customer_contact; ?>
                        </p>
                        <a href="customer_profile_edit.php?edit_customer=<?php echo $customer_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <p style="color: #001427;" class=" m-0">
                            Password: *************
                        </p>
                        <a href="customer_profile_edit.php?edit_customer=<?php echo $customer_ID; ?>"><i class="fa fa-edit" style="color: #001427;"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>