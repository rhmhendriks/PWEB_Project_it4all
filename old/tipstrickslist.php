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
		$StatementGet = "SELECT * FROM TipsandTricks WHERE CategoryID = $ID";
		} else {
			$StatementGet = "SELECT * FROM TipsandTricks";
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
					$PageID = $row["PageID"];
					$PageTitle = $row['PageTitle'];
					$Date = $row['Date'];
					$AuthorID = $row['AuthorID'];

					// Auteurnaam ophalen
					$StatementGetAuthor = "SELECT FirstName, LastName FROM Authors WHERE AuthorID = $AuthorID";
					$statementRunAuthor = $DBconnect->query($StatementGetAuthor); // De auteurnaam ophalen
					while ($rowa = $statementRunAuthor->fetch_assoc()){
						$Author = $rowa['FirstName'] . " " . $rowa['LastName'];
					}


					$CategoryID = $row['CategoryID'];
					$Content = $row['Content'];


					// Content inkorten
					if (strlen($Content) > 850){
						$Content = substr($Content, 0, 850) . "...";
					}

					$Sources = $row['Sources'];
					
					echo '<div id="content">';
					echo '<div id="tipsTricksImage">';
					echo	'<a href="index.php?page=tiptrick&ID=' . $PageID . '"><img src="_images/NoPic.png"></a>';
					echo '</div>';
					
        			echo '<div id="tipsTricksInfo">';
					echo 	'<h2 class="tipsTricksTitleList"><a href="index.php?page=tiptrick&ID=' . $PageID . '">' . $PageTitle . '</a></h2>';
					echo 	'<h5 class="datumAuteurList">' . $Date . " " . $Author . '</h5>';
					echo 	'<p class="tipsTricksContentList">';
					echo 		$Content;
            		echo 	'</p>';
        			echo '</div>';
					echo '</div>';
					echo '</div>';
    				echo '<hr>';

			/*
					// De pagina opmaken
					echo '<div id="tipsTricksDiv">';
					echo	'<a href="index.php?page=tiptrick&ID=' . $PageID . '"><img src="_images/NoPic.png"></a>';
					echo 		'<h2 class="tipsTricksTitle">'; 
					echo 	$PageTitle;
					echo 		'</h2>';
					echo 		'<h5 class="datumAuteur">';
					echo 	$Date . "," . $AuthorID;
					echo 		'</h5>';
					echo 		'<img src="C:\Users\riena\Pictures\Saved Pictures\Cat wallpaper.jpg">';
					echo 		'<p class="tipsTricksContent">';
					echo 	$Content;
					echo 		'</p>';
					echo 		'</p>';
					echo '</div>';
					echo '<hr>';
					*/
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