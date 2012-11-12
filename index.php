<?php 
	require_once("class/MySqlDatabaseClass.php"); 
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







?>

<?php
 require_once("css.css");
Dit is een test voor database class


?>