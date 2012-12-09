<?php
 require_once("./class/LoginClass.php");
 
 if (isset($_POST['submit']))
 {
	if ( !strcmp($_POST['wachtwoord'],$_POST['wachtwoord-check']))
	{
		//echo "Sla het nieuwe wachtwoord op en activeer het account";
		LoginClass::update_password($_POST['email'], $_POST['wachtwoord']);
		echo "Uw wachtwoord is succesvol veranderd. U wordt doorgestuurd naar<br />
			  de startpagina";
		header("refresh:3;url=index.php");
	}
	else
	{
		echo "De ingevoerde wachtwoorden komen niet overeen<br />
			  Probeer het opnieuw";
		header("refresh:3;url=index.php?content=activatie&em=".$_POST['email']."&pw=".$_POST['oldpassword']);
	}
 }
 else
 {
	 if (LoginClass::check_email_password_exists($_GET['em'], $_GET['pw']))
	 {
	?>

	 <p>Welkom op de site. Uw account wordt geactiveerd nadat u <br />
	 een nieuw wachtwoord heeft gekozen</p>
	 <form action='index.php?content=activatie' method='post'>
		<table>
			<tr>
				<td>nieuw wachtwoord (maximaal 12 tekens)</td>
				<td><input type='password' name='wachtwoord' size=12 maxlength=12 /></td>
			</tr>
			<tr>
				<td>nieuw wachtwoord (check)</td>
				<td><input type='password' name='wachtwoord-check' size=12 maxlength=12/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>		
				<td>
					<input type='submit' name='submit' value='verstuur' />
					<input type='hidden' name='email' value='<?php echo $_GET['em']; ?>' />
					<input type='hidden' name='oldpassword' value='<?php echo $_GET['pw']; ?>' />
				</td>
			</tr>	
		</table> 
	 </form>
	 <?php
	 }
	 else
	 {
		echo "U heeft geen rechten op deze pagina. U wordt doorgestuurd naar de index";
		header("refresh:3;url=index.php");
	 }
 } 
?>