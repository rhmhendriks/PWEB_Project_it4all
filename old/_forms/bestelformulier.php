<!DOCTYPE html>
<html lang="nl">
<head>
<title>Bestelformulier</title>
<style>

</style>
</head>
<body>
  <!-- This form takes care of the purchase data which has to be transported to the database -->
  <!-- Last updated on 23 oktober 2019 on 10:10 -->

  <form method="post">
	<fieldset>
	<legend><h2>Bestelformulier</h2></legend>
  <h4>Waar wil je het product bezorgd hebben?</h4>
	<hr>
	<pre>Straatnaam en huisnummer 	<input type="text" name="adres" size="40"  placeholder="Vul hier in" required></pre>
	<pre>Postcode 			<input type="text" name="postcode" size="40" placeholder="ABCD 01" required></pre>
	<pre>Woonplaats 			<input type="text" name="woonplaats" size="40"  placeholder="Vul hier in" required></pre>
	<br>
  <h4>Hoe ben je te bereiken?</h4>
	<hr>
	<pre>Voornaam			<input type="text" name="voornaam" size="40" placeholder="Vul in bijv. Hans" required></pre>
	<pre>Achternaam 			<input type="text" name="achternaam" size="40" placeholder="Vul in bijv. Veltman" required></pre>
	<pre>E-mailadres 			<input type="text" name="emailadres" size="40" placeholder="Vul in bijv. test@it4all.nl" required></pre>
	<pre>Telefoonnummer			<input type="text" name="telefoonnummer" size="40" placeholder="Vul in bijv. 06 12345678" required></pre>
	<pre>Bedrijfsnaam (optioneel)	<input type="text" name="bedrijfsnaam" placeholder="Vul in indien nodig" size="40"></pre>
	<hr>
		<p align="left">
		<input type="submit" name="verzenden" size="40" >
	</fieldset>
	</form>
	<?php

		$Firstname = ($_POST['voornaam']);
		$Lastname = ($_POST['achternaam']);
		$Address = ($_POST['adres']);
		$PostalCode = ($_POST['postcode'])
		$City = ($_POST['woonplaats'])
		$EMail = ($_POST['emailadres'])
		// ($_POST['telefoonnummer'])
		// ($_POST['bedrijfsnaam'])


	?>
  </body>
</html>