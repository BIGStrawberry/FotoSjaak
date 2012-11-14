<html>
	<link rel="stylesheet" type="text/css" href="./css/style.css" />
</html>
<?php
if ( isset($_POST['submit'] ))
{
	//Geef het pad op naar het bestand; LoginClass.php
	require_once('class/LoginClass.php');
	//Kijkt in de tabel login of het gegeven e-mailaddres al bestaat.
	if ( LoginClass::email_exists($_POST['e-mail'] ))
	{
		//Meld dat het emailadress al in gebruik is en dat er een ander gekozen moet worden.
		echo "Het ingevulde emailadres is al in gebruik.<br />
			  kies een ander emailadres. U word doorgestuurd naar<br />
			  de registratiepagina.";
		header( "refresh:4;url=register.php" );
	}
	else
	{
		//Schrijf alle gegevens naar de database 
		//en verstuur een e-mail met activatie link
		echo "record niet gevonden";
	
	}
	
	}

?>

<form action='register.php' method='post'>
	<table>
		<caption> Register </caption>
		<tr>
			<td> firstname </td>
			<th> <input type = 'text' name 'firstname' /> </td>
		</tr>
		
		<tr>
			<td> infix </td>
			<th> <input type = 'text' name 'infix' /> </td>
		</tr>
		
		<tr>
			<td> surname </td>
			<th> <input type = 'text' name 'surname' /> </td>
		</tr>
		
		<tr>
			<td> address </td>
			<th> <input type = 'text' name 'address' /> </td>
		</tr>
		
		<tr>
			<td> addressnumber </td>
			<th> <input type = 'text' name 'addressnumber' /> </td>
		</tr>
		
		<tr>
			<td> zipcode </td>
			<th> <input type = 'text' name 'zipcode' /> </td>
		</tr>
		
		<tr>
			<td> telephonenumber </td>
			<th> <input type = 'text' name 'telephonenumber' /> </td>
		</tr>
		
		<tr>
			<td> mobilenumber </td>
			<th> <input type = 'text' name 'mobilenumber' /> </td>
		</tr>
		
		<tr>
			<td> e-mail </td>
			<td> <input type='text' name='e-mail' /> </td>
		
		<tr>
			<td>&nbsp;</td>
			<td> <input type = 'submit' name='submit' /> </td>
	</table>


</form>

<?php

?>