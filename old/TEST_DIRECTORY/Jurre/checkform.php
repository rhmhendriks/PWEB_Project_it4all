<!DOCTYPE HTML>

<html lang="en">
  <head>
	<title>Checkform</title>
  </head>
  <body>
	  <?php
		#################################################
		##### THIS IS THE CHECKFORM file			#####
		##### 										#####
		##### This file checks if the file is valid	#####
		##### and protected against SQL-injection	#####
		#####										#####
		#################################################
		
		##### This file is created on 11/10/2019 at 14:00 PM
		##### This file is created by Jurre de Vries
		
		// Last updated on 11/10/2019 at 14:00 PM
		// Last edited by Jurre de Vries
		
		$Bad = array('/', '&', '$', '"', '!', "'", ";", );
		$array = "$checkform";
		multi_strpos($array, $Bad);
		
		function multi_strpos($checkform, $Bad) {
			foreach ($Bad as $b) {
				if (strpos($checkform, $b) !== false);
					return strpos($checkform, $b);
			}
			return false;
		} // Sluit function multi_strpos 14
		
		function checkform($checkform) { // Controleren op geldigheid
			  foreach($array as $key => $value) {
				$checkform = trim($checkform); // Controleren van trim
				$checkform = stripslashes($checkform); // Controleren van stripslashes
				$checkform = htmlspecialchars($checkform); // Controleren van htmlspecialchars
				return($checkform);
			} 
		} // Sluit function checkform 22
	  checkform("s'\test");
	  ?>
  </body>
</html>