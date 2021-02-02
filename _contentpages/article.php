<?php

      #################################################
	  ##### THIS IS THE SHOWARTICLE file		  #####
	  ##### 									  #####
	  ##### This file checks if the article 	  #####
	  ##### exists. It also checks if the article #####
	  ##### is valid and protected against		  #####
	  #####	SQL-injection						  #####
	  #####										  #####
	  #################################################
		
	  ##### This file is created on 14/10/2019 at 14:00 PM
	  ##### This file is created by Jurre de Vries
		
	  // Last updated on 12/11/2019 at 8:57 PM
	  // Last edited by Jurre de Vries
	  
		$message = "";
		$Debug = "";

	// Create a statement
		$ID = CheckValue($_GET['ID']); // Get ID and protect against sql injection
		$StatementGet = "SELECT * FROM Articles WHERE ArticleID = $ID";
	
	// Create a connection
		$Connection = MySqlDo_Connector('Connect'); // Create the connection, use the result array as $Connection
		if ($Connection['result']){ // If there is a connection with the database database
			$DBconnect = $Connection['connection']; // Pass around the connection to $DBconnect
			$Debug .= $Connection['debug'];
			$Debug .= "<br>";

			// Execute the statement
			$statementRun = $DBconnect->query($StatementGet); // Get the article
			
			if($statementRun->num_rows >0) {  // If rows are found
			// Get the data
				while ($row = $statementRun->fetch_assoc()){ // When unused data is found in the statement
					// We write the values to variables
					$ArticleID = $row["ArticleID"];
					$ArticleTitle = $row['ArticleTitle'];
					$ArticleDescription = $row['ArticleDescription'];
					$ArticleGroup = $row['ArticleGroup'];
					// Get the author name
					$StatementGetCatTitle = "SELECT FirstName, LastName FROM Authors WHERE AuthorID = $ArticleGroup";
					$StatementGetCatTitle = $DBconnect->query($StatementGetCatTitle); // Get the author name
					while ($rowa = $StatementGetCatTitle->fetch_assoc()){
						$GroupTitle = $rowa['FirstName'] . " " . $rowa['LastName'];
					}

					$NumberInStock = $row['NumberInStock'];

					// Check the stock
					if ($NumberInStock > 25){
						$StockSentance = '<h3 class="inStockList">Er zijn ' . $NumberInStock . ' exemplaren beschikbaar!</h3>';
					} elseif ($NumberInStock < 25 && $NumberInStock >= 1){
						$StockSentance = '<h3 class="lowInStockList">Er zijn ' . $NumberInStock . ' exemplaren beschikbaar!</h3>';
					} else  {
						$StockSentance = '<h3 class="outOfStockList">Er zijn geen exemplaren meer beschikbaar!</h3>';
					}
					
					$SellingPrice = $row['SellingPrice'];
				}
				
				// Get the page
					
					echo	  '<h1 class="articleTitle">';
					echo	  $ArticleTitle;
					echo	  '</h1>';
					echo	'<div id="leftColumn">';
					echo	  '<img src="_images/NoPic.png">';
					echo		'<p class="artikelInfo">';
					echo		$GroupTitle . " " . $ArticleID; 
					echo		'</p>';
					echo	 '</div>';
					echo	 '<div class="rightColumn">';
					echo	    $StockSentance;
					echo	  '<h3 class="priceList">';
					echo 		"&euro;$SellingPrice";
					echo	  '</h3>';
					echo	'<div id="temporaryform">';
					echo	  '<form class="AtricleForm" action="../_Ordering/cart/add.php" method="post">';
					echo			'<b>Aantal:</b>';
					echo 			'<input type="text" name="NumberBought" size="2" maxlength="2" value="1"> ';
					echo			'<input type="submit" value="Toevoegen aan winkelwagen" />';
					echo	  '</form>';
					echo 	'</div>';
					echo   		'<p class="articleContent">' . $ArticleDescription . '</p>';
					echo 	'</div>';
					
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