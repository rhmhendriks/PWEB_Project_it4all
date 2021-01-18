<!--

This is the file to add types of media to the database

The author of this file is Jurre de Vries
This file is created on 23/10/2019 at 10:30 AM

Last updated by Rienan Poortvliet
Last updated on 12/11/2019 at 20:54 PM

 -->
 <?php
 if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
	echo '
<div id="toevoegen_media_form">
	<form method="post" action="../_php/formulieren/process_MediaUpload" enctype="multipart/form-data">
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

// Verbinding met Initialize vaststellen
require('../_init/initialize.php');

// wegschrijven naar variabele
$Article = ($_POST['artikel']);
$TipsTricks = ($_POST['tips_tricks']);
$Else = ($_POST['overig']);
?>