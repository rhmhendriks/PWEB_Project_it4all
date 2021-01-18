<!DOCTYPE HTML>
<html lang="en">
  <head>
	<title>Betaalformulier</title>
	<style>
	table,td {
		  border: 1px solid black;
	}
	</style>	
  </head>
  <body>
  <!-- This form takes care of the payment data which has to be transported to the database -->
  <!-- Last updated on 23 oktober 2019 on 10:10 -->
	<form method="post">
	<fieldset>
	<legend><h2>Betaalformulier</h2></legend>
     <h4>Hoe wil je betalen?</h4>
	<hr>
		<pre>BIC-nummer(optioneel)		<input type="text" name="bicnummer" size="40" placeholder="Vul uw BIC in" required></pre>
		<pre>Bankrekeningnummer		<input type="text" name="bankrekeningnummer" size="40" placeholder="Vul uw bankrekeningnummer in" required></pre>
		<pre>Overmaken naar			<input type="text" name="overmaaknummer" size="40" placeholder="Standaard NL00 RABO 0123 4567 89" required></pre>
	<hr>
	<p align="left">
	<input type="submit" name="verzenden" size="40" >
	</fieldset>
	</form>
	<?php

	$BIC = ($_POST['bicnummer']);
	$IBAN = ($_POST['bankrekeningnummer']);
	$IBAN .= ($_POST['overmaaknummer']);

	?>
  </body>
</html>