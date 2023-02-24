<?php 
require_once('../inc/cu.common.php');

if($_SERVER['REQUEST_METHOD']=="POST"){

	if(isset($_POST["txtusername"]) && isset($_POST["txtpassword"])){
		$username = $_POST['txtusername'];
		$password = $_POST['txtpassword'];

		if($password=='')
			ForceOutCu(2);
		elseif($username=='')
			ForceOutCu(3);
		else{
			$q = "SELECT id, custName, username, password FROM customer WHERE username='$username' ";
			$r = sql_query($q);

			if(sql_num_rows($r)){
				list($u_id, $u_name, $u_username, $u_password) = sql_fetch_row($r);

				if($u_password == md5($password)){
					session_destroy();
					session_start();

					$_SESSION[AD_SESSION_ID] = new userdat;
					$_SESSION[AD_SESSION_ID]->log_stat = "A";
					$_SESSION[AD_SESSION_ID]->cust_id = $u_id;
					$_SESSION[AD_SESSION_ID]->cust_name = $u_name;
					$_SESSION[AD_SESSION_ID]->sess_id = session_id();
					$_SESSION[AD_SESSION_ID]->log_time = NOW;

					header("location:product.php");
					exit;
				}
				else{
					// incorrect password
					ForceOutCu(4);
				}
				
			}
			else{
				ForceOutCu(5);
			}
		}
	}
	else{
		ForceOutCu(6);
	}
}
else{
	session_destroy();
	ForceOutCu(7);
	exit;
}
?>