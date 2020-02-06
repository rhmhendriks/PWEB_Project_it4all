<!DOCTYPE HTML>

<html lang="en">
  <head>
	<title>Update function</title>
  </head>
  <body>
	<?php
	
	  function MySqlGeT($ToDo, $OnWhat, $var1, $var2, $var3, $var4, $var5, $var6);
			  // Nu gaan we de MySQL connectie initialiseren
			  // De credentials voor de verbinding meegeven
                  $servername = "localhost";
                  $DBsignonname = "it4alldbuser";
                  $DBkey = "It4llit4all2019!";
                  $DBname = "it4all";
              // Verbinding maken met MySQL
                  $DBconnect = new mysqli($servername, $DBsignonname, $DBkey, $DBname);
			  // Controleren connectie
			  if (!$DBconnect) {
				return die("Connection failed: " . mysqli_connect_error());
			  }
			  
			  // SQL statement voor weergeven record
				  $statement = "UPDATE . """(ArticleTitle, ArticleDescription, NumberInStock, StockPrice, SellingPrice) VALUES ();
				  $statement .= "" . . ;
				  $statement .= "WHERE ArticleID ='" . $ArticleID . "'";
				  $result = mysqli($DBconnect, $ArticleID);
	?>
  </body>
</html>