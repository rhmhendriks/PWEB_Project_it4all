<?php

      #################################################
	  ##### THIS IS THE CHECKFORM file			  #####
	  ##### 									  #####
	  ##### This file checks if the file is 	  #####
	  ##### valid and protected against 		  #####
	  ##### SQL-injection						  #####
	  #####								 		  #####
	  #####										  #####
	  #################################################
		
	  ##### This file is created on 14/10/2019 at 14:00 PM
	  ##### This file is created by Jurre de Vries
		
	  // Last updated on 16/10/2019 at 09:38 PM
	  // Last edited by Jurre de Vries
	
	// Maken van connectie
	$StatementGet = [];
	$results = "dummy+*-";
	Servername; 
	DBSigninname;
	DBKey;
	DBname;

	$ArticleID = mysqli_real_escape_string($_GET['ArticleID']); // Bescherming tegen SQL injection

	$StatementGet[ID] = "SELECT * FROM '(CMS) Articles' WHERE ArticleID = $ArticleID"; // Vinden van correcte artikel
	//$result = mysql_query($StatementGet); // Verkrijg het resultaat van de MySQL-query

	foreach($StatementGet as $variable => $statemant){
		echo {$results} . "<br>"
	}

	/* if(isset($_GET['ID'])) { // Zoeken naar ID
		$StatementGet = "SELECT * FROM Articles";
		$StatementGet .= "WHERE ID = ";
		} */
		
	if(mysql_num_rows($result) >0 { // Controleer of er rijen beschikbaar zijn
		// Gevonden
	} else {
		// Niet gevonden
	}
?>