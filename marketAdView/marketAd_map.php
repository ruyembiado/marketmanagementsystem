<?php

@include '../includes/marketAd.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="form-group">
        <div class="btn-group">
            <a class="btn btn-primary btn-sm text-light float-start button-size mb-2 ms-5 mt-3" href="marketAd_map_add.php" role="button"><i class="fa fa-plus-circle"></i> Add Map</a>
        </div>
    </div>
    <div class="col-md-11 p-4 text-center text-dark mt-2 mb-3 rounded table-responsive-sm vh-100" style="background-color: #708D81;">
        <h5 style="color: #001427;">Manage Market Maps</h5>
        <table id="example" class="table table-striped account-table">
            <thead>
            <tr style="background-color: #F4D58D;">
                    <th style="display:none">Map ID</th>
                    <th style="display:none">Market ID</th>
                    <th style="color: #001427;" class=" text-start">Market</th>
                    <th style="color: #001427;" class=" text-start">Map</th>
                    <th style="color: #001427;" class=" text-start">Floor</th>
                    <th style="color: #001427;" class="">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM map, market WHERE market_admin_ID='$ma_ID' AND market.market_ID=map.market_ID ORDER BY map_name ASC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $map_ID = $row['map_ID'];
                        $market_ID = $row['market_ID'];
                        $market_name = $row['market_name'];
                        // $path = $row['path'];
                        $map_floor = $row['map_floor'];
                ?>
                        <tr>
                            <td style="display:none" class="text-light">
                                <?php echo $map_ID; ?>
                            </td>
                            <td style="display:none" class="text-light">
                                <?php echo $market_ID; ?>
                            </td>
                            <td class="text-start" style="color: #001427;">
                                <?php echo $market_name; ?>
                            </td>
                            <td class="text-start">
                                <?php echo "<img src='{$row['map_img']}' width='100px' height='100px'</img>" ?>
                            </td>
                            <td class="text-start" style="color: #001427;">
                                <?php echo $map_floor; ?>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary text-light button-size btn-sm rounded px-3" href="marketAd_map_view.php?map_view=<?php echo $map_ID; ?>" role="button"><i class="fa fa-eye"></i> View</a>
                                <a class="btn btn-warning text-light button-size btn-sm rounded" href="marketAd_map_edit.php?edit_map=<?php echo $map_ID; ?>" role="button"><i class="fa fa-edit"></i> Update</a>
                                <a class="btn btn-danger text-light button-size btn-sm rounded px-3 delete" href="../includes/marketAd.crud.php?delete_map=<?php echo $map_ID; ?>" role="button"><i class="fa fa-trash"></i> Delete</a>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

@include '../includes/all.footer.php';

?>