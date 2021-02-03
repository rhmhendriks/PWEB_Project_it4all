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
		
	  // Last updated on 03/02/2020 at 9:50 PM
	  // Last edited by Jurre de Vries
	
		$message = "";
		$Debug = "";
		
	  include "../_init/initialize.php";
	
		// Create a statement
		$ID = CheckValue($_GET['ID']); // ID ophalen en bescherming tegen sql injection
		$StatementGet = "SELECT * FROM TipsandTricks WHERE PageID = $ID";
	
	// Create a connection
		$Connector = MySqlDo_Connector('Connect'); // Create connection and use the result array as $Connection
		if ($Connection['result']){ // If there is a connection to the database
			$DBconnect = $Connector['Connection']; // Give the connection to $DBconnect
			$Debug .= $Connection['debug'];
			$Debug .= "<br>";

			// Execute statement
			$statementRun = $DBconnect->query($statement); // Get the tip trick
			
			if(mysql_num_rows($result) >0) {  // If the rows are found
			// Use the data
				while ($row = $statementRun->fetch_assoc()){ // When unused data is found in the statement
					// We write the values to variables
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