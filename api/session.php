<?php
	session_start();

	$user_check = $_SESSION['login_user'];

	if (!isset($_SESSION['login_user'])) {
		if (strpos(getcwd(), "api") !== false)
			header("location: login.php");
		else
			header("location: api/login.php");

		die();
	}
?>