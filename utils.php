<?php
include "inc/cu.common.php";


// Update product images in db
$q = "SELECT * FROM product";
$r = sql_query($q);

$q5 = "TRUNCATE TABLE product_stock";
echo $q5.";<br/>";
while ($row = sql_fetch_assoc($r)) {
	$pname = GetUrlName($row['productName']);
	$q1 = "UPDATE product set productImg='$pname.jpg' WHERE id = '".$row['id']."'; ";
	//echo $q1.';<br/>';

	$q2 = "UPDATE product set productPrice='".rand(300,1000)."' WHERE id = '".$row['id']."'; ";
	// echo $q2.';<br/>';

	$q3 = "INSERT INTO product_stock(fkProductId, fkVendorId, qtyOnHand, newQty, totalQty, dateOfPruch, status) VALUES ('".$row['id']."', 1, 0, 10, 10, '".TODAY."', 'A')";
	echo $q3.';<br/>';
}

$q4 = "UPDATE product set productQty = 10";
echo $q4.';<br/>';
// 
?>