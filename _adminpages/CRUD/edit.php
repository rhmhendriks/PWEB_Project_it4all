<!DOCTYPE html>
<html>
<head>
	<title>edit</title>
</head>
<body>

	<?php

	if (isset($_GET['table'])) {
	 	
	  

		if ($_GET['table'] == 'Articles') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'Articles', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden het Artikel niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'ArticleGroups') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'ArticleGroups', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de artikel groep niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'Authors') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'Authors', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de author niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'ContactForm') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'ContactForm', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden het contact formulier niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'Customers') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'Customers', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de klant niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'feedback') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'feedback', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de feedback niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'OrderRules') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'OrderRules', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de bestellings regels niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'Orders') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'Orders', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de bestelling niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'TipsandTricks') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'TipsandTricks', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de tip en trick niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'TipsTricksCategory') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'TipsTricksCategory', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de tip en trick categorie niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'Users') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'Users', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de gebruiker niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} elseif ($_GET['table'] == 'ImagesVideos') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'ImagesVideos', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de foto of video niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		}



} else {
	$message = "Er is geen tabel meegegeven";
 }

	?>


</body>
</html>