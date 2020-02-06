<?php
    require "../../_init/initialize.php";
    session_start();

        // We initiliseren een aantal variabelen
            $message = "";
            $debug = "";
            $authstatus ="";

        // Dit script start wanneer de loginknop is ingedrukt. 
            if (isset($_POST['inloggen'])){

                // Nu maken we de database connectie op
                    $Connectionarray = MySqlDo_Connector('Connect');
                // Nu gaan we de database verbinding controleren
                    if ($Connectionarray['result']){
                        // Als de databse verbinding is geslaagd
                        $DBconnect = $Connectionarray['connection']; // Nu zetten we de verbinding over in een bruikbare variabele
                        $debug .= $Connectionarray['debug'];

                    // WE gaan de ingevoerde waarden checken en wegschrijven. 
                        $Email = CheckValue($_POST['gebruikersnaam']);
                        $PasswordEntered = CheckValue($_POST['wachtwoord']);
                        
                    // We gaan checken of de gebruiker bestaat
                        $statementExist = "SELECT * FROM Users WHERE Email = " . "'$Email'" . "LIMIT 1";
                        $StatementRunned = $DBconnect->query($statementExist);
                        
                    // Nu gaan we controleren of de gebruiker al bestaat
                        if (!$StatementRunned->num_rows > 0){
                            // De gebruiker betstaat niet
                                $message .= 'Er bestaat nog geen gebruiker dit mailadres! Je kunt <a href="../../index.php?page=auth&auth=SignUp">HIER REGISTREREN</a>';
                                $debug .= 'The error is :<b> ' . $DBconnect->error . '</b> the statement was <b>' . $statement . '</b>!<br>';
                                $authstatus =  false;

                        } else { // aflsuiting gebruiker bestaat niet
                            // De gebuiker bestaat 
                                // We gaan alle gegevens van de gebruiker ophalen
                                    $statementGetUDATA = "SELECT Customers.*, Users.EMail, Users.Password, Users.Number_Login_Attempts, Users.Verified, Users.Token, Users.PrivacyAcknoledge, Users.AccentColor FROM Users JOIN Customers ON Users.CustomerID=Customers.ClientNumber WHERE Users.EMail='$Email'";
                                    $statementRunnedGetUDATA = $DBconnect->query($statementGetUDATA);
                                        while ($rij = $statementRunnedGetUDATA->fetch_assoc()) {
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
                                            $EmailGet = $rij['EMail'];
                                            $PasswordHash = $rij['Password'];
                                            $IsAdmin = $rij['IsAdmin'];
                                            $Attempts = $rij['Number_Login_Attempts'];
                                            $Verified = $rij['Verified']; 
                                            $token = $rij['Token'];
                                            $PrivacyAcknoledged = $rij['PrivacyAcknoledge'];
                                        } // wanneer er geen rijen meer zijn
                                        
                                    // WE gaan checken of het account van de gebruiker is geactiveerd
                                        if (!$Verified){
                                            // Nog niet geverifieerd
                                                // We gaan de mail nogmaals naar de gebruiker sturen
                                                    // We gaan de mail voorbereiden
                                                    $to         =       $Email;
                                                    $subject    =       'IT4ALL - Activeer uw account!';
                                                    $headers    =       "From: webmaster.it4all@gmail.com\r\n";
                                                    $headers    .=      "Reply-To: webmaster.it4all@gmail.com\r\n";
                                                    $headers    .=      "MIME-Version: 1.0\r\n";
                                                    $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                    
                                                    require "MAIL_NotVerified.php";
                                                    // Nu gaan we de mail verzenden
                                                        mail($to, $subject, $VerMail, $headers);

                                                $message .= "Uw account is nog niet geactiveerd! Uit veiligheidoverwegingen kunt u daarom niet inloggen. <br> Wij hebben u zojuist instructies gestuurd zodat u uw account kunt activeren.";
                                                $debug .= "<br> Account verified is set to false(0) Signing in isn't possible for this user.";
                                                $authstatus = false;
                                        
                                            } else { // aflsuiting niet geactiveerd

                                    // We gaan het wachtwoord controleren
                                        if (!password_verify($PasswordEntered, $PasswordHash)){
                                            $authstatus = false;
                                            // Incorrecte wachtwoord
                                                $Attempts++;
                                                // Laten we kijken hoevaak de gebruiker het nog mag proberen
                                                    if ($Attempts < MaxLoginAttempts){
                                                        // De gebruiker heeft genoeg pogingen over om het nogmaals te proberen
                                                            $TrysLeft = MaxLoginAttempts - $Attempts; // We noteren hoe vaak de gebruiker het nog mag proberen
                                                            // We noteren dat het fout is gegaan in de database en geven aan hoe vaak de gebruiker het nog mag proberen
                                                                $authstatus = false;
                                                                $statementInvalidPassword = "UPDATE Users SET Number_Login_Attempts=$Attempts WHERE Token = '$token'";
                                                                // We voeren het statement uit en gaan het resultaat controleren
                                                                    if ($statementrunnedInvalidPassword = $DBconnect->query($statementInvalidPassword)){
                                                                        $message .= "<br> Het wachtwoord is onjuist! Probeer het opnieuw, je hebt nog $TrysLeft pogingen over.";
                                                                        $debug .= "<br> The password doesn't match the database hash! there is a total of $Attempts incorrect try's. This failure is added tot the database";
                                                                        $redirectlocation = "../../index.php?page=auth&auth=login";
                                                                    } else { // Afsluiten statement gelukt
                                                                        $message .= "<br> Het wachtwoord is onjuist! Probeer het opnieuw, je hebt nog $TrysLeft pogingen over.";
                                                                        $debug .= "<br> The Password doesn't match the database hash! there is a total of $Attempts incorrect try's. <br> The statement to update the number of failures to the database failed! The statement used was <b> $statementInvalidPassword </b> and the SQL error was <b>" . $DBconnect->error . "</b>.";
                                                                        $redirectlocation = "../../index.php?page=auth&auth=login";
                                                                    } // afsluiten statement gefaald.
                                                        } else { // Afsluiting heeft nog pogingen
                                                            $authstatus = false;
                                                            // De gebruiker heeft geen pogingen meer over!
                                                                // We maken een nieuwe ontgrendelcode aan
                                                                    $UnlockCode = mt_rand(10000000, 99999999); // Er wordt een nieuwe otgrendelcode gegenereerd
                                                                    $NewUnlockCodeHash = password_hash($UnlockCode, PASSWORD_DEFAULT); // We maken een encrypte versie van de opntgrendelcode
                                                                    $token = bin2hex(random_bytes(50));
                                                                    $statementNewUnlockCode = "UPDATE Users SET `Password`='$NewUnlockCodeHash', `Number_Login_Attempts`=0, `Verified`=0, `Token`='$token'   WHERE EMail = '$Email'";

                                                                    
                                                                    if ($statementrunnedNewUnlockCode = $DBconnect->query($statementNewUnlockCode)){
                                                                        $message .= "Het wachtwoord was niet onjuist! <br> Je hebt te vaak een verkeerde wachtwoord ingevuld!, we hebben uw account geblokkeerd in verband met veiligheidoverwegingen.  <br>  We hebben de ontgrendelinstructie gestuurd naar:  $Email";
                                                                        $debug .= "<br> The Password doesn't match the database hash! There where no attemps left so we send a new unlocking code to the user on the address $Email";
                                                                    
                                                                    } else { // Afsluiten statement gelukt
                                                                        $message .= "Er is een ernstige technische fout opgetreden! Dit ligt aan onze kant. Zou je contact met ons op willen nemen via de contact knop rechts bovenin het menu? Dan helpen wij u zodat u weer kunt inloggen.  Onze excuses voor het ongemak!";
                                                                        $debug .= "<br> The entered password code was incorrect, and the user does not have anymore attempts left.<br> The statement to create a new unlock Code failed and the update to the database failed! The statement used was <b> $statementrunnedNewUnlockCode </b> and the SQL error was <b>" . $DBconnect->error . "</b>.";
                                                                     

                                                                        // We gaan de mail voorbereiden
                                                                        $to         =       $Email;
                                                                        $subject    =       'IT4ALL - Instructie om je account te herstellen';
                                                                        $headers    =       "From: webmaster.it4all@gmail.com\r\n";
                                                                        $headers    .=      "Reply-To: webmaster.it4all@gmail.com\r\n";
                                                                        $headers    .=      "MIME-Version: 1.0\r\n";
                                                                        $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                                        
                                                                        require "MAIL_UnlockInstruction.php";
                                                                    // Nu gaan we de mail verzenden
                                                                        mail($to, $subject, $VerMail, $headers);
                                                                        $debug .= "<br> The Password failed, there are too many incorrect attemps. <br> there was a new unlockcode generated and mailed to the user.";

                                                                  
                                                                    } // afsluiten statement gefaald.


                                                                    
                                                        } // Afsluiting Geen pogingen meer

                                                    } else { // afsluiting incorrect password
                                                 
                                                        // Het wachtwoord is juist!
                                                            // We kunnen de gebruiker laten inloggen
                                                                // we schrijven de gegevens van de gebruiker naar de session
                                                                    $_SESSION['CustomerID'] = $CustomerID;
                                                                    $_SESSION['FirstName'] = $FirstName;
                                                                    $_SESSION['LastName'] = $LastName;
                                                                    $_SESSION['DateofBirth'] = $DateofBirth; 
                                                                    $_SESSION['Gender'] = $Gender; 
                                                                    $_SESSION['Address'] = $Address; 
                                                                    $_SESSION['Postalcode'] = $PostalCode;
                                                                    $_SESSION['City'] = $City;
                                                                    $_SESSION['BIC'] = $BIC;
                                                                    $_SESSION['IBAN'] = $IBAN;
                                                                    $_SESSION['Email'] = $EmailGet;

                                                                    $authstatus = true;
                                                                    $message .= "Je bent nu ingelogd!";
                                                               
                                                    } // afsluiting juiste wachtwoord
                                                }  // afsluiting account geactiveerd                 
            } // afsluiting gebruiker bestaat

    } else { // afsluiting connectie gelukt.
     
        $authstatus = false;
        $message .= "Er is iets fout gegaan probeer het opnieuw";
        $debug .= "Connection Failed <br><br>";
        $debug .= $Connectionarray['debug'];
    } // afsluiting geen connectie


    $_SESSION['Message_si'] = $message;
    $_SESSION['Debug_si'] = $debug;


    if ($authstatus){

        $redirectlocation = "../../index.php";
    } else {

        $redirectlocation = "../../index.php?page=auth&auth=login"; 
    }
    immediate_redirect_to($redirectlocation);
    } // afsluiting als er op inloggen is gedrukt.
?>