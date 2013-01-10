<style type="text/css">
	p.error
	{
		background-color:RGBA(240,240,240,1.0);
		color:RGBA(240,0,0,0.4);	
		width:400px;
	}
</style>

<script type='text/javascript'>
	$( function() {
		$(".datepicker").datepicker({ dateFormat: "dd-mm-yy" });
		$('#eventForm').validate({
			rules: {				
				order_short: "required",
				order_long: "required",
				deliveryDate: "required",
				eventDate: "required",
				numberOfPictures: "required"
			},
			messages: {
				order_short: "<p class='error'>U bent verplicht het bovenstaande veld in te vullen</p>",
				order_long: "<p class='error'>U bent verplicht het bovenstaande veld in te vullen</p>",
				deliveryDate: "<p class='error'>U bent verplicht het bovenstaande veld in te vullen</p>",
				eventDate: "<p class='error'>U bent verplicht het bovenstaande veld in te vullen</p>",
				numberOfPictures: "<p class='error'>U bent verplicht het bovenstaande veld in te vullen</p>"
			}
		});
	});
</script>
<?php
	$options = "<option value=''>--aantal foto's--</option>";
	for ( $i = 50; $i <= 1000; $i+=50 )
	{
		$options .= "<option value='".$i."'>".$i."</option>";
	}

	if ( isset($_POST['submit']) )
	{
		require_once("./class/OrderClass.php");
		//Formuliergegegevens opslaan in de database
		OrderClass::insert_into_Order($_POST);
		//Email sturen naar de persoon in kwestie	
	}
	else
	{
?>

<p>plaats een opdracht</p>
<form action='index.php?content=opdracht' method='post' id='eventForm'>
	<!--korte omschrijving van de opdracht-->
	Korte omschrijving opdracht
	<textarea cols='60' rows='5' name='order_short' placeholder='Geef een korte omschrijving'></textarea>
	<!--uitgebreide omschrijving van de opdracht-->
	Uitgebreide omschrijving opdracht
	<textarea cols='60' rows='5' name='order_long' placeholder='Geef een uitgebreide omschrijving'></textarea><br />
	<!--datum oplevering-->
	Geef hier de opleveringsdatum<br />
	<input type='text' name='deliveryDate' class='datepicker' placeholder='(dd-mm-yyyy)' /><br />
	<!--datum evenement-->
	Geef hier de evenementsdatum<br />
	<input type='text' name='eventDate' class='datepicker' placeholder='(dd-mm-yyyy)'/> <br />
	<!--kleur of zwartwit foto’s-->
	<input type="radio" name="color" value="color" checked='checked' />kleur
	<input type="radio" name="color" value="black-white" />zwart-wit<br />
	<!--aantal foto’s-->
	Selecteer het aantal foto's dat u ongeveer wilt hebben
	<select name='numberOfPictures'>
		<?php echo $options; ?>
	</select><br />
	<input type='submit' name='submit' value='verstuur' />
</form>
<?php
	}
?>