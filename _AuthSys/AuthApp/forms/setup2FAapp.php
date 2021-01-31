<?php session_start() ?>
    <div id="OTPappCheckForm">
        <form method="post" action="appSetupController.php" class="authenticationforms-container">
        <h1> Identiteit Verifiëren </h1>
        <p>Er is zojuis een mail gestuurd aan het bij ons bekende mailadres. Deze mail bevat een eenmalige identificatiecode welke u hieronder kunt invullen.</p>
        <p style="color:blue">LET OP! Deze code is nog maar .... geldig </p>
                <?php  if (isset($_SESSION['Debug_2FAsetup']) && DebugisOn) echo '<p style="color:Red">'. $_SESSION['Debug_2FAsetup'] . '</p>';?>
                <div id="verificatiegegevens">
                    <input type="hidden" name="session" id="session" size="40" value="<?php echo $_GET['sessionID'];?>" required>
                    <label>Identificatiecode<span class="redStar">*</span></label>              <input type="password" name="OTP" id="OTP" size="40"> 
                </div>
                <div id="submitloginform">
                    <input type="submit" class= "btn" value="Code Controleren" name="checkCode" id="checkCode">
                </div>
        </form>  
    </div>