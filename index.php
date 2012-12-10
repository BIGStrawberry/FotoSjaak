<!DOCTYPE html>
<html>
	<head>
		<title>gamelibrary</title>
		<link rel='stylesheet' type='text/css' href='./css/style.css' />
		<link rel='stylesheet' type='text/css' href='./css/custom-theme/jquery-ui-1.9.2.custom.css' />
		<script style='text/javascript' src='./js/script.js' ></script>
		<script style='text/javascript' src='./jquery/jquery-1.8.3.js' ></script>
		<script style='text/javascript' src='./jquery/jquery-ui-1.9.2.custom.js' ></script>
		<script style='text/javascript' src='./jquery/jquery.validate.js' ></script>
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