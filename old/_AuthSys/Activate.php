<!-- 	Geschreven door: Rienan Poortvliet
		Gaat over: Activatieformulier (voormalig registratieformulier)
		Laatste update: 18:11, 30-10-2019 door Ronald HM Hendriks

		Wijzigingen: Formulier is nu het activatieformulier, NewCustomer.php is het registratieformulier
                     hier is voor gekozen in verband met gebruikersgemak voor de eindgebruiker.  
-->
<?php session_start(); include "_php/Auth/Activation_Initializer.php"; ?>
<form method="post" action="../_php/Auth/Activation_Controller.php"> 
        <fieldset>
            <legend><h1>Klantaccount Activeren</h1></legend>
                <br>
                <?php echo '<p style="color:Red">' . $message . '</p>'; if (DebugisOn) {echo '<p style="color:Red">' . $debug . '</p>';} ?>
                <?php if (isset($_SESSION['Message_Act'])){ echo '<p style="color:Red">' . $_SESSION['Message_Act'] . '</p>'; } if (DebugisOn && isset($_SESSION['Debug_Act'])){ echo '<p style="color:Red">' . $_SESSION['Debug_Act'] . '</p>';}?>
                <br>
                <input type=hidden name="token" id="token" value="<?php echo $_GET['token'];?>">
                <pre>Klantnummer:<span class="redStar">*</span>		    <input 		type="text" 	name="klantnummer"			id="klantnummer" 			size="40" value="<?php echo $CustomerID; ?>" required disabled></pre>
	        <pre>E-mailadres:<span class="redStar">*</span>			    <input 		type="email" 	name="emailadres"			id="emailadres" 			size="40" value="<?php echo  $EmailAddress; ?>" required disabled></pre>
                <pre>Activatiecode:<span class="redStar">*</span>		    <input 		type="password" 	name="activatiecode"			id="activatiecode" 			size="40" required></pre>
	        <pre>Wachtwoord:<span class="redStar">*</span>			    <input 		type="password" 	name="wachtwoord"			id="wachtwoord" 			size="40" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" placeholder="Bevat minimaal 10 karakters waarvaan minimaal 1 hoofdletter en 1 cijfer." required></pre>
                <pre>Wachtwoord bevestigen:<span class="redStar">*</span>    <input 		type="password" 	name="wachtwoordbevestig"			id="wachtwoordbevestig" 			size="40" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" placeholder="Bevat minimaal 10 karakters waarvaan minimaal 1 hoofdletter en 1 cijfer." required></pre>
                <input type="submit" class= "btn" value="Activeren" name="Activeren" id="Activeren"><br />
        </fieldset>
</form>