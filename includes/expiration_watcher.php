<?php

include '../config.php';

$query_all = "SELECT * FROM reservation WHERE reserve_status='4'";
$query3 = mysqli_query($conn, $query_all);

while ($row = mysqli_fetch_assoc($query3)) :
    if (date('Y-m-d H:i:s', strtotime($row['reservation_expdate'])) <= date('Y-m-d H:i:s')) :
        $reservation_date = $row['reservation_date'];
        $query4 = "UPDATE reservation SET reserve_status ='5' WHERE reservation_date= '$reservation_date'";
        mysqli_query($conn, $query4);
    endif;
endwhile;

?>
