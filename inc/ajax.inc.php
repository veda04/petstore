<?php
include "cu.common.php";

$code = 0;
$message = "";
$response = array();
$req_mode = isset($_POST['mode']) ? $_POST['mode'] : "";

if($req_mode == "ADD_TO_WISHLIST") {
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";
	$prod_id = isset($_POST['pid']) ? $_POST['pid'] : "";


	if(!empty($cust_id) && is_numeric($cust_id) && !empty($prod_id) && is_numeric($prod_id)) {
		$exists = GetXFromYID("SELECT count(*) from customer_wishlist WHERE fkCustomerId = $cust_id and fkProductId = $prod_id");

		if(!$exists) {
			$nid = NextId("id","customer_wishlist");
			$q = "INSERT INTO customer_wishlist(id, fkCustomerId, fkProductId) VALUES ($nid, $cust_id, $prod_id)";
			$r = sql_query($q);

			if(sql_affected_rows($r)) {
				$code = 1;
				$message = "New Item added to wishlist";

				$_SESSION[CU_SESSION_ID]->cust_wishlist = getCount("customer_wishlist", "COUNT(*)", "and fkCustomerId = ".$cust_id);
			}
		}
		else {
			$code = 0;
			$message = "Item already in wishlist!";
		}
	}
	else {
		$code = 0;
		$message = "Something went wrong!";
	}
}
else if($req_mode == "ADD_TO_CART") {
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";
	$prod_id = isset($_POST['pid']) ? $_POST['pid'] : "";
	$qty = isset($_POST['qty']) ? $_POST['qty'] : 1;

	if(!empty($cust_id) && is_numeric($cust_id) && !empty($prod_id) && is_numeric($prod_id)) {
		$exists = GetXFromYID("SELECT count(*) from customer_cart WHERE fkCustomerId = $cust_id and fkProductId = $prod_id");

		if(!$exists) {
			$nid = NextId("id","customer_cart");
			$q = "INSERT INTO customer_cart(id, fkCustomerId, fkProductId, qty) VALUES ($nid, $cust_id, $prod_id, $qty)";
			$r = sql_query($q);

			if(sql_affected_rows($r)) {
				$code = 1;
				$message = "New Item added to cart";
			}
		}
		else {
			$q = "UPDATE customer_cart SET qty = (qty+1) WHERE fkCustomerId = $cust_id and fkProductId = $prod_id";
			$r = sql_query($q);
		}

		$_SESSION[CU_SESSION_ID]->cust_cart = getCount("customer_cart", "COUNT(*)", "and fkCustomerId = ".$cust_id);
		$_SESSION[CU_SESSION_ID]->cust_cart_total = GetXFromYID("SELECT SUM(p.productPrice) FROM customer_cart c left join product p on c.fkProductId=p.id WHERE fkCustomerId = $cust_id"); 
	}
	else {
		$code = 0;
		$message = "Something went wrong!";
	}
}
else if($req_mode == "VALIDATE_CUSTOMER") {
	$username = isset($_POST["username"]) ? $_POST["username"] : "";

	if(!empty($username)) {
		$exists = GetXFromYID("SELECT count(*) from customer WHERE userName = '$username' ");
		$code = ($exists == 0) ? 1 : 0;
		$message = ($exists == 0) ? "Valid username" : "Username already taken, choose another username!";

	}
}
else if($req_mode == "CHECKOUT_CART") {
	$err = 0;
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";

	if(is_numeric($cust_id) && !empty($cust_id)) {
		$q = "SELECT c.id, c.fkProductId, p.productName, c.qty, p.productPrice FROM customer_cart c left join product p on c.fkProductId = p.id WHERE c.fkCustomerId = $cust_id";
		$r = sql_query($q);

		if(sql_num_rows($r)) {
			while(list($id, $prod_id, $prod_name, $qty, $prod_price) = sql_fetch_row($r)) {
				if(empty($prod_id) || !is_numeric($prod_id)) {
					removeFromCart($id);
					$err ++;
				}
				if(empty($qty) || !is_numeric($qty)) {
					removeFromCart($id);
					$err ++;
				}
				if(empty($prod_price) || !is_numeric($prod_price)) {
					removeFromCart($id);
					$err ++;
				}
				if(empty($prod_name)) {
					removeFromCart($id);
					$err ++;
				}

				$_SESSION[CU_SESSION_ID]->cust_cart = getCount("customer_cart", "COUNT(*)", "and fkCustomerId = ".$cust_id);
				$_SESSION[CU_SESSION_ID]->cust_cart_total = GetXFromYID("SELECT SUM(p.productPrice) FROM customer_cart c left join product p on c.fkProductId=p.id WHERE fkCustomerId = $cust_id"); 
			}

			if($err > 0) {
				$code = 0;
				$message = "Invalid products have been removed from the cart! Click proceed to checkout.";
			}
			else if($err == 0) {
				$code = 1;
			}
		}
	}

}
else if($req_mode == "REMOVE_FROM_CART") {
	$id = isset($_POST['id']) ? $_POST['id'] : "";
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";

	if(!empty($id) && is_numeric($id)) {
		removeFromCart($id);
		$code = "1";
		$message = "Item removed from cart";

		$_SESSION[CU_SESSION_ID]->cust_cart = getCount("customer_cart", "COUNT(*)", "and fkCustomerId = ".$cust_id);
		$_SESSION[CU_SESSION_ID]->cust_cart_total = GetXFromYID("SELECT SUM(p.productPrice) FROM customer_cart c left join product p on c.fkProductId=p.id WHERE fkCustomerId = $cust_id"); 
	}
}
else if($req_mode == "MOVE_TO_CART") {
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";

	if(!empty($cust_id) && is_numeric($cust_id)) {
		$q = "INSERT INTO customer_cart(fkCustomerId, fkProductId, qty) SELECT $cust_id, fkProductId, '1' FROM customer_wishlist WHERE fkCustomerId = $cust_id";
		$r = sql_query($q);

		if(sql_affected_rows($r)) {
			$code = "1";
			$message = "Items moved to cart!";

			// delete after moving
			sql_query("DELETE FROM customer_wishlist WHERE fkCustomerId = $cust_id");
		}
		else {
			$code = "0";
			$message = "Items could not be moved to cart!";
		}

		$_SESSION[CU_SESSION_ID]->cust_wishlist = getCount("customer_wishlist", "COUNT(*)", "and fkCustomerId = ".$cust_id);	
		$_SESSION[CU_SESSION_ID]->cust_cart = getCount("customer_cart", "COUNT(*)", "and fkCustomerId = ".$cust_id);
		$_SESSION[CU_SESSION_ID]->cust_cart_total = GetXFromYID("SELECT SUM(p.productPrice) FROM customer_cart c left join product p on c.fkProductId=p.id WHERE fkCustomerId = $cust_id"); 
	}
}

$response = array("code"=>$code, "message"=>$message);
echo json_encode($response);
?>