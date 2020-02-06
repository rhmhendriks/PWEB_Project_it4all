<!DOCTYPE HTML>

<html lang="en">
  <head>
	<title>Checktest</title>
  </head>
  <body>
	  <?php
	  
		$Bad = array('@', '/', '&', '$', '"', '!');
		$array = "$checkform";
		multi_strpos($array, $Bad);
		
		function multi_strpos($checkform, $Bad) {
			foreach ($Bad as $b) {
				if (strpos($checkform, $b) !== false);
					return strpos($checkform, $b);
			}
			return false;
		}
		
		/* function checkform($checkform) { // Controleren op geldigheid
			  foreach($array as $key => $value) {
				$checkform = trim($checkform); // Controleren van trim
				$checkform = stripslashes($checkform); // Controleren van stripslashes
				$checkform = htmlspecialchars($checkform); // Controleren van htmlspecialchars
				return($checkform);
			} 
		} */ // Sluit function multi_strpos 14
	  checkform("s'\test");
	  ?>
  </body>
</html>