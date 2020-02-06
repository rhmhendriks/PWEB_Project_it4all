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
		
	  // Last updated on 01/11/2019 at 1:44 PM
	  // Last edited by Ronald Hendriks
	  
	  $message = "";
	  $Debug = "";

	// Maken van het statement 
		if (isset($_GET['ID'])){
		$ID = CheckValue($_GET['ID']); // ID ophalen en bescherming tegen sql injection
		$StatementGet = "SELECT * FROM Articles WHERE ArticleGroup = $ID";
		} else {
			$StatementGet = "SELECT * FROM Articles ";
		}
		
	// Maken van de verbinding
		$Connection = MySqlDo_Connector('Connect'); // Connectie maken en de result array gebruiken als $Connection
		if ($Connection['result']){ // Als er een verbinding is met de database
			$DBconnect = $Connection['connection']; // De verbinding doorgeven aan $DBconnect
			$Debug .= $Connection['debug'];
			$Debug .= "<br>";
			
			// Statement uitvoeren
			$statementRun = $DBconnect->query($StatementGet); // De artikelgroep ophalen
			
			if($statementRun->num_rows > 0) {  // Als er rijen zijn gevonden
			// gegevens gebruiken
				while ($row = $statementRun->fetch_assoc()){ // wanneer er nog ongebruikte data staat in de uitkomt van het statement
					// We schrijven de waarden weg naar variabelen
					$ArticleID = $row["ArticleID"];
					$ArticleTitle = $row['ArticleTitle'];
					$ArticleDescription = $row['ArticleDescription'];
					if (strlen($ArticleDescription) > 850){
						$ArticleDescription = substr($ArticleDescription, 0, 850) . "...";
					}
					$ArticleGroup = $row['ArticleGroup'];
					$NumberInStock = $row['NumberInStock'];
					$SellingPrice = $row['SellingPrice'];
					$ArticleID = $row['ArticleID'];
					
					// Vooraad controleren
					if ($NumberInStock > 25){
						$StockSentance = '<h3 class="inStockList">Er zijn ' . $NumberInStock . 'exemplaren beschikbaar!</h3>';
					} elseif ($NumberInStock < 25 && $NumberInStock >= 1){
						$StockSentance = '<h3 class="lowInStockList">Er zijn ' . $NumberInStock . 'exemplaren beschikbaar!</h3>';
					} else  {
						$StockSentance = '<h3 class="outOfStockList">Er zijn geen exemplaren meer beschikbaar!</h3>';
					}
					
					// De pagina opmaken
					echo '<br>';
					echo '<div id="content">';
					echo	'<div id="imageDiv">';
					echo		'<a href="index.php?page=article&ID=' . $ArticleID . '"><img src="_images/NoPic.png"></a>';
					echo		'<p class="artikelInfoList">Artnr.' .  $ArticleID . '</p>';
					echo	'</div>';
						
					echo	'<div id="infoDiv">';
					echo		'<h1 class="articleTitleList"><a class="articleTitleListA" href="index.php?page=article&ID=' . $ArticleID . '">' . $ArticleTitle . '</a></h1>';
					echo		$StockSentance;
					echo		'<h3 class="priceList">&euro;' . $SellingPrice . '</a></h3>';
					echo		'      <form action="_Ordering/add.php" class="AtricleForm" method="post">
														  <input type="hidden" name="ArticleID" id="ArticleID" value="' . $ArticleID . '">
										<b>Aantal:</b>    <input type="text" name="NumberBought" size="2" maxlength="2" value="1">' . " " . '
										<input type="submit" value="Toevoegen aan winkelwagen" />
										</form>';
					echo		'<p class="articleContentList">';
					echo		$ArticleDescription;
					echo		'</p>';
					echo	'</div>';
					echo '</div>';
					echo '</div>';
					echo '<hr>';
					
					/*
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
					*/
				}
			} else {
				echo "Er is geen artikel gevonden!";
					$ArticleID = $row["ArticleID"];
					$ArticleTitle = $row['ArticleTitle'];
					$ArticleDescription = $row['ArticleDescription'];
					$ArticleGroup = $row['ArticleGroup'];
					$NumberInStock = $row['NumberInStock'];
					$SellingPrice = $row['SellingPrice'];
					$ArticleID = $row['ArticleID'];
				}
					
			} else {
		$message .= "Er is geen artikel gevonden!";
		}
		
?>