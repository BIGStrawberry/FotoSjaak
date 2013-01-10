<ul>
	<li>
		<a href='index.php?content=homepage'>home</a>
	</li>
	<?php
		if ( isset( $_SESSION['user_role']))
		{
			switch ($_SESSION['user_role'])
			{
				case 'customer':
					echo "<li>
							<a href='index.php?content=opdracht'>opdracht plaatsen</a>
						  </li>";					
					break;
				case 'sjaak':
					echo "<li>
							<a href='index.php?content=opdrachten'>opdrachten</a>
						  </li>
						 ";
					break;
				case 'root':
					break;
				case 'developer':
					break;
				default:
					break;			
			}
			echo "<li><a href='index.php?content=logout'>uitloggen</a></li>";
		}
		else
		{
			echo "<li>
					<a href='index.php?content=register'>registreren</a>
				  </li>
				  <li>
					<a href='index.php?content=login'>inloggen</a>
				  </li>";		
		}
	?>	
</ul>