<!DOCTYPE HTML>

<html lang="en">
  <head>
	<title>Get function</title>
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
			  } // (!DBconnect) 20
			  
			  // SQL statement voor weergeven record
			  if (isset($OnWhat == "Articles") { // In geval Article betreffend
				  $statement = "SELECT * FROM it4all";
				  $statement .= "WHERE ArticleID ='" . $ArticleID . "'";
				  $result = mysqli($DBconnect, $ArticleID);
			  } // (isset($OnWhat == "Article") 24
			  elseif (isset($OnWhat == "Customers") { // In geval Customers betreffend
				  $statement = "SELECT * FROM it4all";
				  $statement .= "WHERE CustomerID ='" . $CustomerID . "'";
				  $result = mysqli($DBconnect, $CustomerID);
			  } // (isset($OnWhat == "Tips Tricks") 30
			  elseif (isset($OnWhat == "Tips Tricks") { // In geval Customers Tips Tricks betreffend
					
			  // Controleren 	
				  if(isset($OnWhat == Article)) {
				  return($ArticleTitleField, $ArticleDescriptionField, $NumberInStockField, $SellingPriceField, $StockPriceField);
				  }
			  }
	?>
  </body>
</html>