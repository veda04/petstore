<?php
function getIPAddress(){
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif(!empty($_SERVER['HTTP_X_FORMARDED_FOR'])){
		$ip = $_SERVER['HTTP_X_FORMARDED_FOR'];
	}else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
function cart()
if(isset($_GET['add_to_cart'])){
	global $con;
	$get_ip_add= getIPAddress();
	$get_product_id=$_GET['add_to_cart'];
	$select_query="Select * from 'cart_details' where ip_address='$get_ip_add' and product_id=$get_product_id";
	$result_query=mysql_query($con,$select_query);
	$num_of_rows=mysql_num_rows($result_query);
	if($num_of_rows>0){
		echo "<script>Alert('This item is already present inside the cart')</script>";
		echo "<script>window.open('index.php','_self')</script>";
	}else{
		$insert_query="insert into 'cart_details' (product_id,ip_address,quantity) values ($get_product_id,'$get_ip_add',0)";
		$result_query=mysql_query($con,$insert_query);
		echo "<script>window.open('index.php','_self')</script>";
	}
}



?>