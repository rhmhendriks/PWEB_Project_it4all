<?php session_start() 
/**
 * TODO: Display OTP when available
 */?>
    <div id="pinForm">
        <form method="post" action="validationFormController.php" class="authenticationforms-container">
        <h1> Uw persoonlijke pincode </h1>
        <p>Om verder te gaan met inloggen moet kunt u hieronder uw pincode intoetsen. Wanneer deze juist is ontvangt u uw eenamlige aanmeldcode.</p>
        <p style="color:blue">LET OP! Deze code is nog maar .... geldig </p>
                <?php  if (isset($_SESSION['Debug_2FAsetup']) && DebugisOn) echo '<p style="color:Red">'. $_SESSION['Debug_2FAsetup'] . '</p>';?>
                <div id="Uw pincode">
                    <input type="hidden" name="session" id="session" size="40" value="<?php echo $_GET['sessionID'];?>" required>
                    <label>Uw pincode<span class="redStar">*</span></label>              <input type="password" name="Pin" id="Pin" size="40"> 
                </div>
                <div id="submitPinForm">
                    <input type="submit" class= "btn" value="Geef aanmeldcode weer" name="checkPin" id="checkPin">
                </div>
        </form>  
    </div>