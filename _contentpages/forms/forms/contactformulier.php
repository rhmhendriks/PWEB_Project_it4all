<!--

This is the contact form

The author of this file is Jurre de Vries
This file is created on 22/10/2019 at 10:30 AM

Last updated by Rienan Poortvliet
Last updated on 12/11/2019 at 15:56 PM

 -->
<div id="contact_form">
	<form method="post" action="../_php/formulieren/process_contactform.php">
		<?php if (isset($_GET['result'])){
			echo '<p style="color:red">' . $_GET['result'] . '</p>'; 
		} ?>
		<h1>Contactformulier</h1>
		<h3>Wilt u contact met ons zoeken? Vul ons formulier in!</h3>
		<div id="contactformgegevens">
			<label>Naam<span class="redStar">*</span></label>					<input type="text" name="naam" size="40" placeholder="Vul alleen grote- en kleine letters in" pattern="[a-zA-Z-' ]{0,255}" required="">
			<label>Telefoonnummer<span class="redStar">*</span></label>			<input type="text" name="telefoonnummer" size="40" placeholder="Vul alleen cijfers in" pattern="[0-9]{0,20}" required="">
			<label>E-mailadres<span class="redStar">*</span></label>			<input type="email" name="emailadres" size="40" placeholder="Vul een geldig emailadres in" pattern="[a-Z0-9._-]+@[a-Z0-9.-]+\.[a-Z]{2,}$" required="">
			<label>Vraag en/of opmerking<span class="redStar">*</span></label>	<textarea id="vraag_opmerking" name="vraag_opmerking" rows="5" cols="40" pattern="[a-zA-Z.,:()?!-%/]" required="">Hier komt je bericht!</textarea>
		</div>
		<div id="submitcontact_form">
		<input type="submit" name="verzenden" value="verzenden" size="40">
		</div>
	</form>
</div>
