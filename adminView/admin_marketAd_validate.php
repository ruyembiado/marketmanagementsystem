<?php

@include '../includes/admin.header.php';

?>

<div class="row justify-content-center mx-0" style="height: 700px">
    <div class="col-md-11 table-responsive-sm p-5 pt-4 text-center mt-3 mb-3 rounded" style="background-color: #708D81;">
        <h5 style="color: #001427;">Manage Market Admin Registration</h5>
        <table id="example" class="table table-striped account-table">
            <thead>
                <tr style="background-color: #F4D58D;">
                    <th style="color: #001427;">No.</th>
                    <th style="color: #001427;">Market</th>
                    <th style="color: #001427;">Name</th>
                    <th style="color: #001427;">Contact</th>
                    <th style="color: #001427;">Username</th>
                    <th style="color: #001427;">Email</th>
                    <th style="color: #001427;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $sql = "SELECT * FROM market, market_admin WHERE market.market_ID=market_admin.market_ID AND market_admin_status='0' ORDER BY market_admin_ID ASC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $market_admin_ID = $row['market_admin_ID'];
                        $market_ID = $row['market_ID'];
                        $name = $row['name'];
                        $contact = $row['contact'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $market_admin_status = $row['market_admin_status'];
                        $market_name = $row['market_name'];
                ?>

                        <tr>
                            <td style="color: #001427;">
                                <?php
                                $i++; // increment $i by 1
                                echo $i; // Output: 2
                                ?>
                            </td>
                            <td class="text-start" style="color: #001427;">
                                <?php echo $market_name; ?>
                                </td>
                            <td class="text-start" style="color: #001427;">
                                <?php echo $name; ?>
                                </td>
                            <td class="text-start" style="color: #001427;">
                                <?php echo $contact; ?>
                                </td>
                            <td class="text-start" style="color: #001427;">
                                <?php echo $username; ?>
                                </td>
                            <td class="text-start" style="color: #001427;">
                                <?php echo $email; ?>
                                </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <form action="../includes/admin.crud.php " method="post">
                                        <div class="btn-group">
                                            <input type="hidden" name="market_admin_ID" value="<?php echo $market_admin_ID; ?>" />
                                            <input type="hidden" name="market_ID" value="<?php echo $market_ID; ?>" />
                                            <button class="btn btn-success btn-sm text-light button-size rounded bg-gradient me-3" type="submit" name="approve_marketAd" value="Approve"><i class="fa fa-check"></i>
                                                Approve</button>
                                        </div>
                                    </form>
                                    <form action="" method="">
                                        <div class="btn-group">
                                            <a class="btn btn-danger btn-sm text-light button-size reject rounded bg-gradient" role="button" href="../includes/admin.crud.php?deny_marketAd=<?php echo $market_admin_ID; ?>"><i class="fa fa-close"></i>
                                                Reject</a>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        <?php
                    }
                        ?>
                    <?php }
                    ?>
                        </tr>
            </tbody>
        </table>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>