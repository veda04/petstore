<?php
include "inc/cu.common.php";


// Update product images in db
$q = "SELECT * FROM product";
$r = sql_query($q);
while ($row = sql_fetch_assoc($r)) {
	$pname = GetUrlName($row['productName']);
	$q1 = "UPDATE product set productImg='$pname.jpg' WHERE id = '".$row['id']."'; ";
	echo $q1.'<br/>';
}

// 
?>