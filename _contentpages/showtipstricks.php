<?php

      #################################################
	  ##### THIS IS THE SHOWTIPSANDTRICKS file	  #####
	  ##### 									  #####
	  ##### This file checks if the tip or trick  #####
	  ##### is valid and protected against 		  #####
	  ##### SQL-injection						  #####
	  #####								 		  #####
	  #####										  #####
	  #################################################
		
	  ##### This file is created on 14/10/2019 at 14:00 PM
	  ##### This file is created by Jurre de Vries
		
	  // Last updated on 11/10/2019 at 10:33 AM
	  // Last edited by Jurre de Vries
	
		$message = "";
		$Debug = "";
		
	  include "_init/initialize.php";
	
		// Maken van het statement 
		$ID = CheckValue($_GET['ID']); // ID ophalen en bescherming tegen sql injection
		$StatementGet = "SELECT * FROM TipsandTricks WHERE PageID = $ID";
	
	// Maken van de verbinding
		$Connector = MySqlDo_Connector('Connect'); // Connectie maken en de result array gebruiken als $Connection
		if ($Connection['result']){ // Als er een verbinding is met de database
			$DBconnect = $Connector['Connection']; // De verbinding doorgeven aan $DBconnect
			$Debug .= $Connection['debug'];
			$Debug .= "<br>"

			// Statement uitvoeren
			$statementRun = $DBconnect->query($statement); // De tips en tricks ophalen
			
			if(mysql_num_rows($result) >0) {  // Als er rijen zijn gevonden
			// gegevens gebruiken
				while ($row = $statementRun->fetch_assoc()){ // wanneer er nog ongebruikte data staat in de uitkomt van het statement
					// We schrijven de waarden weg naar variabelen
					$PageID = $row["PageID"];
					$PageTitle = $row['PageTitle'];
					$Date = $row['Date'];
					$AuthorID = $row['AuthorID'];
					$CategoryID = $row['CategoryID'];
					$Content = $row['Content'];
					$Sources = $row['Sources'];
				
				}
			} else {
				echo "Er zijn geen tips en tricks gevonden!";
					$PageID = "";
					$PageTitle = "";
					$Date = "";
					$AuthorID = "";
					$CategoryID = "";
					$Content = "";
					$Sources = "";
				}
		} else {
		$message .= "Er zijn geen tips en tricks gevonden!";
	}
?>