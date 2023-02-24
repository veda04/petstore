<?php
/*
	- These files are related to customer/frontend site
	- all related funtions and variables are stored in respective files for customer/frontend usage
*/

// frontend common includes files
include "config.inc.php"; 	# config connections
include "define.inc.php"; 	# global defines
include "function.php"; 	# global functions
include "sql.inc.php"; 		# sql functions

if(!isset($NO_INCLUDE))
{
	include "cu.userdat.php"; 	# session related data
}

######	GETCONNECTED
$CON = ConnectSQL(); # connection to database


// Customer session
$cust_logged = 0;
if(isset($_SESSION[CU_SESSION_ID]->log_stat)) // if the session variable has been set...
{	
	if($_SESSION[CU_SESSION_ID]->log_stat == "A")
	{
		$cust_logged = 1;
		$sess_cust_id = $_SESSION[CU_SESSION_ID]->cust_id;
		$sess_cust_name = $_SESSION[CU_SESSION_ID]->cust_name;
		$sess_cust_sess = $_SESSION[CU_SESSION_ID]->sess_id;
	}
}
?>