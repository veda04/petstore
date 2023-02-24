<?php
/*
	Session management for backend by connecting to database and storing variables in PHP SESSIONS
*/
######	ConnectSQL
$CON = ConnectSQL();

######	SESSION VARIABLES
$logged = 0;

if(isset($_SESSION[AD_SESSION_ID]->log_stat)) // if the session variable has been set...
{	
	if($_SESSION[AD_SESSION_ID]->log_stat == "A")
	{
		$logged = 1;
		$sess_user_id = $_SESSION[AD_SESSION_ID]->user_id;
		$sess_user_name = $_SESSION[AD_SESSION_ID]->user_name;
		$sess_user_role = $_SESSION[AD_SESSION_ID]->user_role;
		$sess_user_sess = $_SESSION[AD_SESSION_ID]->sess_id;
		$sess_login_time = $_SESSION[AD_SESSION_ID]->log_time;	
	}
}

$sess_info_str = "";
if($logged){
	$sess_info = isset($_SESSION[AD_SESSION_ID]->info)? AlertMsg($_SESSION[AD_SESSION_ID]->info, 'info') : '';
	$sess_success_info = isset($_SESSION[AD_SESSION_ID]->success_info)? AlertMsg($_SESSION[AD_SESSION_ID]->success_info, 'success') : '';	
	$sess_error_info = isset($_SESSION[AD_SESSION_ID]->error_info)? AlertMsg($_SESSION[AD_SESSION_ID]->error_info, 'error') : '';	
	$sess_alert_info = isset($_SESSION[AD_SESSION_ID]->alert_info)? AlertMsg($_SESSION[AD_SESSION_ID]->alert_info, 'alert') : '';

	$sess_info_str = $sess_info . $sess_success_info . $sess_error_info .$sess_alert_info;
	$_SESSION[AD_SESSION_ID]->info = "";
	$_SESSION[AD_SESSION_ID]->success_info = "";
	$_SESSION[AD_SESSION_ID]->error_info = "";
	$_SESSION[AD_SESSION_ID]->alert_info = "";
}


if(!$logged && empty($NO_REDIRECT))
{
	ForceOut(6);
}
// ADMIN MENU 
// menu
$menu = array();
// Home
$menu[] = array(
			'title' => "Home",
			'link' => "dashboard.php",
			'icon' => "",
			'has_dropdown' => "N",
			'URLS'=>array()
		);
// Orders
$menu[] = array(
			'title' => "Orders",
			'link' => "orders.php",
			'icon' => "",
			'has_dropdown' => "N",
			'URLS'=>array("order-edit.php")
		);
// Product Menu
$product_sub = array();

$product_sub[] = array(
				'title' => "Category",
				'link' => "category.php",
				'icon' => "",
			);

$product_sub[] = array(
				'title' => "Offers",
				'link' => "offer.php",
				'icon' => "",
			);

$product_sub[] = array(
				'title' => "Items",
				'link' => "items.php",
				'icon' => "",
			);
// Product
$menu[] = array(
			'title' => "Product",
			'link' => "product.php",
			'icon' => "",
			'has_dropdown' => "Y",
			'dropdown' => $product_sub,
			'URLS'=>array("category.php", "category-edit.php", "offer.php", "offer-edit.php", "items.php", "items-edit.php")
		);
// Vendor Sub Menu
$vendor_sub = array();

$vendor_sub[] = array(
				'title' => "Stock Request",
				'link' => "stock_request.php",
				'icon' => "",
			);

$vendor_sub[] = array(
				'title' => "Vendors",
				'link' => "vendor.php",
				'icon' => "",
			);
// Vendors
$menu[] = array(
			'title' => "Vendors",
			'link' => "vendor.php",
			'icon' => "",
			'has_dropdown' => "N",
			'dropdown' => $vendor_sub,
			'URLS'=>array("vendor.php", "vendor-edit.php")
		);
// Customers
$menu[] = array(
			'title' => "Customers",
			'link' => "customer.php",
			'icon' => "",
			'has_dropdown' => "N",
			'URLS'=>array("customer.php", "customer-edit.php")
		);
// Users
$menu[] = array(
			'title' => "Users",
			'link' => "users.php",
			'icon' => "",
			'has_dropdown' => "N",
			'URLS'=>array("users.php", "user-edit.php")
		);
$communications_sub[] = array(
				'title' => "Order Email",
				'link' => "order_email.php",
				'icon' => "",
			);
// Vendors
/*$menu[] = array(
			'title' => "Communications",
			'link' => "communications.php",
			'icon' => "",
			'has_dropdown' => "Y",
			'dropdown' => $communications_sub
		);*/
// Settings Sub Menu
$setting_sub = array();

$setting_sub[] = array(
				'title' => "SEO",
				'link' => "seo.php",
				'icon' => ""
			);

$setting_sub[] = array(
				'title' => "Services",
				'link' => "services.php",
				'icon' => "",
			);
// Settings
$menu[] = array(
			'title' => "SEO",
			'link' => "seo.php",
			'icon' => "",
			'has_dropdown' => "N",
			'dropdown' => array(),
			'URLS'=>array("seo.php")
		);

?>