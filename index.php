<?php
	require_once("class/MySqlDatabaseClass.php"); 
	require_once("class/LoginClass.php");
	
	$query = "INSERT INTO `login` ( `id`,
									`username`,
									`password`,
									`userrole`,
									`activated`)
						VALUES ( Null,
										'test@gmail.com',
										'geheim',
										'sjaak',
										'yes')";
										
	$database->fire_query($query);

	//$login = new LoginClass();
	
	echo LoginClass::find_all();
	
?>
HiHaHi
