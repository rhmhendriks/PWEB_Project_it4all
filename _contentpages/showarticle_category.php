<?php

      #################################################
	  ##### THIS IS THE SHOWARTICLE-CATEGORY file #####
	  ##### 									  #####
	  ##### This file checks if the  	  		  #####
	  ##### article-category isvalid and  		  #####
	  ##### protected against SQL-injection		  #####
	  #####								 		  #####
	  #####										  #####
	  #################################################
		
	  ##### This file is created on 05/11/2019 at 12:12 PM
	  ##### This file is created by Jurre de Vries
		
	  // Last updated on 03/02/2020 at 9:47 PM
	  // Last edited by Jurre de Vries
	  
	  $message = "";
	  $Debug = "";
	
	include "../_init/initialize.php";
	
	// Create a statement
		$ID = CheckValue($_GET['ID']); // ID ophalen en bescherming tegen sql injection
		$StatementGet = "SELECT * FROM Articles WHERE ArticleGroupID = $ID";
		
	// Create a connection
		$Connection = MySqlDo_Connector('Connect'); // Create connection and use the result array as $Connection
		if ($Connection['result']){ // If there is a connection to the database
			$DBconnect = $Connection['connection']; // Give the connection to $DBconnect
			$Debug .= $Connection['debug'];
			$Debug .= "<br>";
			
			// Execute statement
			$statementRun = $DBconnect->query($StatementGet); // Get the article group
			
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
					
					echo "<h2>" . $ArticleTitle . "</h2>";
					echo "<br>";
					echo '<div class="ArtListLeft">';
					echo "<p> DIT IS DE AFBEELDING DIE RIENAN HAD MOETEN REGELEN </p>";
					echo '</div>';
					echo "<br>";
					echo '<div class="ArtListMiddle">';
					echo "<p>" . $ArticleDescription . "</p>";
					echo '</div>';
					echo '<br>';
					echo '<div class="ArtListRight">';
					echo "<p>" . '<h3 class="inStock">' . $NumberInStock . "</h3>" . "</p>" . "<p>" . '<h3 class="price">' . '&euro;' . $SellingPrice . "</h3>" . "</p>";
					echo '<p class="artikelInfo">' . $ArticleGroup, $ArticleID . "</p>";
					echo '</div>';
					echo "<br>";
					
				}
			} else {
				echo "Er zijn geen artikelen gevonden binnen de gekozen categorie";
				}
					
			} else {
				$Debug .= "The connection failed";
				$message .= "Er is geen artikel gevonden!";
		}
		
?>