<?php
 $database = 0;
 switch ($database)
 {
	case 0:
		define('SERVERNAME', 'localhost');
		define('USERNAME', 'root');
		define('PASSWORD', '');
		define('DATABASE', 'FotoSjaak');
		date_default_timezone_set("Europe/Amsterdam");
		break;
	case 1:
		define('SERVERNAME', '');
		define('USERNAME', '');
		define('PASSWORD', '');
		define('DATABASE', '');
		break;
	case 3:
		define('SERVERNAME', '');
		define('USERNAME', '');
		define('PASSWORD', '');
		define('DATABASE', '');
		break;
	default:
		break;
 }
?>