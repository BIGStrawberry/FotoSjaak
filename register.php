<?php
 if (isset($_POST['submit'] ))
 {
	//Geef het pad op naar het bestand LoginClass.php
	require_once('class/LoginClass.php');
	
	//Kijk in de tabel login of het gegeven e-mailadres al bestaat
	if ( LoginClass::emailaddress_exists($_POST['e-mail']) )

	
	{
	
		//Meldt dat het emailadres al in gebruik
		//is en dat er een ander gekozen moet worden.
		echo "Het ingevulde emailadres is al in gebruik.<br />
			  kies een ander emailadres. U wordt doorgestuurd naar<br />
			  de registratiepagina.";
		header("refresh:4;url=index.php?content=register" );
	}
	else
	{
		//Schrijf alle gegevens naar de database
		LoginClass::insert_into_login($_POST);
		echo "U bent succesvol geregistreerd. U ontvangt een activatiemail in uw mailbox<br />
			  Na het activeren van uw account kunt u inloggen op de site";
		header("refresh:3;url=index.php");
		//verstuur een e-mail met een activatielink.
	} 
 }
 else
 {
?>
<form action='index.php?content=register' method='post'>
	<div class='changedata'>
		<table>
		<caption>Register</caption>
		<tr>
			<td>firstname</td>
			<td><input type='text' name='firstname' /></td>
		</tr>
		<tr>
			<td>infix</td>
			<td><input type='text' name='infix' /></td>
		</tr>
		<tr>
			<td>surname</td>
			<td><input type='text' name='surname' /></td>
		</tr>
		<tr>
			<td>address</td>
			<td><input type='text' name='address' /></td>
		</tr>
		<tr>
			<td>addressnumber</td>
			<td><input type='text' name='addressnumber' /></td>
		</tr>
		<tr>
			<td>city</td>
			<td><input type='text' name='city' /></td>
		</tr>
		<tr>
			<td>zipcode</td>
			<td><input type='text' name='zipcode' /></td>
		</tr>
		<tr>
			<td>country</td>
			<td><input type='text' name='country' /></td>
		</tr>
		<tr>
			<td>telephonenumber</td>
			<td><input type='text' name='telephonenumber' /></td>
		</tr>
		<tr>
			<td>mobilenumber</td>
			<td><input type='text' name='mobilenumber' /></td>
		</tr>
		<tr>
			<td>e-mail</td>
			<td><input type='text' name='e-mail' /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='submit' /></td>
		</tr>
		</table>
	</div>
</form>
<?php
 }
?>