<?php
 require_once("./class/MySqlDatabaseClass.php");
 
 class UserClass
 {
	//Fields
	private $id;
	private $firstname;
	private $infix;
	private $surname;
	private $address;
	private $adressnumber;
	private $city;
	private $zipcode;
	private $country;
	private $telephonenumber;
	private $mobilenumber;

	//Properties
	public function get( $name ) { return (property_exists( __CLASS__,  $name )) ? $this->$name : Null;}

	public function set( $name, $value ) {
		if ( property_exists( __CLASS__, $name) ){ $this->$name = $value; }
	}

	public static function find_by_sql( $query )
	{
		global $database;
		$result = $database->fire_query( $query );
		$object_array = array();
		while ( $row = mysql_fetch_object( $result ) )
		{
			$object = new UserClass();
			$object->id = $row->id;
			$object->firstname = $row->firstname;
			$object->infix = $row->infix;
			$object->surname = $row->surname;
			$object->address = $row->address;
			$object->addressnumber = $row->addressnumber;
			$object->city = $row->city;
			$object->zipcode = $row->zipcode;
			$object->country = $row->country;
			$object->telephonenumber = $row->telephonenumber;
			$object->mobilenumber = $row->mobilenumber;			
			$object_array[] = $object;		
		}
		return $object_array;
	}

	public static function find_firstname_infix_surname()
	{
		$query = "SELECT * FROM `user`
				  WHERE `id` = '".$_SESSION['user_id']."'";
		//var_dump(array_shift(self::find_by_sql($query))); exit();
		$user = array_shift(self::find_by_sql($query));
		return $user;
	}

 }
?>