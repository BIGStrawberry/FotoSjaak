<?php
 require_once ("MySqlDatabaseClass.php");
 class LoginClass
 {
	//Fields
	public $id;
	public $username;
	public $password;
	public $userrole;
	public $activated;
	
	//Properties
	
	//Constructor
	public function __construct()
	{
	
	}
	public static function find_by_sql ($query)
	{
		global $database;
		$result = $database->fire_query($query);
		$object_array = array();
		while ($row = mysql_fetch_object($result))
		{
			$object = new LoginClass();
			$object->id = $row->id;
			$object->username = $row->username;
			$object->userrole = $row->userrole;
			$object->activated = $row->activated;
			$object_array[] = $object;
		}
		return $object_array;
	}
	public static function find_all()
	{
		$query = "SELECT * FROM `login`";
		$result = self::find_by_sql($query);
		$output = '';
		foreach ( $result as $value )
		{
			$output .= 	$value->id.       " | ".
						$value->username. " | ".
						$value->password. " | ".
						$value->userrole. " | ".
						$value->activated." | ".
						"<br />";
		}
		return $output;
	}
	public static function email_exists( $emailaddress )
	{
		global $database;
		$query = "SELECT * FROM `login` WHERE `username` = '".$emailaddress."'";
		$result = $database->fire_query($query);
		//Ternary opertaor
		//$var (bewering) ? 'Waar' : 'Niet waar';
		return ( mysql_num_rows ($result) >0 ) ? true : false;
	}
	
 }