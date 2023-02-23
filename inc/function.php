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
		$str = '<div class="alert '.$mode.' alert-mg-b-0" role="alert">'.$msg.'</div>';
	

	return $str;
}
?>