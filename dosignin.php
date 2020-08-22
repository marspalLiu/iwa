<?php
	session_start();
	include("include/util.inc.php");

	$login = trim($_POST['login']);
	$password = trim($_POST['password']);

	
	if (isset($login) && isset($password)) {
		$db = getPDO();
		$user = $db->query("SELECT * FROM `users` WHERE `login_name` = ".$db->quote($login))->fetch();
		
		if (isset($user) && password_verify($password,$user["password"])) {

			$_SESSION["user_id"] = $user["user_id"];
			$_SESSION["user_name"] = $user["user_name"];
			header("Location: view_all.php");
			die();
		}

		header("Location: index.php?errorCode=noUser");
		die();
	}else{
		header("Location: index.php?errorCode=inputEmpty");
		die();
	}
?>
