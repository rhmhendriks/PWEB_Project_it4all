<!-- 	Geschreven door: Luc Willemse
		Gaat over: formulier, toevoegen klant.
		Laatste update: 18:08, 30-10-2019 door Ronald HM Hendriks

		Wijzigingen: Formulierstijl samengetrokken met adminform. Formulier is nu tevens het registratieformulier, 
					 hier is voor gekozen in verband met het gebruikersgemak van de eindgebruiker. 
-->
<form method="post" action="../_php/Auth/SignUp_Controller.php">
	<fieldset>

		<legend><h1>Registreren als klant</h1></legend> <!-- titel in de header -->
		<br>
		<?php 
		session_start();
		if (isset($_SESSION['message_su'])){
			echo '<p style="color:Green">' . $_SESSION['message_su'] . '</p>'; 
		} if (DebugisOn && isset($_SESSION['Debug_su'])){
			echo '<p style="color:red">' . $_SESSION['Debug_su'] . '</p>'; 
		}
		 ?>
		<br>
		<pre><h3> Persoonsgegevens </h3></pre>
		<br>
		<pre>Voornaam:<span class="redStar">*</span>		<input 		type="text" 	name="voornaam"		id="voornaam" 		size="40" placeholder="Alleen letters en spaties"  	 	pattern="[a-zA-Z\s-]{1,32}" required="">		Achternaam:<span class="redStar">*</span>	<input 	type="text" 	name="achternaam"	id="achternaam" 	size="40" placeholder="Alleen letters en spaties" pattern="[a-zA-Z\s-]{1,32}"  required=""></pre>
		<pre>Geboortedatum:<span class="redStar">*</span>	<input 	type="date" 	name="geboortedag"	id="geboortedag" 	size="40" 		required="">							Gelacht:<span class="redStar">*</span>		Man <input 			type="radio"	name="gender"		id="gender" 		value="man" 	required>		Vrouw <input 			type="radio"	name="gender"		id="gender"			value="vrouw" 	required>		Anders <input 		type="radio"	name="gender"		id="gender" 		value="overig" 	required></pre>
		<br>
		<br>
		<pre><h3> Contact en Adresgegevens </h3></pre>
		<br>
		<pre>Adres:<span class="redStar">*</span>			<input 		type="text" 	name="adres"		id="adres"	 		size="40" placeholder="Alleen letter en getallen" pattern="[0-9a-zA-Z\s-]{1,}" required="">		Email:<span class="redStar">*</span>		<input 		type="email" 	name="email"		id="email"			size="40"	pattern="[a-Z0-9._-]+@[a-Z0-9.-]+\.[a-Z]{2,}$" required></pre>
		<pre>Postcode:<span class="redStar">*</span>		<input 		type="text" 	maxlength="4" 		name="postcode1"	id="postcode" placeholder="0000" size="4" pattern="[0-9]{4}" required=""> <input 	 								type="text" 	maxlength="2" 		name="postcode2" 	id="postcode" placeholder="AA" 	 size="2" pattern="[A-Z]{2}" required></pre>
		<pre>Plaatsnaam:<span class="redStar">*</span>		<input 		type="text" 	name="plaats"			id="plaats" 			size="40" placeholder="Alleen letters"  				pattern="[a-zA-Z\s-]{1,}" required=""></pre>
		<pre>Land:<span class="redStar">*</span>			<input 		type="text" 	name="land"			id="land" 			size="40" placeholder="Alleen letters"  				pattern="[a-zA-Z\s-]{1,}" required=""></pre>
		<br>
		<br>
		<pre><h3> Betaalgegevens </h3></pre>
		<br>
		<pre>BIC:				<input 		type="text" 	name="BIC"			id="BIC" 			size="40" placeholder="Alleen hoofdletters en getallen" pattern="[A-Z0-9]{8}">		IBAN:<span class="redStar">*</span>		<input 		type="text" 	name="IBAN"			id="IBAN" 			size="40" placeholder="Alleen hoofdletters en getallen" pattern="[A-Z0-9]{18}" required=""></pre><!--invoer veld IBAN-->
		<br>
		<br>
		<br>
		<pre><input type="checkbox" name="PrivacyStatement" id="PrivacyStatement" value="Accepted">	Ik ga akkoord met de  <a href="../statement.php?statement=privacy">algemene privacy voorwaarden</a><span class="redStar">*</span><pre>
		<pre><input type="submit" name="submit"	id="submit"	value="Registreren"></pre> <!--invoer veld bevestigen-->

	</fieldset>
</form>