<!-- 	Geschreven door: Luc Willemse
		Gaat over: formulier, toevoegen klant.
		Laatste update: 21:02 18-01-2020 door Ronald Hendriks

		Wijzigingen: Verwijzing in POSt actie aangepast aan de nieuwe structuur.

-->
<div id="SignUp_form">
	<form method="post" action="../_AuthSys/Controllers/SignUp_Controller.php">
		<h1> Registreren als klant </h1>
		<?php 
		session_start();
		if (isset($_SESSION['message_su'])){
			echo '<p style="color:Green">' . $_SESSION['message_su'] . '</p>'; 
		} if (DebugisOn && isset($_SESSION['Debug_su'])){
			echo '<p style="color:red">' . $_SESSION['Debug_su'] . '</p>'; 
		}
		 ?>
		<h3> Persoonsgegevens </h3>
		<div id="persoonsgegevenssignup">
			<label>Voornaam<span class="redStar">*</span></label>			<input 		type="text" 	name="voornaam"		id="voornaam" 		size="40" placeholder="Alleen letters en spaties"  	 	pattern="[a-zA-Z\s-]{1,32}" required="">		
			<label>Achternaam<span class="redStar">*</span></label>			<input 	type="text" 	name="achternaam"	id="achternaam" 	size="40" placeholder="Alleen letters en spaties" pattern="[a-zA-Z\s-]{1,32}"  required="">
			<label>Geboortedatum<span class="redStar">*</span></label>		<input 	type="date" 	name="geboortedag"	id="geboortedag" 	size="40" 		required="">							
			<label>Geslacht<span class="redStar">*</span></label>
			<div id="geslachtsignup">
				<label>Man</label>				 <input 			type="radio"	name="gender"		id="gender" 		value="man" 	required>		
				<label>Vrouw</label>			 <input 			type="radio"	name="gender"		id="gender"			value="vrouw" 	required>		
				<label>Anders</label>			 <input 		type="radio"	name="gender"		id="gender" 		value="overig" 	required>
			</div>
		</div>
		<h3> Contact en Adresgegevens </h3>
		<div id="adresgegevenssignup">
			<label>E-mail<span class="redStar">*</span></label>				<input 		type="email" 	name="email"		id="email"			size="40"	pattern="[a-Z0-9._-]+@[a-Z0-9.-]+\.[a-Z]{2,}$" required>
			<label>Adres<span class="redStar">*</span></label>				<input 		type="text" 	name="adres"		id="adres"	 		size="40" placeholder="Alleen letter en getallen" pattern="[0-9a-zA-Z\s-]{1,}" required="">		
			<label>Postcode<span class="redStar">*</span></label>
			<div id="postcodesignup">
																			<input 		type="text" 	maxlength="4" 		name="postcode1"	id="postcode" placeholder="0000" size="4" pattern="[0-9]{4}" required=""> 
																			<input 		type="text" 	maxlength="2" 		name="postcode2" 	id="postcode" placeholder="AA" 	 size="2" pattern="[A-Z]{2}" required></pre>
			</div>
			<label>Plaatsnaam<span class="redStar">*</span></label>			<input 		type="text" 	name="plaats"			id="plaats" 			size="40" placeholder="Alleen letters"  				pattern="[a-zA-Z\s-]{1,}" required="">
			<label>Land<span class="redStar">*</span></label>				<input 		type="text" 	name="land"			id="land" 			size="40" placeholder="Alleen letters"  				pattern="[a-zA-Z\s-]{1,}" required="">
		</div>
		<h3> Betaalgegevens </h3>
		<div id="betaalgegevenssignup">
			<label>BIC</label>												<input 		type="text" 	name="BIC"			id="BIC" 			size="40" placeholder="Alleen hoofdletters en getallen" pattern="[A-Z0-9]{8}">		
			<label>IBAN<span class="redStar">*</span></label>				<input 		type="text" 	name="IBAN"			id="IBAN" 			size="40" placeholder="Alleen hoofdletters en getallen" pattern="[A-Z0-9]{18}" required=""><!--invoer veld IBAN-->
			<p><input type="checkbox" name="PrivacyStatement" id="PrivacyStatement" value="Accepted">	Ik ga akkoord met de  <a href="../statement.php?statement=privacy">algemene privacy voorwaarden</a><span class="redStar">*</span><p>
		</div>
		<div id="submitSignUp_form">
			<input type="submit" name="submit"	id="submit"	value="Registreren"> <!--invoer veld bevestigen-->
		</div>
	</form>
</div>