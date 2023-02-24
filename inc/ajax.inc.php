<?php
include "cu.common.php";

$response = array();
$req_mode = isset($_POST['mode']) ? $_POST['mode'] : "";

if($req_mode == "ADD_TO_WISHLIST") {

}
else if($req_mode == "ADD_TO_CART") {

}
else if($req_mode == "VALIDATE_CUSTOMER") {
	
}

echo json_encode($response);
?>