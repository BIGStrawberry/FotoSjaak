<?php require_once("./class/OrderClass.php"); ?>

Opdrachten van klanten
<table>
	<form action='' method=''>
		<tr>
			<th>ordernr.</th>
			<th>opdracht</th>
			<th>datum</th>
			<th>aantal</th>
			<th>kleur/zw</th>
			<th>betaald</th>
			<th>bevestigd</th>
			<th>prijs</th>
			<th>upload</th>
		</tr>
		<?php echo OrderClass::find_orders_users(); ?>
	</form>
</table>