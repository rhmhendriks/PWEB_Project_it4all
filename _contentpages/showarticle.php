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
		
	  // Last updated on 03/02/2020 at 9:48 PM
	  // Last edited by Jurre de Vries
	  
		$message = "";
		$Debug = "";
	
		echo '<img src="_images/nopic.png" alt="Geen afbeelding gevonden">';
	
	  include "../_init/initialize.php";
	
	// Maken van het statement 
		$ID = CheckValue($_GET['ID']); // ID ophalen en bescherming tegen sql injection
		$StatementGet = "SELECT * FROM Articles WHERE ArticleID = $ID";
	
	// Create a connection
		$Connection = MySqlDo_Connector('Connect'); // Create connection and use the result array as $Connection
		if ($Connection['result']){ // If there is a connection to the database
			$DBconnect = $Connection['connection']; // Give the connection to $DBconnect
			$Debug .= $Connection['debug'];
			$Debug .= "<br>";

			// Execute statement
			$statementRun = $DBconnect->query($StatementGet); // Get the article
			
			if($statementRun->num_rows >0) {  // If the rows are found
			// Use the data
				while ($row = $statementRun->fetch_assoc()){ // When unused data is found in the statement
					// We write the values to variables
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