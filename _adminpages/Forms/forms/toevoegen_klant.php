<!-- 	Geschreven door: Luc Willemse
		Gaat over: formulier, toevoegen klant.
		Laatste update: 18:11, 27-10-2019 door Ronald HM Hendriks
-->
<div id="toevoegen_klant_form">
	<form method="post" action="../process/process_NewCustomer.php">
		<?php if (isset($_GET['result'])){
			echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
		} ?>
		<h1> Toevoegen klant </h1>
		<div id="klantgegevens">
			<label>Klantnummer<span class="redStar">*</span></label>		<input type="text" name="klantnummer"	id="klantnummer" disabled> <!--invoer veld klantnummer-->
			<label>Voornaam<span class="redStar">*</span></label>			<input type="text" name="voornaam"		id="voornaam" required placeholder="Alleen letters en spaties"  	 	pattern="[a-zA-Z\s-]{1,32}" required=""><!--invoer veld voornaam-->
			<label>Achternaam<span class="redStar">*</span></label>		<input type="text" name="achternaam"	id="achternaam" required placeholder="Alleen letters en spaties" pattern="[a-zA-Z\s-]{1,32}" required=""><!--invoer veld achternaam-->
			<label>Geboortedatum<span class="redStar">*</span></label>		<input type="date" name="geboortedag"	id="geboortedag" required><!--invoer veld geboortedag-->
			<label>Man<span class="redStar">*</span></label>				<input type="radio"	name="gender"		id="gender" value="man" checked >			 
			<label>Vrouw<span class="redStar">*</span></label>				<input type="radio"	name="gender"		id="gender"	value="vrouw" >
			<label>Overig<span class="redStar">*</span></label>			<input type="radio"	name="gender"		id="gender" value="overig" required><!--invoer veld gender-->
			<label>Adres<span class="redStar">*</span></label>				<input type="text" name="adres"			id="adres" required placeholder="Alleen letter en getallen" pattern="[0-9a-zA-Z\s-]{1,}">	<!--invoer veld adres-->
			<label>Postcode<span class="redStar">*</span></label>
			<div id="postcodeklantgegevens">
																			<input type="text" maxlength="4"  placeholder="0000" size="4" pattern="[0-9]{4}"	name="postcode1"		id="postcode" required> 
																			<input type="text" maxlength="2" name="postcode2" placeholder="AA" 	 size="2" pattern="[A-Z]{2}" id="postcode"><!--invoer veld postcode-->
			</div>
			<label>Plaats<span class="redStar">*</span></label>			<input type="text" name="plaats"		id="plaats" required	 placeholder="Alleen letters"  				pattern="[a-zA-Z\s-]{1,}"><!--invoer veld plaats-->
			<label>Land<span class="redStar">*</span></label>				<input type="text" name="land"			id="land" required 	placeholder="Alleen letters"  				pattern="[a-zA-Z\s-]{1,}">	<!--invoer veld land-->
			<label>BIC</label>												<input type="text" name="BIC"		size="40" placeholder="Alleen hoofdletters en getallen"		id="BIC"  pattern="[A-Z0-9]{8}">	<!--invoer veld BIC-->
			<label>IBAN<span class="redStar">*</span></label>				<input type="text" name="IBAN"			id="IBAN" required pattern="[A-Z0-9]{18}">	<!--invoer veld IBAN-->
		</div>
		<div id="submittoevoegen_klant_form">
			<input type="submit" name="submit"	id="submit"	value="Aanmaken"> <!--invoer veld bevestigen-->
		</div>
	</form>
</div>