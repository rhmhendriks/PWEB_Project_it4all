<!-- 	Geschreven door: Luc Willemse
		Gaat over: formulier, toevoegen klant.
		Laatste update: 18:11, 27-10-2019 door Ronald HM Hendriks
-->
<form method="post" action="../_php/formulieren/process_NewCustomer.php">
	<fieldset>

		<legend><h1>Toevoegen klant</h1></legend> <!-- titel in de header -->
		<br>
		<?php if (isset($_GET['result'])){
			echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
		} ?>
		<br>
		<pre>Klantnummer:<span class="redStar">*</span>	<input type="text" name="klantnummer"	id="klantnummer" disabled>	</pre> <!--invoer veld klantnummer-->
		<pre>Voornaam:<span class="redStar">*</span>		<input type="text" name="voornaam"		id="voornaam" required placeholder="Alleen letters en spaties"  	 	pattern="[a-zA-Z\s-]{1,32}" required=""></pre><!--invoer veld voornaam-->
		<pre>Achternaam:<span class="redStar">*</span>		<input type="text" name="achternaam"	id="achternaam" required placeholder="Alleen letters en spaties" pattern="[a-zA-Z\s-]{1,32}" required="">	</pre><!--invoer veld achternaam-->
		<pre>Geboortedatum:<span class="redStar">*</span>	<input type="date" name="geboortedag"	id="geboortedag" required>	</pre><!--invoer veld geboortedag-->
		<pre>Man:<span class="redStar">*</span>		<input type="radio"	name="gender"		id="gender" value="man" checked ></pre>				 
		<pre>Vrouw:<span class="redStar">*</span>		<input type="radio"	name="gender"		id="gender"	value="vrouw" ></pre>
		<pre>Overig:<span class="redStar">*</span>		<input type="radio"	name="gender"		id="gender" value="overig" required></pre><!--invoer veld gender-->
		<pre>Adres:<span class="redStar">*</span>			<input type="text" name="adres"			id="adres" required placeholder="Alleen letter en getallen" pattern="[0-9a-zA-Z\s-]{1,}">			</pre><!--invoer veld adres-->
		<pre>Postcode:<span class="redStar">*</span>		<input type="text" maxlength="4"  placeholder="0000" size="4" pattern="[0-9]{4}"	name="postcode1"		id="postcode" required> <input type="text" maxlength="2" name="postcode2" placeholder="AA" 	 size="2" pattern="[A-Z]{2}" id="postcode"></pre><!--invoer veld postcode-->
		<pre>Plaats:<span class="redStar">*</span>			<input type="text" name="plaats"		id="plaats" required	 placeholder="Alleen letters"  				pattern="[a-zA-Z\s-]{1,}">		</pre><!--invoer veld plaats-->
		<pre>Land:<span class="redStar">*</span>			<input type="text" name="land"			id="land" required 	placeholder="Alleen letters"  				pattern="[a-zA-Z\s-]{1,}">			</pre><!--invoer veld land-->
		<pre>BIC:				<input type="text" name="BIC"		size="40" placeholder="Alleen hoofdletters en getallen"		id="BIC"  pattern="[A-Z0-9]{8}">			</pre><!--invoer veld BIC-->
		<pre>IBAN:<span class="redStar">*</span>			<input type="text" name="IBAN"			id="IBAN" required pattern="[A-Z0-9]{18}">			</pre><!--invoer veld IBAN-->
		
		<pre><input type="submit" name="submit"	id="submit"	value="Aanmaken"></pre> <!--invoer veld bevestigen-->

	</fieldset>
</form>