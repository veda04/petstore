<?php
include "inc/cu.common.php";
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit;

if(!$cust_logged || !isset($sess_cust_id) || !is_numeric($sess_cust_id)) {
	ForceOutCu(3);
}

$redirect = false;
$rdaddress = isset($_POST['rdaddress']) ? $_POST['rdaddress'] : "";
$shipping_address = GetXFromYID("SELECT address FROM customer_address WHERE id = $rdaddress");

// lock tables
sql_query("LOCK TABLE orders WRITE");
sql_query("LOCK TABLE order_item WRITE");
sql_query("LOCK TABLE order_status WRITE");
sql_query("LOCK TABLE customer WRITE");
sql_query("LOCK TABLE customer_cart WRITE");
sql_query("LOCK TABLE customer_address WRITE");

$ordid = NextId("id", "orders");
$q = "INSERT INTO orders(id, fkCustomerId, orderType, orderDate, totalAmount, shippingAddress, paymentMethod, status) VALUES ($ordid, 'ORD', '".TODAY."', '$shipping_address', 'COD')";
$r = sql_query($q);

if(sql_affected_rows($r)) {
	$ord_i = NextId("id", "order_item");
	$q1 = "INSERT INTO order_item(id, fkOrderId, fkProductId, unitPrice, itemQuantity, totalPrice) SELECT  $ord_i, $ordid, c.fkProductId, p.productPrice, c.qty, (p.productPrice * c.qty) FROM customer_cart c left join product p on c.fkProductId = p.id WHERE fkCustomerId = $sess_cust_id";
	$r1 = sql_query($q1);

	if(sql_affected_rows($r1)) {
		$q2 = "UPDATE orders SET totalAmount = (SELECT SUM(totalPrice) FROM order_item WHERE fkOrderId = $ordid ) WHERE id = $ordid ";
		$r2 = sql_query($q2);

		$redirect = true;
	}
}
// unlock tables
sql_query("UNLOCK TABLES");

if($redirect) {
	header("location: order-success.php");
	exit;
}
else {
	ForceOutCu(3);
	exit;
}
?>