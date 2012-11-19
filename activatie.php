<?php
echo "gebruikersnaam: ".$_GET['em']."<br />";
echo "wachtwoord:     ".$_GET['pw']."<br />";
?>

<p>Welkom op de site. Uw account word geactiveerd nadat u <br />
een nieuw wachtwoord heeft gekozen.</p>
<form action= '' method='' >
	<table>
		<tr>
			<td> Nieuw wachtwoord</td>
			<td> <input type='password' name='wachtwoord'?> </td>
		</tr>
		
		<tr>
			<td> Nieuw wachtwoord(Check)</td>
			<td> <input type='password' name='wachtwoord-check'?> </td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td> <input type='submit' name='submit'?> </td>
		</tr>
	</table>
</form>
