<?php
/**
 * The toevoegen_media file adds types of media to the database.
 * 
 * @author Rienan Poortvliet and Jurre de Vries
 * @version 2.0
 */

 if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
	echo '
<div id="toevoegen_media_form">
	<form method="post" action="../process/process_MediaUpload" enctype="multipart/form-data">
		<h1> Media toevoegen </h1>
		<div id="afbeeldinggegevens">
			<label>Afbeelding</label>						<input type="file" name="bestand_uploaden" id="bestand_uploaden">
		</div>
		<h3>Waar wilt u de media plaatsen?</h3>
		<div id="mediagegevens">
			<label>Artikel</label>							<input type="radio" name="artikel" size="40" checked>
			<label>Tips & Tricks</label>					<input type="radio" name="tips_tricks" size="40">
			<label>Overig</label>							<input type="radio" name="overig" size="40">
			<label>Voer het ID van het veld in</label>		<input type="text" name="ID" size="40">
		</div>
		<div id="submittoevoegen_media_form">
			<input type="submit" name="submit" value="Verzenden">
		</div>
	</form>
</div>';
}?>
<?php

// Create connection with Initialize
require('../../_init/initialize.php');

// Write to variable
$Article = ($_POST['artikel']);
$TipsTricks = ($_POST['tips_tricks']);
$Else = ($_POST['overig']);
?>