<?php
include "cu.common.php";

$code = 0;
$message = "";
$response = array();
$req_mode = isset($_POST['mode']) ? $_POST['mode'] : "";

if($req_mode == "ADD_TO_WISHLIST") {

}
else if($req_mode == "ADD_TO_CART") {

}
else if($req_mode == "VALIDATE_CUSTOMER") {
	$username = isset($_POST["username"]) ? $_POST["username"] : "";

	if(!empty($username)) {
		$exists = GetXFromYID("SELECT count(*) from customer WHERE userName = '$username' ");
		$code = ($exists == 0) ? 1 : 0;
		$message = ($exists == 0) ? "Valid username" : "Username already taken, choose another username!";

	}
}

$response = array("code"=>$code, "message"=>$message);
echo json_encode($response);
?>