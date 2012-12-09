<?php
 require_once("MySqlDatabaseClass.php");
 
 class LoginClass
 {
	//Fields
	private $id;
	private $username;
	private $password;
	private $userrole;
	private $activated;
	
	//Properties
	public function getId() { return $this->id;	}
	public function getUsername() { return $this->username;	}
	public function getUserrole() { return $this->userrole;	}
	
	
	//Constructor
	public function __construct()
	{
	}
	
	public static function find_by_sql( $query )
	{
		global $database;
		$result = $database->fire_query( $query );
		$object_array = array();
		while ( $row = mysql_fetch_object( $result ) )
		{
			$object = new LoginClass();
			$object->id = $row->id;
			$object->username = $row->username;
			$object->password = $row->password;
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
			$output .= $value->id." | ".
					   $value->username." | ".
					   $value->password." | ".
					   $value->userrole." | ".
					   $value->activated." | ".
					   "<br />";
		}
		return $output;
	}
	
	public static function emailaddress_exists( $emailaddress )
	{
		global $database;
		$query = "SELECT * FROM `login` WHERE `username` = '".$emailaddress."'";
		$result = $database->fire_query($query);
		//ternary operator $variabele (bewering) ? "Waar" : "Niet waar";
		return (mysql_num_rows($result) > 0) ? true : false;
	}
	
	public static function insert_into_login($postarray)
	{
		//print_r($postarray); exit();
		global $database;
		//Genereer de datum
		date_default_timezone_set("Europe/Amsterdam");
		$date = date("Y-m-d H:i:s");
		//Maak een password van het email en de tijd en stop dit in een MD5-hash
		$temp_password = MD5($date.$postarray['e-mail']);
		$query = "INSERT INTO `login` ( `id`,
										`username`,
										`password`,
										`userrole`,
										`activated`,
										`datetime`)
							   VALUES ( Null,
										'".$postarray['e-mail']."',
										'".$temp_password."',
										'customer',
										'no',
										'".$date."')";
		$database->fire_query($query);
		
		//Opvragen van het id van de zojuist in de tabel login weggeschreven user
		$query = "SELECT * FROM `login` WHERE `username` = '".$postarray['e-mail']."'";
		$id = array_shift(self::find_by_sql($query))->id;
		$query = "INSERT INTO `user` ( `id`,
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
						VALUES      ( '".$id."',
									  '".$postarray['firstname']."',
									  '".$postarray['infix']."',
									  '".$postarray['surname']."',
									  '".$postarray['address']."',
									  '".$postarray['addressnumber']."',
									  '".$postarray['city']."',
									  '".$postarray['zipcode']."',
									  '".$postarray['country']."',
									  '".$postarray['telephonenumber']."',
									  '".$postarray['mobilenumber']."')";
		$database->fire_query($query);
		self::send_activation_email($postarray['e-mail'], $temp_password, $postarray['firstname'], $postarray['infix'], $postarray['surname']);
	}
	
	public static function send_activation_email($email, $password, $firstname, $infix, $surname )
	{
		//echo $email."<br />".$password; exit();
		$carbonCopy = "sjaak@fotosjaak.nl";
		$blindCarbonCopy = "info@belastingdienst.nl";
		$ontvanger = $email;
		$onderwerp = "Activatiemail website FotoSjaak";
		/*
		//Bericht voor platte tekst mail
		$bericht   = "Geachte heer/mevrouw ".$firstname." ".$infix." ".$surname."\r\n
					  Voor u kunt inloggen moet uw account nog worden geactiveerd.
					  Klik hiervoor op de onderstaande link\r\n
					  http://localhost/2012-2013/AM1A/Blok2/activatie.php?em=".$email."&pw=".$password."\r\n
					  Met vriendelijke groet,
					  Arjan de Ruijter
					  uw fotograaf";
		*/	  
		$bericht   = "Geachte heer/mevrouw <b>".$firstname." ".$infix." ".$surname."</b><br /><br />
					  Voor u kunt inloggen moet uw account nog worden geactiveerd.<br />
					  Klik hiervoor op de onderstaande link<br /><br />
					  <a href='http://localhost/Blok2/index.php?content=activatie&em=".$email."&pw=".$password."'>activeer account</a><br /><br />
					  Met vriendelijke groet,<br />
					  <i><u>Sjaak de Vries</u></i><br />
					  uw fotograaf";
					  
		$headers   = "From: info@fotosjaak.nl\r\n";
		$headers  .= "Reply-To: info@fotosjaak.nl\r\n"; 
		$headers  .= "Cc: ".$carbonCopy."\r\n";
		$headers  .= "Bcc: ".$blindCarbonCopy."\r\n";
		$headers  .= "X-mailer: PHP/".phpversion()."\r\n";
		$headers  .= "MIME-version: 1.0\r\n";
		//$headers  .= "Content-Type: text/plain; charset=iso-8859-1\r\n";
		$headers  .= "Content-Type: text/html; charset=iso-8859-1\r\n";
		//$bericht = wordwrap($bericht, 10);
		mail( $ontvanger, $onderwerp, $bericht, $headers );
	}
	
	public static function update_password($email, $password)
	{
		global $database;
		$query = "UPDATE `login`
				  SET `password` = '".$password."',
					  `activated` = 'yes'				  
				  WHERE `username` = '".$email."'";
		//echo $query; exit();
		$database->fire_query($query);
	}
	
	public static function check_email_password_exists($email, $password)
	{
		$query = "SELECT * FROM `login`
				  WHERE `username` = '".$email."'
				  AND	`password` = '".$password."'";
		$record = self::find_by_sql($query);
		//ternary operator
		$found = (sizeof($record) > 0) ? true : false;
		return $found;
	}
	
	public static function check_if_activated($email)
	{
		$query = "SELECT * FROM `login`
				  WHERE `username` = '".$email."'";
		$record = self::find_by_sql($query);
		//Ternary operator, als het account is geactiveerd return true, anders false
		return ($record[0]->activated == 'yes') ? true : false;		
	}
	
	public static function find_user( $postArray )
	{
		$query = "SELECT * FROM `login`
				  WHERE `username` = '".$postArray['gebruikersnaam']."'
				  AND	`password` = '".$postArray['password']."'";
		$user_array = self::find_by_sql($query);
		$user = array_shift($user_array);
		return $user;
		//var_dump($user)."<br />";
		//echo $query; exit();
	
	}
	
	
 }
?>