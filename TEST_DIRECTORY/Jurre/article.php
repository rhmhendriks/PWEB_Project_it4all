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
	
		echo "<img src="/../_images/nopic.png" alt="Geen afbeelding gevonden">";
	
	  include "_init/initialize.php";
	
	// Maken van het statement 
		$ID = CheckValue($_GET['ID']); // ID ophalen en bescherming tegen sql injection
		$StatementGet = "SELECT * FROM Articles WHERE ArticleID = $ID";
	
	// Maken van de verbinding
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
				
				// De pagina opmaken
					
					echo	  '<h1 class="articleTitle">';
					echo	  $ArticleTitle;
					echo	  '</h1>';
					echo	'<div id="leftColumn">';
					echo	  '<img src="_images/NoPic.png">';
					echo		'<p class="artikelInfo">';
					echo		$ArticleGroup && $ArticleID; 
					echo		'</p>';
					echo	 '</div>';
					echo	 '<div class="rightColumn">';
					echo	    '<h3 class="inStock">';
					echo 		$NumberInStock;
					echo		'</h3>';
					echo	  '<h3 class="price">';
					echo 		"&euro;$SellingPrice;,-";
					echo	  '</h3>';
					echo	  '<form action="_Ordering/add.php" method="post">';
					echo			'<b>Aantal:</b>';
					echo 			'<input type="text" name="NumberBought" size="2" maxlength="2" value="1"><br>';
					echo			'<input type="submit" value="Toevoegen" />';
					echo	  '</form>';
					echo   		'<p class="articleContent"> $ArticleDescription; </p>';
					echo 	'</div>';
					echo '<hr>';
					
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
	
<!--  include('_php/showarticle.php') 
<div id="content">
      <h1 class="articleTitle"> echo $ArticleTitle; </h1>
	<div id="leftColumn">
      <img src="C:\Users\riena\Pictures\Saved Pictures\Cat%20wallpaper.jpg">
	  <p class="artikelInfo"> echo $ArticleGroup && $ArticleID; </p>
	</div>
	<div class="rightColumn">
	  <h3 class="inStock"> echo $NumberInStock; </h3>
      <h3 class="price">&euro;  echo $SellingPrice; ,-</h3> 
      <form action="_Ordering/add.php" method="post">
            <b>Aantal:</b>    <input type="text" name="NumberBought" size="2" maxlength="2" value="1"><br>
            <input type="submit" value="Toevoegen" />
      </form>
	  <p class="articleContent">  echo $ArticleDescription;  </p>     
	 </div>
</div> */ -->