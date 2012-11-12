<?php
 require_once ('config.php');
 //Dit is de classe definitie van de MySqlDatabase class.
 class MySqlDatabaseClass
 {
	//Fields
	private $db_connection;
	
	//Dit is de constructor van de MySqlDatabase class.
	public function __construct()
	{
		$this->db_connection = mysql_connect() or die ('MySqlDatabaseClass: '.mysql_error());
	}
 }
 $database = new MySqlDatabaseClass();
<?