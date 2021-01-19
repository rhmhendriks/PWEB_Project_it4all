<!-- 	Geschreven door: Rienan Poortvliet
		Gaat over: Activatieformulier (voormalig registratieformulier)
		Laatste update: 07:44, 13-11-2019 door Rienan Poortvliet

		Wijzigingen: Formulier is nu het activatieformulier, NewCustomer.php is het registratieformulier
                     hier is voor gekozen in verband met gebruikersgemak voor de eindgebruiker.  
-->
<div id="Activate_form">
	<?php session_start(); include "../../_AuthSys/Controllers/Activation_Initializer.php"; ?>
	<form method="post" action="../../_AuthSys/Controllers/Activation_Controller.php">
		<h1> Activatieformulier </h1>
        <?php echo '<p style="color:Red">' . $message . '</p>'; if (DebugisOn) {echo '<p style="color:Red">' . $debug . '</p>';} ?>
        <?php if (isset($_SESSION['Message_Act'])){ echo '<p style="color:Red">' . $_SESSION['Message_Act'] . '</p>'; } if (DebugisOn && isset($_SESSION['Debug_Act'])){ echo '<p style="color:Red">' . $_SESSION['Debug_Act'] . '</p>';}?>
        <div id="activatiegegevens">
            																		<input type=text name="token" id="token" value="<?php echo $_GET['token'];?>">
            <label>Klantnummer<span class="redStar">*</span></label>				<input 		type="text" 	name="klantnummer"			id="klantnummer" 			size="40" value="<?php echo $CustomerID; ?>" required disabled>
	        <label>E-mailadres<span class="redStar">*</span></label>	    		<input 		type="email" 	name="emailadres"			id="emailadres" 			size="40" value="<?php echo  $EmailAddress; ?>" required disabled>
        	<label>Activatiecode<span class="redStar">*</span></label>	    		<input 		type="password" 	name="activatiecode"			id="activatiecode" 			size="40" required>
	        <label>Wachtwoord<span class="redStar">*</span></label>		    		<input 		type="password" 	name="wachtwoord"			id="wachtwoord" 			size="40" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" placeholder="Bevat minimaal 10 karakters waarvaan minimaal 1 hoofdletter en 1 cijfer." required>
            <label>Wachtwoord bevestigen<span class="redStar">*</span></label>   	<input 		type="password" 	name="wachtwoordbevestig"			id="wachtwoordbevestig" 			size="40" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" placeholder="Bevat minimaal 10 karakters waarvaan minimaal 1 hoofdletter en 1 cijfer." required>
		</div>
		<div id="submitActivate_form">
			<input type="submit" class= "btn" value="Activeren" name="Activeren" id="Activeren">
		</div>
	</form>
</div>