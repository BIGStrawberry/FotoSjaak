<?php
 if (isset($_POST['submit']))
 {
	var_dump($_FILES['foto']);
	//Zet in dit array alle bestandtypen(mime-types) die je accepteert als uploadfile.
	$mime_type = array('image/png', 'image/jpeg', 'image/pjpeg', 'image/gif');

	//Check of het geuploade bestand een correct mime-type heeft
	if (in_array( $_FILES['foto']['type'], $mime_type))
	{
		//Maak het pad naar de directory waar de fotos worden opgeslagen
		$dir = 'fotos/'.$_POST['user_id']."/".$_POST['order_id']."/";
		//echo $dir; exit();
		//Check of de directory al bestaat
		if ( !file_exists($dir) )
		{
			//Maak een directory aan.
			mkdir($dir, 0777, true);
			//Maak daarin een thumbnaildirectory aan.
			mkdir($dir."thumbnails/", 0777, true);
		}

		//Check of de file die we gaan opslaan wel een geuploade file is uit het formulier
		if (is_uploaded_file($_FILES['foto']['tmp_name']))
		{
			//Verplaats het bestand van de tijdelijke directory naar de directory van de klant
			move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$_FILES['foto']['name']);
		}

		//Het maken van de thumbnail
		//Stel een standaard breedte en hoogte in voor de thumbnail
		define('THUMB_SIZE', 80);
		//Pad naar de grote foto
		$path_photo = $dir.$_FILES['foto']['name'];
		//Definieer het pad naar de thumbnail
		$path_thumbnail = $dir."thumbnails/tn_".$_FILES['foto']['name'];
		//Vraag de hoogte en de breedte op van de originele foto $specs_image[0] = breedte $specs_image[1] = hoogte 
		$specs_image = getimagesize($path_photo);
		//De verhouding berekenen
		$ratio_image = $specs_image[0]/$specs_image[1];
		//Als $ratio_image > 1 => landscape foto. Als $ratio_image < 1 => portrait foto. Als $ratio_image = 1 => square foto.
		if ($ratio_image >= 1)
		{
			//Landscape
			$tn_width = THUMB_SIZE;
			$tn_height = THUMB_SIZE/$ratio_image; 
		}
		else
		{
			//Portrait
			$tn_height = THUMB_SIZE;
			$tn_width = THUMB_SIZE * $ratio_image;
		}
		//Dit is het zwarte stuk karton waarop de foto wordt geplakt
		$thumb = imagecreatetruecolor($tn_width, $tn_height);
		//Dit wordt het fotootje dat er wordt opgeplakt
		$source = imagecreatefromjpeg($path_photo);
		//Deze funktie bepaalt hoe de foto op het zwarte stuk karton wordt geplakt
		imagecopyresampled($thumb,
						   $source,
						   0,
						   0,
						   0,
						   0,
						   $tn_width,
						   $tn_height,
						   $specs_image[0],
						   $specs_image[1]);
		imagejpeg($thumb, $path_thumbnail, 100);

	}
	else
	{
		echo "Het uploaden van bestanden met de extentie: ".$_FILES['foto']['type']." is niet toegestaan. U wordt doorgestuurd naar de uploadpagina";
		header("refresh:4;url=index.php?content=upload_form&user_id=".$_POST['user_id']."&order_id=".$_POST['order_id']);	
	}		  
 }
 else
 {
?>
<form action='index.php?content=upload_form' method='post' enctype='multipart/form-data' >
	<table>
		<tr>
			<td>Kies een foto</td>
			<td><input type='file' name='foto' /></td>
		</tr>
		<tr>
			<td>Beschrijving foto</td>
			<td><textarea cols='50' rows='5' name='beschrijving'></textarea></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='submit' value='verstuur' /></td>
		</tr>
	</table>
	<input type='hidden' name='user_id' value='<?php echo $_GET["user_id"]; ?>' />
	<input type='hidden' name='order_id' value='<?php echo $_GET["order_id"]; ?>' />
</form>
<?php
 }
?>