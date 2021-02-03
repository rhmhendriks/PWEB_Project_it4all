<?php session_start() ?>
    <!----------------------------------------------------
    Author: Ronald Hendriks
    ----------------------------------------------------->
    <div id="loginform">
        <form method="post" action="../_AuthSys/Controllers/SignIn_Controller.php" class="authenticationforms-container">
        <h1> Inloggen </h1>
                <?php if (isset($_SESSION['Message_Act']) || isset($_SESSION['Message_si'])){ echo '<p style="color:Red">' . $_SESSION['Message_Act'] . "<br>" . $_SESSION['Message_si'] . '<br></p>'; } if (DebugisOn && isset($_SESSION['Debug_Act']) || DebugisOn && isset($_SESSION['Debug_si']) ){ echo '<p style="color:Red">' . $_SESSION['Debug_Act'] . "<br" . $_SESSION['Debug_si'] . '</p>';}?>
                <div id="inloggengegevens">
                    <label>E-mail<span class="redStar">*</span></label>                  <input type="email" name="gebruikersnaam" id="gebruikersnaam" size="40"	pattern="[a-Z0-9._-]+@[a-Z0-9.-]+\.[a-Z]{2,}$"  placeholder="Voer je mailadres in" required>
                    <label>Wachtwoord<span class="redStar">*</span></label>              <input type="password" name="wachtwoord" id="wachtwoord" size="40"> 
                </div>
                <div id="submitloginform">
                    <input type="submit" class= "btn" value="inloggen" name="inloggen" id="inloggen">
                </div>
                <div id="linksloginform">
                    <p><a href="index.php?inc=y&formtype=admin&page=auth&auth=ForgotPassword">Wachtwoord vergeten?</a></p>
                    <p>Je kunt je hier <a href="index.php?inc=y&formtype=admin&page=auth&auth=SignUp">registreren</a></p>
                </div>
        </form>  
    </div>