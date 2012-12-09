<?php
	require_once("./class/SessionClass.php");
	$session->logout();
	header("location: index.php");
?>