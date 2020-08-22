<?php
	session_start();
	include("include/util.inc.php");

	try {
		$message = $_GET["message"];

		# TO COMPLETE
		$db = getPDO();
		$send_user_id = $_SESSION['user_id'];
		$exchange_user_id = $_GET['exchange_user_id'];
		$be_exchanged_user_id = $_GET['be_exchanged_user_id'];
		$exchange_object_id = $_GET['exchange_object_id'];
		$be_exchanged_object_id = $_GET['be_exchanged_object_id'];
		$message = $_GET['message'];
		#############


		$db->exec("INSERT INTO messsages (send_user_id,exchange_user_id,exchange_object_id,be_exchanged_user_id,be_exchanged_object_id,message) VALUES('$send_user_id', '$exchange_user_id', '$exchange_object_id', '$be_exchanged_user_id', '$be_exchanged_object_id', '$message')");
		echo "success";
	} catch (Exception $e) {
		echo $e;
	}
	
?>
