<?php
/**
 * The add_company file processes the company that must be added.
 * 
 * @author Rienan Poortvliet and Luc Willemse
 * @version 2.0
 */
 if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
	echo '
		<div id="admin_form">
			<form method="post" action="../process/process_AdmCustForm.php"> ';
					 if (isset($_GET['result'])){
						echo '<pre><p style="color:red">' . $_GET['result'] . '</p></pre>'; 
					} 
					echo '
						<h1>Nieuwe klant met account aanmaken</h1> <!-- center of form -->
							<h3> Persoonsgegevens </h3>
							<div id="PersoonsGegevens">
								<label>Voornaam<span class="redStar">*</span></label> 		<input type="text" name="voornaam" id="voornaam" size="40" placeholder="Alleen letters en spaties" pattern="[a-zA-Z\s-]{1,32}" required="">
								<label>Achternaam<span class="redStar">*</span></label> 	<input type="text" name="achternaam" id="achternaam" size="40" placeholder="Alleen letters en spaties" pattern="[a-zA-Z\s-]{1,32}" required="">
								<label>Geboortedatum<span class="redStar">*</span></label>	<input type="date" name="geboortedag" id="geboortedag" size="40" required="">
								<label>Geslacht<span class="redStar">*</span></label>	
								<div id="Geslacht">
									<label>Man</label> 										<input type="radio"	name="gender" id="gender" value="man" required>
									<label>Vrouw</label>									<input type="radio"	name="gender" id="gender" value="vrouw" required>
									<label>Anders</label>									<input type="radio"	name="gender" id="gender" value="overig" required>
								</div>
							</div>
							<h3> Contact en Adresgegevens </h3>
							<div id="AdresGegevens">
								<label>Adres:<span class="redStar">*</span></label>			<input type="text" name="adres" id="adres" size="40" placeholder="Alleen letter en getallen" pattern="[0-9a-zA-Z\s-]{1,}" required="">		
								<label>Postcode:<span class="redStar">*</span></label>
								<div id="Postcode">
																							<input type="text" maxlength="4" name="postcode1" id="postcode" placeholder="0000" size="4" pattern="[0-9]{4}" required=""> 
																							<input type="text" maxlength="2" name="postcode2" id="postcode" placeholder="AA" size="2" pattern="[A-Z]{2}" required="">
								</div>
								<label>Plaatsnaam<span class="redStar">*</span></label>		<input type="text" name="plaats" id="plaats" size="40" placeholder="Alleen letters" pattern="[a-zA-Z\s-]{1,}" required="">
								<label>Land<span class="redStar">*</span></label>			<input type="text" name="land" id="land" size="40" placeholder="Alleen letters" pattern="[a-zA-Z\s-]{1,}" required="">
							</div>
							<h3> Betaalgegevens </h3>
							<div id="BetaalGegevens">
								<label>BIC</label>											<input type="text" name="BIC" id="BIC" size="40" placeholder="Alleen hoofdletters en getallen" pattern="[A-Z0-9]{8}">		
								<label>IBAN<span class="redStar">*</span></label>			<input type="text" name="IBAN" id="IBAN" size="40" placeholder="Alleen hoofdletters en getallen" pattern="[A-Z0-9]{18}" required="">
							</div>
							<h3> Accountgegevens </h3>
							<div id="AccountGegevens">
								<label>Email<span class="redStar">*</span></label>			<input type="email" name="email" id="email"	placeholder="vul hier het e-mailadres in" size="40" pattern="[a-Z0-9._-]+@[a-Z0-9.-]+\.[a-Z]{2,}$" required>
								<label>Wachtwoord<span class="redStar">*</span></label>		<input type="password" name="wachtwoord" placeholder="vul hier het wachtwoord in" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" size="40" required>
								<label>Bevestigen<span class="redStar">*</span></label>		<input type="password" name="wachtwoordb" placeholder="bevestig het wachtwoord" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" size="40" required>
								<label>Two factor enabled?</label>							<input type="checkbox" name="TwoFactor" id="TwoFactor" value="true">
								<label>Admin?</label>										<input type="checkbox" name="IsAdmin" id="IsAdmin" value="true">
								<label>E-mail Pre-Verified?</label>			  				<input type="checkbox" name="MailVerified" id="MailVerified" value="true">
							</div>
							<div id="submitadmin_form">
								<input type="submit" name="submit" value="aanmaken">
							</div>
				</form>
			</div>
	';
				}
				?>