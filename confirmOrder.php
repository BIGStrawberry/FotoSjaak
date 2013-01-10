<?php
	require_once("./class/OrderClass.php");
	require_once("./class/LoginClass.php");
	if (LoginClass::check_email_password_exists($_GET['user_name'], $_GET['password']))
	{	
		OrderClass::confirm_order_by_id($_GET['order_id']);
		echo "Uw heeft de order succesvol bevestigd. Wij gaan aan het werk.";
		header("refresh:4;url=index.php");
	}
	else
	{
		echo "U heeft geen rechten op deze pagina, U wordt doorgestuurd naar de index";
		header("refresh:4;url=index.php");
	}
?>