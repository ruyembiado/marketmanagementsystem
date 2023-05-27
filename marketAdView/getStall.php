<?php
session_start();
$ma_ID = $_SESSION['market_admin_ID'];
include_once '../config.php';

if(isset($_GET['normal'])) :
$sql1 = "SELECT * FROM stall, vendor WHERE stall_status='1' AND stall.market_admin_ID='$ma_ID' AND vendor.vendor_ID=stall.vendor_ID";
$result_stall = mysqli_query($conn, $sql1);
endif;
if(isset($_GET['search'])) :
    $search = $_GET['stallSearch'];
    $sql1 = "SELECT * FROM stall, vendor WHERE stall_status='1' AND stall.market_admin_ID='$ma_ID' AND vendor.vendor_ID=stall.vendor_ID AND stall.stall_name LIKE '%" . $search . "%'";
    $result_stall = mysqli_query($conn, $sql1);
endif;

?>
<?php if (mysqli_num_rows($result_stall) > 0) { ?>
    <?php while ($row = mysqli_fetch_assoc($result_stall)) { ?>
        <?php
        $stall_ID = $row['stall_ID'];
        $stall_name = $row['stall_name'];
        $vendor_ID = $row['vendor_ID'];
        $vendor_name = $row['name'];
        ?>
        <option value="<?php echo $stall_ID; ?>"><?php echo $stall_name; ?> -
            <?php echo $vendor_name; ?></option>
    <?php } ?>
<?php } else { ?>
    <option value="0">No stall available</option>
<?php }
?>