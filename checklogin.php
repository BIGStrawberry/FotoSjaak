<?php
	require_once("./class/LoginClass.php");
	require_once("./class/SessionClass.php");

	//Hier wordt gechecked of er een gebruikersnaam en wachtwoord zijn ingevuld
	if ( !empty($_POST['gebruikersnaam']) && !empty($_POST['password']) )
	{		
		//Check of het ingevulde gebruikersnaam en wachtwoord bestaan in de database			
		if ( LoginClass::check_email_password_exists($_POST['gebruikersnaam'], $_POST['password']) )
		{
			//Check of het useraccount is geactiveerd
			if ( LoginClass::check_if_activated($_POST['gebruikersnaam']) )
			{
				//Maak middels de SessionClass de sessievars $_SESSION['user_id']
				//$_SESSION['user_name'] en $_SESSION['user_role'] aan
				$session->login(LoginClass::find_user($_POST));

				//Aan de hand van de opgevraagde user_role wordt de user doorgestuurd naar
				//zijn of haar homepage.
				switch ( $_SESSION['user_role'] )
				{
					case 'customer':
						//Stuur de user door naar customerHomepage.php
						header("location: index.php?content=customerHomepage");
						break;
					case 'root':
						//Stuur de user door naar rootHomepage.php
						header("location: index.php?content=rootHomepage");
						break;
					case 'sjaak':
						//Stuur de user door naar sjaakHomepage.php
						header("location: index.php?content=sjaakHomepage");
						break;
					case 'developer':
						//Stuur de user door naar developerHomepage.php
						header("location: index.php?content=developerHomepage");
						break;					
					default:
						break;
				}
			}
			else
			{
				echo "Uw account is nog niet geactiveerd. U heeft een mail ontvangen met een<br />
					  met een activatielink. U wordt nu doorgestuurd naar de inlogpagina";
					  header('refresh:3;url=index.php?content=login');
			}
		}							
		else
		{
			echo "De opgegeven combinatie van gebruikersnaam en wachtwoord is niet <br />
				  bekend in de database. U wordt doorgestuurd naar de inlogpagina";
			header('refresh:4;url=index.php?content=login');
		}
	}
	else
	{
		echo "U heeft een van de velden of beiden niet ingevuld. U wordt <br />
			  doorgestuurd naar het inlogscherm
			  <meta http-equiv='refresh' content='3;url=index.php?content=login' />";
	}
?>