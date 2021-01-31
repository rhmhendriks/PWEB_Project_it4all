<?php session_start() ?>
    <div id="2FAchoice">
        <form method="post" action="../Controllers/2ndChoiceController.php" class="authenticationforms-container">
        <h1> Tweede verificatiemethode </h1>
        <p> U heeft tweevoudige verificatie ingeschakeld op uw account! Kies hieronder de methode die u wilt gebruiken voor het aronden van uw inlogpoging.</p>
                <div id="2FAchoice">
                    <input type="hidden" name="gebruikersnaam" id="gebruikersnaam" size="40" value=<?php echo $_SESSION['User'];?> required>
                    <input type="radio" id="mailVerification" name="VerificationMethod" value="mailVerification">
                    <label for="mailVerification">Verifieren via E-Mail</label><br>
                    <input type="radio" id="QRverification" name="VerificationMethod" value="QRverification">
                    <label for="QRverification">Verifieren via QR-code</label><br>
                </div>
                <div id="submit2ndFactorChoice">
                    <input type="submit" class= "btn" value="madeChoice" name="Ga verder" id="MadeChoice">
                </div>
        </form>  
    </div>
