<?php
/**
 * Author: Ronald H.M. Hendriks
 */
    require "../../_init/initialize.php";
    // We gaan de variabelen initialiseren die we gaan gebruiken
        $message = "";
        $debug = "";
        session_start(); // De sessie wordt gestart

    // We checken of het formulier is ingestuurd
        if (isset($_POST['Activeren'])){
          
            // We gaan de waarden controleren op injection
                $Token = CheckValue($_POST['token']);
                $CustomerID = CheckValue($_POST['klantnummer']);
                $Email = CheckValue($_POST['emailadres']);
                $ActivationCodeEntered = CheckValue($_POST['activatiecode']);
                $Password = CheckValue($_POST['wachtwoord']);
                $PasswordConfirm = CheckValue($_POST['wachtwoordbevestig']);
            
            // We gaan controleren of het de activatiecode juist is ingevuld
                // We moeten eerst de gegevens weer ophalen
                    // De connectie wordt aangemaakt en de array verwerkt
                        $ConnectionArray = MySqlDo_Connector('Connect');
                        if (!$ConnectionArray['result']){
                            // Conectie gefaald
                                $message .= 'Er is iets fout gegaan probeer het later opnieuw!<br>';
                                $debug .= $ConnectionArray['debug'];

                        } else { // Afluiting connectie gefaald
                            // Connectie success
                                $debug .= $ConnectionArray['debug'];
                                $DBconnect = $ConnectionArray['connection'];

                                // We gaan de waarden uit de gebruikersdatabase ophalen
                                    $statement = "SELECT Customers.*, Users.EMail, Users.Password, Users.Number_Login_Attempts, Users.Verified, Users.Token, Users.PrivacyAcknoledge, Users.AccentColor FROM Users JOIN Customers ON Users.CustomerID=Customers.ClientNumber WHERE Users.Token='$Token'";
                                    $statementrunned = $DBconnect->query($statement);
                                    if ($statementrunned->num_rows > 0) {
                                        while ($rij = $statementrunned->fetch_assoc()) {
                                            $CustomerID = $rij['ClientNumber'];
                                            $FirstName = $rij['FirstName'];
                                            $LastName = $rij['LastName'];
                                            $DateofBirth = $rij['DateofBirth'];
                                            $Gender = $rij['Gender'];
                                            $Address = $rij['Adress'];
                                            $PostalCode = $rij['PostalCode'];
                                            $City = $rij['City'];
                                            $BIC = $rij['BIC'];
                                            $IBAN = $rij['IBAN'];
                                            $Email = $rij['EMail'];
                                            $ActivationCodeHash = $rij['Password'];
                                            $IsAdmin = $rij['IsAdmin'];
                                            $Attempts = $rij['Number_Login_Attempts'];
                                            $MailAlreadyVerified = $rij['Verified']; 
                                            $Token = $rij['Token'];
                                            $PrivacyAcknoledged = $rij['PrivacyAcknoledge'];
                                        } // wanneer er geen rijen meer zijn
                                    } else {
                                        $message .= "Er is geen gebruiker gevonden met dit mailadres!";
                                    } // afsluiting user gevonden
                            
            
            // We moeten de ingevoerde gegevens controleren (activatiecode)
                // Om de vergelijking te kunnen doen moeten we eerst de database waarde ontgrendelen
                    if (!password_verify($ActivationCodeEntered, $ActivationCodeHash)){
                        // Incorrecte code, we gaan niet verder
                            $Attempts++;
                            // Laten we kijken hoevaak de gebruiker het nog mag proberen
                                if ($Attempts < MaxLoginAttempts){
                                    // De gebruiker heeft genoeg pogingen over om het nogmaals te proberen
                                        $TrysLeft = MaxLoginAttempts - $Attempts; // We noteren hoe vaak de gebruiker het nog mag proberen
                                        // We noteren dat het fout is gegaan in de database en geven aan hoe vaak de gebruiker het nog mag proberen
                                            $statementInvalidActivation = "UPDATE Users SET Number_Login_Attempts=$Attempts WHERE Token = '$Token'";
                                            // We voeren het statement uit en gaan het resultaat controleren
                                                if ($statementrunnedInvalidActivation = $DBconnect->query($statementInvalidActivation)){
                                                    $message .= "<br> De activatiecode was niet correct! Probeer het opnieuw, je hebt nog $TrysLeft pogingen over.";
                                                    $debug .= "<br> The activationcode doesn't match the database hash! there is a total of $Attempts incorrect try's. This failure is added tot the database";
                                                    $redirectlocation = "../../index.php?page=auth&auth=Activate" . "&token=$Token";
                                                } else { // Afsluiten statement gelukt
                                                    $message .= "<br> De activatiecode was niet correct! Probeer het opnieuw, je hebt nog $TrysLeft pogingen over.";
                                                    $debug .= "<br> The activationcode doesn't match the database hash! there is a total of $Attempts incorrect try's. <br> The statement to update the number of failures to the database failed! The statement used was <b> $statementInvalidActivation </b> and the SQL error was <b>" . $DBconnect->error . "</b>.";
                                                    $redirectlocation = "../../index.php?page=auth&auth=Activate" . "&token=$Token";
                                                } // afsluiten statement gefaald.
                                            
                                   
                                    } else { // Afsluiting heeft nog pogingen
                                        // De gebruiker heeft geen pogingen meer over!
                                            // We maken een nieuwe activatiecode aan
                                                $ActivationCode = mt_rand(10000000, 99999999); // Er wordt een nieuwe activatiecode gegenereerd
                                                $NewActivationCodeHash = password_hash($ActivationCode, PASSWORD_DEFAULT, $options);
                                                $statementNewActivationCode = "UPDATE Users SET `Password`='$NewActivationCodeHash', `Number_Login_Attempts`=0  WHERE Token = '$Token'";
                                                
                                                if ($statementrunnedNewActivationCode = $DBconnect->query($statementNewActivationCode)){
                                                    $message .= "De activatiecode was niet correct! <br> Je hebt te vaak een verkeerde code ingevuld!, we hebben je een nieuwe code opgestuurd naar $Email";
                                                    $debug .= "<br> The activationcode doesn't match the database hash! There where no attemps left so we send a new activation code to the user on the address $Email";

                                                } else { // Afsluiten statement gelukt
                                                    $message .= "Er is een ernstige technische fout opgetreden! Dit ligt aan onze kant. Zou je contact met ons op willen nemen via de contact knop rechts bovenin het menu? Dan helpen wij je met het activeren van je account. Onze excuses voor het ongemak!";
                                                    $debug .= "<br> The entered activiation code was incorrect, and the user does not have anymore attempts left.<br> The statement to create a net Activation Code failed and the update to the database failed! The statement used was <b> $statementNewActivationCode </b> and the SQL error was <b>" . $DBconnect->error . "</b>.";
                                                } // afsluiten statement gefaald.
                                                
                                                // Mail verzenden aan de gebruiker
                                                    sendMail('IT4ALL - Activeer uw account!', $Email, "Auth/MAIL_VerificationSecond.php", $debug);
                                                    $debug .= "<br> The activationcode failed, there are too many incorrect attemps. <br> there was a new activationcode generated and mailed to the user.";

                                    } // Afsluiting Geen pogingen meer
                
                    } else { // Afsluiting verkeerde activatiecode
                        // De activatie code was juist
                            // We checken of de opgegeven wachtwoorden overeenkomen
                                if (!$Password == $PasswordConfirm){
                                    // Als de wachtwoorden van elkaar verschillen
                                        $message .= "De ingevoerde wachtwoorden komen niet overeen! Probeer het opnieuw!";
                                        $debug .= "<br> The Passwords where not the same!";
                                        $redirectlocation = "../../index.php?page=auth&auth=Activate" . "&token=$Token";

                                } else { // afsluiting wachtwoorden komen niet overeen
                                    // We gaan de activatie van het account voltooien in de database
                                        $PasswordHash =  password_hash($Password, PASSWORD_DEFAULT); // Het wachtwoord wordt versleute;d
                                        // We gaan het statement maken
                                            $statementActivateUser = "UPDATE Users SET `Number_Login_Attempts`=0, `Password`='$PasswordHash', `Verified`=1, `Token`=NULL  WHERE Token = '$Token'";
                                            // We gaan het statement uitvoeren en het resultaat controleren
                                                if ($StatementRunnedActivateUser = $DBconnect->query($statementActivateUser)){
                                                    $message .= "Je account is nu geactiveerd! Je kunt vanaf nu inloggen op onze website!";
                                                    $debug .= "<br> The account has been verified. It is now possible for the user $Email to logon on our site";

                                                    // we sturen een welkomstmail!                                                        
                                                        //sendMail('IT4ALL - Welkom op onze site!', $Email, "/Auth/MAIL_Welcome.php", $debug);
                                                        $redirectlocation = "../../index.php?page=auth&auth=login";
                                                } else { // Afsluiting statement ran successfull!
                                                    $message .= "Er is iets fouts gegaan probeer het later opnieuw, blijf je deze melding zien? Neem dan contact met onts op via de contactknop rechts in het menu.";
                                                    $debug .= "The statement that was ment to activate the useraccount for <b> $Email </b> failed! The statement was <b> $statementActivateUser </b> the SQL error was <b>" . $DBconnect->error . "</b>.";
                                                    $redirectlocation = "../../index.php?page=auth&auth=Activate" . "&token=$Token";
                                                } // afsluiting account activeren statement gefaald
                                } // Afsluiting wachtwoorden komen overeen
                    } // afsluiting juiste activatiecode
                    } // afsluting connectie gelslaagd
        $_SESSION['Message_Act'] = $message;
        $_SESSION['Debug_Act'] = $debug;
        immediate_redirect_to($redirectlocation);
        } // Afluiting formulier is ingevuld
        
?>