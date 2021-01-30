<?php
    require "../../_init/initialize.php";


    if (isset($_POST['submit'])) {
        // Laten we eerst gaan controleren of de ingevoerde wachtwoorden hetzelfde zijn
        if (isset($_POST['wachtwoord']) && $_POST['wachtwoord'] !== $_POST['wachtwoordb']){
            $message = "De opgegeven wachtwoorden komen niet overeen! Probeer het nogmaals!";
        } else {

            $message                        = "";
            $FirstName              		= CheckValue($_POST['voornaam']);
            $LastName       				= CheckValue($_POST['achternaam']);
            $Email              			= CheckValue($_POST['email']);
            $DateofBirth                    = CheckValue($_POST['geboortedag']);
            $Gender         				= CheckValue($_POST['gender']);
            $Adress         				= CheckValue($_POST['adres']);
            $PostalCode                     = CheckValue($_POST['postcode1']) . " " . CheckValue($_POST['postcode2']);
            $City                           = CheckValue($_POST['plaats']);
            $Country                        = CheckValue($_POST['land']);
            $BIC                            = CheckValue($_POST['BIC']);
            $IBAN                           = CheckValue($_POST['IBAN']);
            $PasswordHash                   = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT, $options);
            $Admin                          = CheckValue($_POST['IsAdmin']);
            $MailVerified                   = CheckValue($_POST['MailVerified']);

            if ($Admin == "true"){
                $Admin = true;
            } else {
                $Admin = false;
            }

            if ($MailVerified == "true"){
                $MailVerified = true;
            } else {
                $MailVerified = false;
            }

            // Nu maken we een databasen connectie
            $ConnectionArray = MySqlDo_connector('Connect');
            $DBconnect = $ConnectionArray['connection'];
            $message .= $ConnectionArray['debug'];
            if ($ConnectionArray['result']){
                $statement = "SELECT * FROM Users WHERE Email = " . "'$Email'" . "LIMIT 1";
                $StatementRunned = $DBconnect->query($statement);
            } else {
                $message .= $ConnectionArray['debug'];
            }

            // We gaan controleren of de gebruiker nog niet bestaat
            
                // Nu gaan we controleren of de gebruiker al bestaat
                if ($StatementRunned->num_rows > 0){
                    // De gebruiker betstaat al!
                    $message .= 'Er bestaat al een gebruiker dit mailadres! Je kunt <a href="../../index.php?page=forms&form=login">HIER INLOGGEN</a>';
                } else {
                    // De gebruiker bestaat nog niet
                        // Tijd om het eerste deel van de waarden naar de database te schrijven in de tabel Customers
                        $AddArray = MySqlDo('Add', 'Customer', "$FirstName", "$LastName", "$DateofBirth", "$Gender", "$Adress", "$PostalCode", "$City", "$Country", "$BIC", "$IBAN");
                        
                        if (DebugisOn){
                            // nu een beetje debug informatie
                            $message .= "<b> Adding to the Customers Table </b><br>";
                            $message .= $AddArray['debug'];
                            $message .= "<br>";
                        } if ($AddArray['result']){
                            // We noteren het klantnummer voor later
                            $CustomerID = $AddArray['ID'];
                        
                            // Nu gaan we checken of het mail adres nog geverifeerd moet worden.
                            if (!$MailVerified == TRUE){
                        
                                $token = bin2hex(random_bytes(50));  // Het token aanmaken voor de verificatie
                                $Password = mt_rand(10000000, 99999999); // Activatiecode aanmaken
                                $PasswordHash = password_hash($Password, PASSWORD_DEFAULT, $options);
                            } else {
                       
                                $token = NULL; // Er is geen token nodig
                            }
                            // Nu voegen we de waarden toe aan de tabel users
                            $AddArray2 = MySqlDo('Add', 'User', "$Email", "$CustomerID", "$PasswordHash", $Admin, 0, $MailVerified, "$token", true, "#FFFFFF");
                            if (DebugisOn){
                                // nu een beetje debug informatie
                                $message .= "<br><b> Adding to the Users Table </b><br>";
                                $message .= $AddArray2['debug'];
                                $message .= "<br>";
                            }
                            if ($AddArray2['result']){
                                // Een beetje feedback voor de gebruiker naasr het scherm
                                    // Eerst gaan we kijken of er een verificatiemail moet worden verstuurd
                                    if ($MailVerified != TRUE){
                                        // Nu gaan we de verificatiemail versturen
                                            $ActivationCode = $Password;
                                            // We gaan de mail voorbereiden
                                            $to         =       $Email;
                                            $subject    =       'IT4ALL - Verify your email address';
                                            $headers    =       "From: webmaster.it4all@gmail.com\r\n";
                                            $headers    .=      "Reply-To: webmaster.it4all@gmail.com\r\n";
                                            $headers    .=      "MIME-Version: 1.0\r\n";
                                            $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                                        
                                            require "../../_AuthSys/Authentication_mails/MAIL_Verification.php";
                                                                        
                                            // Nu gaan we de mail verzenden
                                            mail($to, $subject, $VerMail, $headers);

                                            $message .= "De klant met klantnummer  <b>$CustomerID</b> is toegevoegd aan de database! Er is een verificatiemail verstuurd.  <br>";
                                    } else {
                                        // De gebruiker is al geverifieerd
                                            // we sturen een welkomstmail!
                                                $to         =       $Email;
                                                $subject    =       'IT4ALL - Welkom op onze site!';
                                                $headers    =       "From: webmaster.it4all@gmail.com\r\n";
                                                $headers    .=      "Reply-To: webmaster.it4all@gmail.com\r\n";
                                                $headers    .=      "MIME-Version: 1.0\r\n";
                                                $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                                            
                                                require "../../_AuthSys/Authentication_mails/MAIL_Welcome.php";
                                                                    
                                            // Nu gaan we de mail verzenden
                                            mail($to, $subject, $WelMail, $headers);

                                        $message .= "De klant met klantnummer  <b>$CustomerID</b> is toegevoegd aan de database! Er is welkomstmail versturd. <br>";
                                    } 
                            } else {
                                $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
                            }
                        } else {
                            $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
                        }
                        // terugsturen naar het formulier met feedback informatie
                        $output = $message;
                        $redirectlocation = '../../index.php?page=forms&form=admin_form'. '&result=' .urlencode($output);
                        immediate_redirect_to($redirectlocation);
                }
            }
            } 
        
?>