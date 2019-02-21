<?php
	require_once('conn.php');
	session_start();
	session_unset();
	session_destroy();
	//setcookie("token", "", time()+3600*24);
	header("location: index.php");
?>