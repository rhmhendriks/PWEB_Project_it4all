<body>
    <?php session_start() ?>
    <div id="loginform">
        <form method="post" action="../_php/Auth/SignIn_Controller.php" class="authenticationforms-container"> 
            <fieldset>
                <legend>Inloggen</legend>
                <br>
                <?php if (isset($_SESSION['Message_Act']) || isset($_SESSION['Message_si'])){ echo '<p style="color:Red">' . $_SESSION['Message_Act'] . "<br>" . $_SESSION['Message_si'] . '<br></p>'; } if (DebugisOn && isset($_SESSION['Debug_Act']) || DebugisOn && isset($_SESSION['Debug_si']) ){ echo '<p style="color:Red">' . $_SESSION['Debug_Act'] . "<br" . $_SESSION['Debug_si'] . '</p>';}?>
                    <br>
                    <pre>E-mail:                  <input type="email" name="gebruikersnaam" id="gebruikersnaam" size="40"	pattern="[a-Z0-9._-]+@[a-Z0-9.-]+\.[a-Z]{2,}$"  placeholder="Voer je mailadres in" required></pre>
                    <pre>Wachtwoord:        <input type="password" name="wachtwoord" id="wachtwoord" size="40"></pre> 
                    <pre><input class= "btn" type="submit" value="inloggen" name="inloggen" id="inloggen"></pre><br />
                    <a href="ForgotPassword.php">Wachtwoord vergeten?</a><br />
                    <p>Je kunt je hier <a href="registreren.php">registreren</a></p>
            </fieldset>
        </form>  
    </div>