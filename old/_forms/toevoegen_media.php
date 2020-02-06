<!--

This is the file to add types of media to the database

The author of this file is Jurre de Vries
This file is created on 23/10/2019 at 10:30 AM

Last updated by Jurre de Vries
Last updated on 23/10/2019 at 4:49 PM

 -->

<form method="post" action="../_php/formulieren/process_MediaUpload" enctype="multipart/form-data">

<fieldset>
    <legend><h2>Foto toevoegen</h2></legend>
      <pre>Afbeelding               <input type="file" name="bestand_uploaden" id="bestand_uploaden"></pre>

      <h2>Waar wilt u de media plaatsen?</h2>
      <input type="radio" name="artikel" size="40" checked>Artikel
      <input type="radio" name="tips_tricks" size="40">Tips & Tricks
      <input type="radio" name="overig" size="40">Overig

      <pre>Voer het ID van het veld in <input type="text" name="ID" size="40"></pre>
      <hr>
      <p align="right">
      <input type="submit" name="submit" />
</p>
</fieldset>
</form>
<?php

// Verbinding met Initialize vaststellen
require('../_init/initialize.php')

// wegschrijven naar variabele
$Article = ($_POST['artikel'])
$TipsTricks = ($_POST['tips_tricks'])
$Else = ($_POST['overig'])

?>