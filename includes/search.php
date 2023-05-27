<?php
//Customer Search
$search = $_GET['search'];
$search1 = htmlspecialchars($search);
if (isset($_GET['search'])) {

	if (strlen($search1)) {

		$product_results = "SELECT * FROM product, vendor, stall WHERE product.stall_ID=stall.stall_ID AND stall.vendor_ID=vendor.vendor_ID AND stall_status='2' AND product_status='1' AND product_name LIKE '%" . $search1 . "%'";

		// OR product_category LIKE '%".$search1."%'

		$market_results = "SELECT * FROM market WHERE market_status='1' AND market_name LIKE '%" . $search1 . "%'";
		$stall_results = "SELECT DISTINCT stall.stall_ID, stall.stall_name, map.map_ID FROM stall, vendor, map WHERE map.map_ID=stall.map_ID AND vendor.vendor_ID=stall.vendor_ID AND stall_status='2' AND stall_name LIKE '%" . $search1 . "%'";

		$result = mysqli_query($conn, $product_results);
		$result2 = mysqli_query($conn, $market_results);
		$result3 = mysqli_query($conn, $stall_results);
	} else {

		header("Location: ../customerView/customer_page.php?error=Empty search. Please enter a keyword.");
		exit();
	}
} else {

	$raw_results1 = "SELECT * FROM product, vendor, stall WHERE product.stall_ID=stall.stall_ID AND stall.vendor_ID=vendor.vendor_ID AND stall_status='2' AND product_status='1'";
	$result = mysqli_query($conn, $raw_results1);
	
}
