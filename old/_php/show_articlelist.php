<?php

      #################################################
	  ##### THIS IS THE SHOWARTICLE LIST file     #####
	  ##### 									  #####
	  ##### This script creates a list  		  #####
	  ##### of articles based on their   		  #####
	  ##### article category                	  #####
	  #####								 		  #####
	  #####										  #####
	  #################################################
		
	  ##### This file is created on 05/11/2019 at 12:12 PM
	  ##### This file is created by Jurre de Vries
		
	  // Last updated on 01/11/2019 at 1:44 PM
	  // Last edited by Ronald Hendriks
	  
	  $message = "";
	  $Debug = "";
	
	include "_init/initialize.php";
	
	// Maken van het statement 
		$ID = CheckValue($_GET['ID']); // ID ophalen en bescherming tegen sql injection
		$StatementGet = "SELECT * FROM Articles WHERE ArticleGroupID = $ID";
		
	// Maken van de verbinding
		$Connection = MySqlDo_Connector('Connect'); // Connectie maken en de result array gebruiken als $Connection
		if ($Connection['result']){ // Als er een verbinding is met de database
			$DBconnect = $Connection['connection']; // De verbinding doorgeven aan $DBconnect
			$Debug .= $Connection['debug'];
			$Debug .= "<br>";
			
			// Statement uitvoeren
			$statementRun = $DBconnect->query($StatementGet); // De artikelgroep ophalen
			
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
					echo "<p>" . '<h3 class="inStock">' . $NumberInStock . "</h3>" . "</p>" . "<p>" . '<h3 class="price">'&euro; . $SellingPrice "</h3>" . "</p>";
					echo "<p class="artikelInfo">" . $ArticleGroup, $ArticleID . "</p>";
					echo '</div>';
					echo "<br>";
					
				}
			} else {
				echo "Er is geen artikel gevonden!";
					$ArticleID = $row["ArticleID"];
					$ArticleTitle = $row['ArticleTitle'];
					$ArticleDescription = $row['ArticleDescription'];
					$ArticleGroup = $row['ArticleGroup'];
					$NumberInStock = $row['NumberInStock'];
					$SellingPrice = $row['SellingPrice'];
				}
					
			} else {
		$message .= "Er is geen artikel gevonden!";
		}
		
?>
