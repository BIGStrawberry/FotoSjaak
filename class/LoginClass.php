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
		//$var (bewering) ? 'Waar' : 'Niet waar';
		return ( mysql_num_rows ($result) >0 ) ? true : false;
	}
	public function insert_into_login($postarray)
	{
		global $database;
		date_default_timezone_set("Europe/Amsterdam");
		$date = date("Y-m-d H:i:s");
		//Maakt een passwoord van het email en de tijd en stopt dit in een MD5-Hash
		$temp_password = MD5 ($date.$postarray['e-mail']);
		$query = "INSERT INTO `login` ( `id`,
										`username`,
										`password`,
										`userrole`,
										`activated`,
										`datetime`)
										
								VALUES	( Null,
										  '".$postarray['e-mail']."',
										  '".$temp_password."',
										  'customer',
										  'no',
										  '".$date."')";
										  
			$database->fire_query($query);
			//Opvragen van het id van de zojuist in de tabel login weggeschreven user.
			$query = "SELECT * FROM `login` WHERE `username` = '".$postarray['e-mail']."' "; 
			$id = array_shift (self::find_by_sql($query))->id; 
			$query = "INSERT INTO `user`(`id`,
										 `firstname`,
										 `infix`,
										 `surname`,
										 `address`,
										 `addressnumber`,
										 `city`,
										 `zipcode`,
										 `country`,
										 `telephonenumber`,
										 `mobilenumber`)
										 
							VALUES		(  '".$id."',
										   '".$postarray['firstname']."',
										   '".$postarray['infix']."'
										   '".$postarray['surname']."',
										   '".$postarray['address']."',
										   '".$postarray['addressnumber']."',
										   '".$postarray['city']."',
										   '".$postarray['zipcode']."',
										   '".$postarray['country']."',
										   '".$postarray['telephonenumber']."'
										   '".$postarray['mobilenumber']."')";
										   
		$database->fire_query($query);
	}
 }