<script type='text/javascript'>
	$(function ()
	{
		$(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});
	  //$("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
	  //$(".datepicker").datepicker("option","autoSize", true);
	$('#eventForm').validate({
		messages : {
			mission_short : '<p><color='#FF0000'>U bent verplicht dit veld in te vullen<color></p>'
			mission_long  : '<p><color='#FF0000'>U bent verplicht dit veld in te vullen<color></p>'
			}
		});
	});
</script>
<?php
	$options = "<option value=''>--aantal foto's--</option>";
	for ($i = 0; $i <= 1000; $i+=1)
	{
		$options .= "<option value='".$i."'> ".$i." </options>";
	}
?>


<p>opdracht pagina<p> <br />

<form action='index.php?content=opdracht' method='post' id='eventForm'>
<!--korte omschrijving van de opdracht-->
	Korte omschrijving van de opdracht.<br />
	<textarea cols='60' rows='5' name='mission_short' class='required' placeholder='(Geef een korte omschrijving van de opdracht.)'></textarea><br />
<!--uitgebruide omschrijving van de opdracht-->
	Uitgebreide van de  opdracht.<br />
	<textarea cols='60' rows='5' name='mission_long' class='required' placeholder='(Geef een uitgebreide van de omschrijving van de opdracht.)'></textarea> <br >
<!--datum oplevering-->	
	Geef hier de opleveringsdatum.<br />
	<input type='text' name='deleveriyDate' class='datepicker' class='required' placeholder='(yyyy-mm-dd)'/>  <br />
<!--datum evenement-->
	Geef hier de evenementsdatum.<br />
	<input type='text' name='eventDate' class='datepicker' class='required' placeholder='(yyyy-mm-dd)'/>  <br />
<!--kleur of zwartwit foto's-->
	Selecteer of u zwart-wit of kleuren foto's wilt.<br />
	<input type='radio' name="color" value="blackAndWhite" class='required' >Zwart-Wit 
	<input type='radio' name="color" value="color" checked="checked" class='required'>Kleur <br />
<!--aantal foto's-->
	Selecteer het aantal foto's dat u wilt.
	<select name='numberOfPictures' class='required'> 
		<?php echo $options; ?>
	</select>
<!--Submit button-->
	<input type='submit' name='submit' value='verstuur' />
</form>