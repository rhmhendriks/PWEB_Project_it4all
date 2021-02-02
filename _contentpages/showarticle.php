<?php

      #################################################
	  ##### THIS IS THE SHOWARTICLE file		  #####
	  ##### 									  #####
	  ##### This file checks if the article is 	  #####
	  ##### valid and protected against 		  #####
	  ##### SQL-injection						  #####
	  #####								 		  #####
	  #####										  #####
	  #################################################
		
	  ##### This file is created on 14/10/2019 at 14:00 PM
	  ##### This file is created by Jurre de Vries
		
	  // Last updated on 01/11/2019 at 1:44 PM
	  // Last edited by Ronald Hendriks
	  
		$message = "";
		$Debug = "";
	
		echo '<img src="_images/nopic.png" alt="Geen afbeelding gevonden">';
	
	  include "../_init/initialize.php";
	
	// Maken van het statement 
		$ID = CheckValue($_GET['ID']); // ID ophalen en bescherming tegen sql injection
		$StatementGet = "SELECT * FROM Articles WHERE ArticleID = $ID";
	
	// Create a connection
		$Connection = MySqlDo_Connector('Connect'); // Connectie maken en de result array gebruiken als $Connection
		if ($Connection['result']){ // Als er een verbinding is met de database
			$DBconnect = $Connection['connection']; // De verbinding doorgeven aan $DBconnect
			$Debug .= $Connection['debug'];
			$Debug .= "<br>";

			// Statement uitvoeren
			$statementRun = $DBconnect->query($StatementGet); // Het artikel ophalen
			
			if($statementRun->num_rows >0) {  // Als er rijen zijn gevonden
			// gegevens gebruiken
				while ($row = $statementRun->fetch_assoc()){ // wanneer er nog ongebruikte data staat in de uitkomt van het statement
					// We schrijven de waarden weg naar variabelen
					$ArticleID = $row["ArticleID"];
					$ArticleTitle = $row['ArticleTitle'];
					$ArticleDescription = $row['ArticleDescription'];
					$ArticleGroup = $row['ArticleGroup'];
					$NumberInStock = $row['NumberInStock'];
					$SellingPrice = $row['SellingPrice'];
				}
			} else {
				echo "Er is geen artikel gevonden!";
					$ArticleID = "";
					$ArticleTitle = "";
					$ArticleDescription = "";
					$ArticleGroup = "";
					$NumberInStock = "";
					$SellingPrice = "";
				}
		} else {
		$message .= "Er is geen artikel gevonden!";
		}
		
?>