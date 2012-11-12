<?php
 require_once ("MySqlDatabaseClass.php");
 class LoginClass
 {
	//Fields
	private $id;
	private $username;
	private $password;
	private $userrole;
	private $activated;
	
	//Constructor
	public function __construct()
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
			$object->arra[] = $object;
		}
		return $object_array;
	}
	public function find_by_sql ($query)
 }