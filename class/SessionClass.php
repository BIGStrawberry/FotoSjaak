<?php
 class SessionClass
 {
	//Fields
	private $user_id;
	private $user_name;
	private $user_role;
	private $logged_in = false;
	
	//Constructor 
	public function __construct()
	{
		session_start();
		$this->checklogin();
	}
	
	public function checklogin()
	{
		if ( isset( $_SESSION['user_id'] ) )
		{
			$this->user_id = $_SESSION['user_id'];
			$this->user_name = $_SESSION['user_name'];
			$this->user_role = $_SESSION['user_role'];
			$this->logged_in = true;			
		}
		else
		{
			unset( $this->user_id);
			unset( $this->user_name);
			unset( $this->user_role);
			$this->logged_in = false;			
		}		
	}
	
	public function login( $user )
	{
		$this->user_id = $_SESSION['user_id'] = $user->getId();
		$this->user_name = $_SESSION['user_name'] = $user->getUsername();
		$this->user_role = $_SESSION['user_role'] = $user->getUserrole();
		$this->logged_in = true;
	}
	
	public function logout()
	{
		session_destroy();
		$this->logged_in = false;
	}
 }
 $session = new SessionClass();
?>