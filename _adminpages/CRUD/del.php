
	<?php
	/**
	 * The del file deletes records from the database. It will be used with CRUD.
	 * 
	 * @author Ronald Hendriks 
	 * @version 2.0
	 */
	if (isset($_GET['table'])) {
	 	
	  

		if ($_GET['table'] == 'AdminForm') {
			if (isset($_GET['ID'])){
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', 'Customer', $_GET['ID']);

			if($delaction['result']){
				$message = "Het Artikel met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden het Artikel niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
		} else {
				$table = CheckValue($_GET['table']);
				$ID = CheckValue($_GET['ID']);
				$delaction = mysqldo('Delete', $table, $ID);

			if($delaction['result']){
				$message = "Het $table met ID $ID is verwijderd!<br />";
				$debug = $delaction['debug'];
			} else {
				$message = "We konden de artikel groep niet verwijderen";
				$debug = $delaction['debug'];
			}
			}
} else {
	$message = "Er is geen tabel meegegeven";
 }

 $_SESSION['CRUDMES'] = $message;
 $_SESSION['CRUDDEB'] = $debug;

 header('Location: ' . $_SERVER['HTTP_REFERER']);

	?>