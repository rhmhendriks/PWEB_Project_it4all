<?php

 if (!$_SESSION['loggedin'] == 1){
    header("location:index.php?page=auth&auth=UserNoAccess");
} else {

      #################################################
	  ##### THIS IS THE SHOWTIPSANDTRICKS file	  #####
	  ##### 									  #####
	  ##### This file checks if the tip or trick  #####
	  ##### exists valid and protected against	  #####
	  ##### SQL-injection						  #####
	  #####								 		  #####
	  #####										  #####
	  #################################################
		
	  ##### This file is created on 14/10/2019 at 14:00 PM
	  ##### This file is created by Jurre de Vries
		
	  // Last updated on 11/11/2019 at 9:33 AM
	  // Last edited by Jurre de Vries
	
		$message = "";
		$Debug = "";
	
		// Create a statement
		$ID = CheckValue($_GET['ID']); // ID ophalen en bescherming tegen sql injection
		$StatementGet = "SELECT * FROM TipsandTricks WHERE PageID = $ID";

	
	// Create a connection
		$Connector = MySqlDo_Connector('Connect'); // Connectie maken en de result array gebruiken als $Connection
		if ($Connector['result']){ // Als er een verbinding is met de database
			$DBconnect = $Connector['connection']; // De verbinding doorgeven aan $DBconnect
			$Debug .= $Connection['debug'];
			$Debug .= "<br>";

			// Statement uitvoeren
			$statementRun = $DBconnect->query($StatementGet); // De tips en tricks ophalen

			
			if($statementRun->num_rows > 0) {  // Als er rijen zijn gevonden
			// gegevens gebruiken
				while ($row = $statementRun->fetch_assoc()){ // wanneer er nog ongebruikte data staat in de uitkomt van het statement
					// We schrijven de waarden weg naar variabelen
					$PageID = $row['PageID'];
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
					$Sources = $row['Sources'];

				}
				
			echo	'<div id="tipsTricksDiv">';
			echo		'<h2 class="tipsTricksTitle">';
			echo 		$PageTitle;
			echo		'</h2>';
			echo		'<h5 class="datumAuteur">';
			echo 		$Date . " " . $Author;
			echo		'</h5>';
			echo		'<img src="../_images/NoPic.png">';
			echo		'<br>';
			echo		'<br>';
			echo		'<p class="tipsTricksContent">';
			echo 		$Content;
			echo		'</p>';
			echo		'</p>';
			echo	'</div>';
			echo	'</div>';

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
		echo "Er zijn geen tips en tricks gevonden!";
	}
}
?>