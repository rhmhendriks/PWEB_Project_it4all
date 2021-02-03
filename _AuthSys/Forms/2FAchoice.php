<!--------------------------------------------
Auteur: Ronald HM Hendriks
datum: 30-01-2021 13:12

Beschrijving: Op dit formulier geeft de 
              gebruiker aan hoe die zijn
              identiteit wil verifiëren.php

Laatste update: Class namen veranderd. 
Op: 03-02-2021 09:06
Door: Ronald HM Hendriks

--------------------------------------------->

<?php session_start() ?>
    <div id="general2fa_form">
        <form method="post" action="../Controllers/2ndChoiceController.php" class="authenticationforms-container">
        <h1> Tweede verificatiemethode </h1>
        <p> U heeft tweevoudige verificatie ingeschakeld op uw account! Kies hieronder de methode die u wilt gebruiken voor het aronden van uw inlogpoging.</p>
        <?php if (isset($_SESSION['Message_Act']) || isset($_SESSION['Message_si'])){ echo '<p style="color:Red">' . $_SESSION['Message_Act'] . "<br>" . $_SESSION['Message_si'] . '<br></p>'; } if (DebugisOn && isset($_SESSION['Debug_Act']) || DebugisOn && isset($_SESSION['Debug_si']) ){ echo '<p style="color:Red">' . $_SESSION['Debug_Act'] . "<br" . $_SESSION['Debug_si'] . '</p>';}?>
                <div id="inputgeneral2fa">
                    <input type="hidden" name="gebruikersnaam" id="gebruikersnaam" size="40" value=<?php echo $_SESSION['User'];?> required>
                    <input type="radio" id="mailVerification" name="VerificationMethod" value="mailVerification">
                    <label for="mailVerification">Verifieren via E-Mail</label><br>
                    <input type="radio" id="QRverification" name="VerificationMethod" value="QRverification">
                    <label for="QRverification">Verifieren via QR-code</label><br>
                </div>
                <div id="submitgeneral2fa">
                    <input type="submit" class= "btn" value="madeChoice" name="Ga verder" id="MadeChoice">
                </div>
        </form>  
    </div>