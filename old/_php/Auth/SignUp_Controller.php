<?php
require "../../_init/initialize.php";
    // Setting dome variables to use for the script itself
        $Debug = "";
        $Message = "";
        session_start();
        $errors = [];


    // Nu maken we de database connectie op
        $Connectionarray = MySqlDo_Connector('Connect');
        // Nu gaan we de database verbinding controleren
            if ($Connectionarray['result']){
                // Als de databse verbinding is geslaagd
                $DBconnect = $Connectionarray['connection']; // Nu zetten we de verbinding over in een bruikbare variabele
                $Debug .= $Connectionarray['debug'];
                // We controleren of het formulier is ingevuld
                if (isset($_POST['submit'])){
                    // Checking all the values from the form
                        $FirstName = CheckValue($_POST['voornaam']);
                        $LastName = CheckValue($_POST['achternaam']);
                        $DateofBirth = CheckValue($_POST['geboortedag']);
                        $Gender = CheckValue($_POST['gender']);
                        $Address = CheckValue($_POST['adres']);
                        $Email = CheckValue($_POST['email']);
                        $PostalCode = CheckValue($_POST['postcode1']) . " " .  CheckValue($_POST['postcode2']);
                        $City = CheckValue($_POST['plaats']);
                        $Country = CheckValue($_POST['land']);
                        if (isset($_POST['BIC'])){ $BIC = CheckValue($_POST['BIC']);} else { $BIC = "NULL";};
                        $IBAN = CheckValue($_POST['IBAN']);
                        $PrivacyStatement = CheckValue($_POST['PrivacyStatement']);
                        $token = bin2hex(random_bytes(50)); // Een uniek token genereren ten behoeve van mail verificatie
                        $IsAdmin = false;

                    // We gaan controleren of er al een gebruiker bestaat met dit mail adres
                        // Eerst het statment maken en uitvoeren
                            $statement = "SELECT * FROM Users WHERE Email = " . "'$Email'" . "LIMIT 1";
                            $StatementRunned = $DBconnect->query($statement);

                            // Nu gaan we controleren of de gebruiker al bestaat
                                if ($StatementRunned->num_rows > 0){
                                    // De gebruiker betstaat al!
                                        $Message .= 'Er bestaat al een gebruiker dit mailadres! Je kunt <a href="../../index.php?page=auth&auth=login">HIER INLOGGEN</a>';
                                        $Debug .= 'The error is :<b> ' . $DBconnect->error . '</b> the statement was <b>' . $statement . '</b>!<br>';
                                } else {
                                    // DE gebruiker betstaat nog niet, dus we gaan deze toevoegen
                                        $AddCustomer = MySqlDo('Add', 'Customer', $FirstName, $LastName, $DateofBirth, $Gender, $Address, $PostalCode, $City, $Country, $BIC, $IBAN);
                                        // We gaan meten of het statement is gelukt of juist niet
                                            if ($AddCustomer['result']){
                                                // Het Statement is succelvol uitgevoerd
                                                    $Debug .= $AddCustomer['debug'];
                                                    $ClientNumber = $AddCustomer['ID']; //
                                                    $ActivationCode = mt_rand(10000000, 99999999);
                                                    $HashedActivationCode = password_hash($ActivationCode, PASSWORD_DEFAULT);
                                                    $AddUser = MySqlDo('Add', 'User', "$Email", "$ClientNumber", "$HashedActivationCode", 0, 0, 0, "$token", "$PrivacyStatement", '#FFFFFF');
                                                    // We gaan controleren of het statement successvol is uitgevoerd
                                                    if ($AddUser['result']){
                                                        // Het statement is succesvol uitgevoerd
                                                            $Debug .= $AddUser['debug'];
                                                            // Nu gaan we de verificatiemail versturen
                                                                // We gaan de mail voorbereiden
                                                                    $to         =       $Email;
                                                                    $subject    =       'IT4ALL - Activeer uw account!';
                                                                    $headers    =       "From: webmaster.it4all@gmail.com\r\n";
                                                                    $headers    .=      "Reply-To: webmaster.it4all@gmail.com\r\n";
                                                                    $headers    .=      "MIME-Version: 1.0\r\n";
                                                                    $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                                    
                                                                    require "MAIL_Verification.php";
                                                                    
                                                                    // Nu gaan we de mail verzenden
                                                                        mail($to, $subject, $VerMail, $headers);
                                                                    
                                                                    // Nu nog een instructie voor de gebruiker
                                                                        $Message .= "Je bent succesvol geristreerd bij IT4ALL!" . "<br>". "Binnen enkele ogenblikken ontvang je een activatiemail op adres:" . $Email;
                                                                        $Debug .= 'The user has been succesfuly registered';
                                                    } else {
                                                        // Adduser is mislukt!
                                                            // We gaan de klantgegevens weer netjes wissen uit de databse
                                                               $RemoveCustomer = MySqlDo('Delete', 'Customer', $ClientNumber);
                                                               $Debug .= $AddUser['debug'];
                                                               $Message .= "We konden je op dit moment niet registreren! Probeer het later opnieuw!";
                                                               $Debug .= $RemoveCustomer['debug'];
                                                    // Foutmeldingen naar scherm
                                                        
                                                    }
                                            } else {
                                                // AddCustomer is mislukt
                                                    $Message .= "We konden je op dit moment niet registreren! Probeer het later opnieuw!";
                                                    $Debug .= $AddCustomer['debug'];
                                                    // Foutmeldingen naar scherm

                                            }
                                        }

                                        } else {
                                            // Als het formulier niet is ingevuld
                                                $Message .= "<h1> Toegang geweigerd! </h1><br>";
                                                $Message .= "<p> Je kunt dit bestand niet inzien zonder het registratieformulier in te vullen! </p><br>";
                                                $Debug .= 'This page can only be opened useing the registrational form!<br>';

                                                // Foutmeldingen naar scherm
                                                    
                                        }
                                            
                                     } else {
                                        // Als de verbinding is mislukt
                                            $Debug .= $Connectionarray['debug'];
                                            $Message .= "We konden je op dit moment niet registreren! Probeer het later opnieuw!";
                                                
                                     }
        $_SESSION['message_su'] = $Message;
        $_SESSION['Debug_su'] = $Debug;
        header('location: ../../index.php?page=auth&auth=SignUp');
?>