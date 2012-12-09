<!DOCTYPE html>
<html>
	<head>
		<title>gamelibrary</title>
		<link rel='stylesheet' type='text/css' href='./css/style.css' />
	</head>
	<body>
		<div id="container">
			<div id='banner'>
				<?php include("banner.php"); ?>
			</div>
			<div id='content'>
				<div id='link'>
					<?php include("./class/SessionClass.php"); ?>
					<?php include("./link.php"); ?>
				</div>
				<?php include("./navigation.php"); ?>
			</div>
			<div id='footer'>
				<?php include("footer.php"); ?>
			</div>
		</div>			
	</body>
</html>