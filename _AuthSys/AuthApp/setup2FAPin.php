<?php session_start() ?>
    <div id="OTPappCheckForm">
        <form method="post" action="SetupPin.php" class="authenticationforms-container">
        <br><br>
        <h1> Persoonlijke pincode aanmaken</h1>
        <p>Het is tijd om een persoonlijke pincode aan te maken! Hieronder kunt u een pincode aanmaken van minimaal 6 cijfers. Wij adviseren u om een veilige pincode te kiezen en dus geen geboortedatum of een andere makkelijk te raden reeks aan getallen.</p>
        <p>Naast de pincode dient u twee beveiligsvragen op te slaan, deze zijn nodig als u ooit uw pincode vergeet. Uiteraard worden de antwoorden op deze vragen met de hoogt mogelijke beveiliging opgeslagen.</p>
        <p style="color:blue">LET OP! Deze code is nog maar .... geldig </p>
                <?php  if (isset($_SESSION['Debug_2FAsetup']) && DebugisOn) echo '<p style="color:Red">'. $_SESSION['Debug_2FAsetup'] . '</p>';?>
                <div id="verificatiegegevens">
                    <input type="hidden" name="session" id="session" size="40" value="<?php echo $_GET['sessionID'];?>" required>
                    <label>Pincode<span class="redStar">*</span></label>              <input type="password" name="Pin" id="Pin" size="40">
                    <label>Pincode bevestigen<span class="redStar">*</span></label>              <input type="password" name="Pin2" id="Pin2" size="40">  
                    <label>Beveiligingsvraag "Wat is de naam van uw eerste school?"<span class="redStar">*</span></label>              <input type="password" name="sqA" id="sqA" size="40"> 
                    <label>Beveiligingsvraag "Wat is uw lievelingsmaaltijd?"<span class="redStar">*</span></label>              <input type="password" name="sqB" id="sqB" size="40"> 

                </div>
                <div id="submit2FApinform">
                    <input type="submit" class= "btn" value="Code Controleren" name="checkCode" id="checkCode">
                </div>
        </form>  
    </div>