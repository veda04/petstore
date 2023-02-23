<?php
 include './inc/cu.common.php';
	if (isset($_GET['id'])) {
		$uid=$_GET['id'];
	}
	//getting total items and total price of all items
	$total_price=0;
	$q = "SELECT * FROM customer_cart";
	$r = sql_query($q);
	$invoice_number = mt_rand();
	$status = 'pending';
	$method = 'COD';
	$c = sql_num_rows($q);
	while ($row == msql_fetch_object($r)) {
		$product_id=$row['ProductId'];
		$p="SELECT * FROM product WHERE id='$product_id'";
		$r1=sql_query($q);
		while ($row_product==sql_fetch_assoc($r1)) {
			$price=array($row_product['productPrice']);
			$value=array_sum($price);	
			$total_price+=$value;
		}
	}

	//getting quantity from cart
	$get_cart="SELECT * FROM customer_cart";
	$result=sql_query($get_cart);
	$get_qty=sql_fetch_assoc($result);
	$qty=$get_qty['quantity'];
	if ($qty==0) {
		$qty=1;
		$subtotal=$total_price;
	}else{
		$qty=$qty;
		$subtotal=$total_price*$qty;
	}

	$insert_order="INSERT INTO oders (CustomerId,invoiceNumber,orderDate,totalAmount,paymentMethod,status) values ($uid,$invoice_number,curdate(),$subtotal,$method,$status)";
	$result_q=sql_query($insert_order);
	if ($result_q) {
		echo "<script>alert('Orders are submitted successfully')</script>";
		echo "<script>window.open('index.php','_self')</script>";
	}else{

	}
?>
