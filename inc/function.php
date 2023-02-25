<?php
/*
	- generic funtions for the project
	- ensure re-use of code as much as possible
	- add appropriate comments if modifying a particular function and inform other team members
*/

// Connecting the project to database
function ConnectSQL() {
	$CON = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("<strong>ERROR CODE : </strong> COM - 04");
	mysqli_select_db($CON, DB_NAME) or die("<strong>ERROR CODE : </strong> COM - 04"); 
	return $CON;
}

// Logging SQL Queries and issues
function logSQl($f_name, $txt = "") {
	/*$f_path = LOG_PATH.$f_name;
	$logfile = fopen($f_path, "a");// or die("Unable to open file!");
	fwrite($f_path, $txt);
	fclose($f_path);*/
}

// Redirecting function if required
function ForceOut($code = 0, $page = "index.php", $sess_destroy="N") {
	if($sess_destroy == "Y")
		session_destroy();

	$page = empty($page) ? ADMIN_ADDRESS : ADMIN_ADDRESS.$page;

	header("location: $page?err=$code");
	exit;
}

function ForceOutCu($code = 0, $page = "index.php", $sess_destroy="N") {
	if($sess_destroy == "Y")
		session_destroy();

	$page = empty($page) ? SITE_ADDRESS : SITE_ADDRESS.$page;

	header("location: $page?err=$code");
	exit;
}

// Increment the id value while inserting the inputs
function NextId($table_id, $table_name){
	if(!empty($table_id) && !empty($table_name)){
		$q1 = "SELECT MAX($table_id) FROM $table_name";
		$r1 = sql_query($q1);
		list($disp) = sql_fetch_row($r1);
		$txt_id = $disp + 1;
		return $txt_id;
	}
}

// pop msgs
function AlertMsg($msg = "", $type = "info"){
	$mode = "";
	$str = "";

	if($type == "info") $mode = "alert-info";
	else if($type == "success") $mode = "alert-success";
	else if($type == "error") $mode = "alert-danger";
	else if($type == "alert") $mode = "alert-warning";

	if(!empty($msg))
		$str = '<div class="alert mb-10 '.$mode.' alert-mg-b-0" role="alert">'.$msg.'</div>';
	

	return $str;
}

//to get name based on id
function get_dat_arr($id, $name, $table_name, $cond=""){
	$arr = array();
 	$q = "SELECT $id,  $name FROM `$table_name` WHERE 1 $cond";
 	$r = sql_query($q);
 	if(sql_num_rows($r)){
 		while(list($id, $name) = sql_fetch_row($r)){
 			$arr[$id] = $name;
 		}
 	}
 	return $arr;
}

//to get customer details based on id
function get_det_arr($id){
	$arr = array();

	$q = "SELECT * FROM `customer` WHERE id = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
} 

// to get the address based on id
function get_add_arr($id){
	$arr = array();
	
	$q = "SELECT * FROM `customer_address` WHERE 1 AND fkCustomerId = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);
	
	return $arr;
}

//to get orders of customer based on id
function get_order_arr($id){
	$arr = array();

	$q = "SELECT * FROM `orders` WHERE 1 AND fkCustomerId = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
}

// to get the payment details of customer
function get_pay_arr($id){
	$arr = array();

	$q = "SELECT * FROM `customer_payment` WHERE 1 AND fkCustomerId = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
}

//to get order items from order item table
function get_items_arr($id){
	$arr = array();

	$q = "SELECT * FROM `order_item` WHERE 1 AND fkOrderId = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
}
//to get order items from order item table
function get_status_arr($id){
	$arr = array();

	$q = "SELECT * FROM `order_status` WHERE 1 AND fkOrderId = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
}

//print array
function pr_arr($arr= array()){
	echo '<pre/>';
	print_r($arr); 
}

function getCount($table, $field="COUNT(*)", $cond="") {
	$count = 0;

	if(!empty($table)) {
		$q = "SELECT $field FROM $table WHERE 1 $cond";
		$r = sql_query($q);
		if(sql_num_rows($r))
			list($count) = sql_fetch_row($r);
	}

	return $count;
}

function randomSparkline($num = 12) {
	$sparkline_str = "";

	if(!empty($num) && is_numeric($num) ) {
		for($i=1; $i<=$num; $i++) {
			$sparkline_str .= rand(1,100).',';
		}

		$sparkline_str = substr($sparkline_str,0,-1);
	}

	return $sparkline_str;
}

function getDataFromTable($table_name, $field_str="*", $cond="", $query = "") {
	$arr = array();
	$q = !empty($query) ? $query : "SELECT $field_str FROM $table_name WHERE 1 $cond";
	$r = sql_query($q);

	if(sql_num_rows($r))
		$arr = sql_get_data($r);

	return $arr;
}

function GetXArrFromYID($q, $mode="1")
{
	$arr = array();
	$r = sql_query($q);
	
	if(sql_num_rows($r))
	{
		if($mode == "2")
			for($i=0; list($x) = sql_fetch_row($r); $i++)
				$arr[$i] = $x;
		else if($mode == "3")
			for($i=0; list($x, $y) = sql_fetch_row($r); $i++)
				$arr[$x] = $y;
		else if($mode == "4")
			while($a = sql_fetch_assoc($r))
				$arr[$a['I']] = $a;
		else
			while(list($x) = sql_fetch_row($r))
				$arr[$x] = $x;
	}

	return $arr;
}

function GetXFromYID($q, $mode="1")
{
	$ret = "";
	$r = sql_query($q);
	
	if(sql_num_rows($r)) {
		list($ret) = sql_fetch_row($r);
	}

	return $ret;
}

function updateProductStock($prod_id) {
	$ret = false;

	if(!empty($prod_id) && is_numeric($prod_id)) {
		$q = "UPDATE product SET productQty = (SELECT SUM(newQty) from product_stock WHERE fkProductId = $prod_id) WHERE id = $prod_id ";
		$r = sql_query($q);

		if(sql_affected_rows($r))
			$ret = true;
	}

	return $ret;
}

function Array2String($arr = array())
{
	$str = "";

	if(!empty($arr))
	{
		foreach($arr as $_label =>$_count) {
			if(is_numeric($_count) && $_count!=0) {
				$str .= $_label.', ';
			}
		}
	}

	return substr($str,0,-2);
}

function validateReference($table_name, $pk_fld, $pk_id) {
	$c = 0;
	if(!empty($table_name) && !empty($pk_fld) && !empty($pk_id)) {
		$c = getCount($table_name, "COUNT(*)", " AND ".$pk_fld.' = '.$pk_id);
	}

	return $c;
}

function GetUrlName($title)
{
	$URL_CHAR_ARR = array("%","/",".","#","?","*","!","@","&",":","|",";","=","<",">","^","~","'","\"",",","-","(",")","'",'"','\\');
	$rurl = trim($title);
	$rurl = str_replace($URL_CHAR_ARR,'',$title);
	$rurl = str_replace('   ',' ',$rurl);
	$rurl = str_replace('  ',' ',$rurl);
	$rurl = str_replace(' ','-',$rurl);
	$rurl = trim(strtolower($rurl));

	return $rurl;
}

function getProductCategory($cond="") {
	$arr = array();
	$q = "SELECT `id`, `title`, `image`, `description`, `status` FROM `category` WHERE 1 $cond";
	$r = sql_query($q);

	if(sql_num_rows($r))
		$arr = sql_get_data($r);

	return $arr;

}

function removeFromCart($pk_id) {
	if(!empty($pk_id) && is_numeric($pk_id)) {
		sql_query("DELETE FROM customer_cart WHERE id = $pk_id");
	}
}
?>