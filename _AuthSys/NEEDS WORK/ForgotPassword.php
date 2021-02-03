<div id="passwordforgot_form">
<?php
    // Dit deel vult wat informatie automatisch in voor de klant
        // eerst een aantal waarden inistialiseren 
            $message = "";
            $debug = "";

        if (isset($_GET['token'])){
            // Verbinding maken met database en gegevens ophalen
                $token = $_GET['token'];
                // We maken een connectie met de database om de Form Values op te halen
                    // De connectie wordt aangemaakt en de array verwerkt
                        $ConnectionArray = MySqlDo_Connector('Connect');
                        if (!$ConnectionArray['result']){
                            // Conectie gefaald
                                $message .= 'Er is iets fout gegaan probeer het later opnieuw!<br>';
                                $debug .= $ConnectionArray['debug'];
                        } else {
                            // Connectie success
                                $debug .= $ConnectionArray['debug'];
                                $DBconnect = $ConnectionArray['connection'];
                                // We gaan wat waarden ophalen
                                    $statementGetUser = "SELECT * FROM  Users WHERE Token = '$token';";
                                    if ($statementrunned = $DBconnect->query($statementGetUser)){
                                        $debug .= "<br> The statement <b>$statementGetUser</b> was succesfull!<br>";
                                        if ($statementrunned->num_rows > 0) {
                                            while ($rij = $statementrunned->fetch_assoc()) {
                                                $CustomerID = $rij['CustomerID'];
                                                $EmailAddress = $rij['EMail'];
                                            } // wanneer er geen rijen meer zijn
                                        } // afsluiting user gevonden

                                    } else {// afsluiting statement gelukt
                                        $message .= "Er is iets fout gegaan probeer het later opnieuw!";
                                        $debug .= "The statement to get form information failed! the statement was <b> $statementGetUser </b>the error was <b>" . $DBconnect->error . "</b>.<br>";
                                    }// Afsluiting statement gefaald

                                }// aflsuiten sucesvolle connectie

        // Het volgende deel verwerkt het formulier
            // Als het formulier is ingevuld
                if (isset($_POST['submit'])){
                    // We controleren of er al een bruikbare database verbinding actief is
                        if (!isset($DBconnect)){
                            // We gaan een bruikbare verbinding opzetten
                                // De connectie wordt aangemaakt en de array verwerkt
                                    $ConnectionArray = MySqlDo_Connector('Connect');
                                    $DBconnect = $ConnectionArray['connection'];
                                    $debug .= $ConnectionArray['debug'];
                        }
                            // We gaan de nieuwe activatiecode's genereren en versturen
                                $tokennew = bin2hex(random_bytes(50)); // Er wordt een (nieuw) token gegenereerd
                                $ActivationCode = mt_rand(10000000, 99999999); // Een nieuwe activatiecoden word gemaakt
                                $ActiovationCodeHash = password_hash($ActivationCode, PASSWORD_DEFAULT, $options); // De veilige hash voor de database wordt gemaakt. 

                            // We gaan de nieuwe gegevens (met eventueel aangepast mail adres) naar de databse schrijven\
                                // eerst gaan we kijken of het email adres is verqandere. 
                                    if (!isset($EmailAddress)){
                                        $EmailAddress = CheckValue($_POST['emailaddress']);
                                    } elseif (!$EmailAddress == $_POST['emailaddress']){ 
                                        $EmailAddressUser = CheckValue($_POST['emailaddress']);
                                    } 
                                // We controleren of je een gebruiker kunnen vinden aan de hand van het mailadres
                                    $statement = "SELECT Customers.*, Users.EMail, Users.Password, Users.Number_Login_Attempts, Users.Verified, Users.Token, Users.PrivacyAcknoledge, Users.AccentColor FROM Users JOIN Customers ON Users.CustomerID=Customers.ClientNumber WHERE Users.Email='$EmailAddress'";
                                    $statementrunned = $DBconnect->query($statement);
                                    if ($statementrunned->num_rows > 0) {
                                        // We gaan checken of het email adres tussentijds is aangepast en het statement opmaken aan de hand daarvan
                                            if (isset($EmailAddressUser)){
                                                $statementnewcodes = "UPDATE Users SET `Email`='$EmailAddressUser', `Number_Login_Attempts`=0, `Password`='$ActiovationCodeHash', `Verified`=0, `Token`='$tokennew'  WHERE EMail = '$EmailAddress'";
                                            } else {
                                                $statementnewcodes = "UPDATE Users SET `Number_Login_Attempts`=0, `Password`='$ActiovationCodeHash', `Verified`=0, `Token`='$tokennew'  WHERE `EMail` = '$EmailAddress'";
                                            }
                                        // Nu gaan het statement uitvoeren en controleren
                                            if ($StatementRunnedNewCodes = $DBconnect->query($statementnewcodes)){
                                                 // gegevens ophalen uit de databse
                                                    // We moeten een select statement opmaken
                                                        $StatementSelect = "SELECT Customers.*, Users.EMail, Users.Password, Users.Number_Login_Attempts, Users.Verified, Users.Token, Users.PrivacyAcknoledge, Users.AccentColor FROM Users JOIN Customers ON Users.CustomerID=Customers.ClientNumber WHERE Users.Email='$EmailAddress'";
                                                        if ($StementRunnedSelect = $DBconnect->query($StatementSelect)){

                                                            while ($rij = $StementRunnedSelect->fetch_assoc()) {
                                                                $CustomerID = $rij['CustomerID'];
                                                                $EmailAddress = $rij['EMail'];
                                                                $FirstName = $rij['FirstName'];
                                                                $LastName = $rij['LastName'];
                                                            } // wanneer er geen rijen meer zijn
    
                                                                // We gaan de variabelen goed zetten voor de mail
                                                                   
                                                                    $Email = $EmailAddress;
                                                                    $token = $tokennew;
                    
                                                                // We gaan de mail voorbereiden
                                                                    $to         =       $Email;
                                                                    $subject    =       'IT4ALL - Activeer uw account!';
                                                                    $headers    =       "From: webmaster.it4all@gmail.com\r\n";
                                                                    $headers    .=      "Reply-To: webmaster.it4all@gmail.com\r\n";
                                                                    $headers    .=      "MIME-Version: 1.0\r\n";
                                                                    $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                                                    
                                                                    include "_php/Auth/MAIL_ForgotPassword.php";
                                                                                    
                                                                // Nu gaan we de mail verzenden
                                                                    mail($to, $subject, $VerMail, $headers);
                                                                                    
                                                                // Nu nog een instructie voor de gebruiker
                                                                    $message .= "Binnen enkele ogenblikken ontvang je een activatiemail op adres:" . $Email;
                                                                    $debug .= 'Instructions are send.';
                                                               

                                                        } else {
                                                            $message .= "Er is iets fout gegeaan probeer het later opniew! Blijf je deze fout zien? Neem dan contact met ons op via de knop in het menu, wij helpen u graag!";
                                                            $debug .= "The statement to update the codes in the database failed failed! <br> The statement: <b>" . $StatementSelect . "</b><br> The SQL error: <b>" . $DBconnect->error . "</b>";
                                                        }
                                                        

                                                        
                                            
                                            } else {
                                               
                                                $message .= "Er is iets fout gegeaan probeer het later opniew! Blijf je deze fout zien? Neem dan contact met ons op via de knop in het menu, wij helpen u graag!";
                                                $debug .= "The statement to update the codes in the database failed failed! <br> The statement: <b>" . $statementnewcodes . "</b><br> The SQL error: <b>" . $DBconnect->error . "</b>";
                                            }
                                        }

                                         
                }
            }
            

?>
<h1>Wachtwoord vergeten?</h1>
    <p>Bent u uw wachtwoord vergeten? Dan kunt u doormiddel van dit formulier uw inloggegevens aanpassen. </p>
    <p><b>LET OP: Wanneer u het formulier verstuurd worden uw huidige gegevens onmiddelijk geblokkeerd tot je de stappen in de mail hebt voltooid!</b><p>

    <form action="" method="POST">
        <div id="inputforgotpassword">
        <?php if (isset($_SESSION['Message_Act']) || isset($_SESSION['Message_si'])){ echo '<p style="color:Red">' . $_SESSION['Message_Act'] . "<br>" . $_SESSION['Message_si'] . '<br></p>'; } if (DebugisOn && isset($_SESSION['Debug_Act']) || DebugisOn && isset($_SESSION['Debug_si']) ){ echo '<p style="color:Red">' . $_SESSION['Debug_Act'] . "<br" . $_SESSION['Debug_si'] . '</p>';}?>
        
            <!--<labal>Klantnr<span class="redStar">*</span></label>  -->           <input type="hidden" name="clientnumber" id="clientnumber" value=<?php if (isset($CustomerID)){echo '"' . $CustomerID . "\" required disabled";} else { echo '""' . ' ' . "disabled";}?> >
            <label>E-mail address<span class="redStar">*</span></label>             <input type="email" name="emailaddress" id="emailaddress" value=<?php if (isset($CustomerID)){echo '"' . $EmailAddress . "\"";} else { echo '"" required';}?> >
        </div>
        <div id="submitforgotpassword">
            <input type="submit" name="submit" value="aanvragen">
        </div>
    </form>
</div>