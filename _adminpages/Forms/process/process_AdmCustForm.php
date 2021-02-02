<?php
    /**
    * The process_AdmCustForm file processes an admin user.
    * 
    * @author Jurre de Vries and Ronald Hendriks
    * @version 2.0
    */
    require "../../_init/initialize.php";


    if (isset($_POST['submit'])) {
        // First we check if the filled in passwords match
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

            // Now we create a database connection
            $ConnectionArray = MySqlDo_connector('Connect');
            $DBconnect = $ConnectionArray['connection'];
            $message .= $ConnectionArray['debug'];
            if ($ConnectionArray['result']){
                $statement = "SELECT * FROM Users WHERE Email = " . "'$Email'" . "LIMIT 1";
                $StatementRunned = $DBconnect->query($statement);
            } else {
                $message .= $ConnectionArray['debug'];
            }

            // We check if the user doesn't exist
            
                // Now e check if the user does exist
                if ($StatementRunned->num_rows > 0){
                    // The user does exists!
                    $message .= 'Er bestaat al een gebruiker dit mailadres! Je kunt <a href="../../index.php?page=forms&form=login">HIER INLOGGEN</a>';
                } else {
                    // The user doesn't exists yet
                        // It's time to write the first part of the values to the database into the table Customers
                        $AddArray = MySqlDo('Add', 'Customer', "$FirstName", "$LastName", "$DateofBirth", "$Gender", "$Adress", "$PostalCode", "$City", "$Country", "$BIC", "$IBAN");
                        
                        if (DebugisOn){
                            // Now a bit of debug information
                            $message .= "<b> Adding to the Customers Table </b><br>";
                            $message .= $AddArray['debug'];
                            $message .= "<br>";
                        } if ($AddArray['result']){
                            // We note the customer nuumber for later
                            $CustomerID = $AddArray['ID'];
                        
                            // Now we check if the mail address has to be verified
                            if (!$MailVerified == TRUE){
                        
                                $token = bin2hex(random_bytes(50));  // Adding the token for verification
                                $Password = mt_rand(10000000, 99999999); // Adding the activation code
                                $PasswordHash = password_hash($Password, PASSWORD_DEFAULT, $options);
                            } else {
                       
                                $token = NULL; // No token is needed
                            }
                            // Now we add values to the table users
                            $AddArray2 = MySqlDo('Add', 'User', "$Email", "$CustomerID", "$PasswordHash", $Admin, 0, $MailVerified, "$token", true, "#FFFFFF");
                            if (DebugisOn){
                                // Now we add debug information
                                $message .= "<br><b> Adding to the Users Table </b><br>";
                                $message .= $AddArray2['debug'];
                                $message .= "<br>";
                            }
                            if ($AddArray2['result']){
                                // A bit of feedback for the user to the screen
                                    // First we look if a verification mail must be send
                                    if ($MailVerified != TRUE){
                                        // Now we send the verification mail
                                            $ActivationCode = $Password;
                                            // Now we prepare the mail
                                            $to         =       $Email;
                                            $subject    =       'IT4ALL - Verify your email address';
                                            $headers    =       "From: webmaster.it4all@gmail.com\r\n";
                                            $headers    .=      "Reply-To: webmaster.it4all@gmail.com\r\n";
                                            $headers    .=      "MIME-Version: 1.0\r\n";
                                            $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                                        
                                            require "../../_AuthSys/Authentication_mails/MAIL_Verification.php";
                                                                        
                                            // Now we send the mail
                                            mail($to, $subject, $VerMail, $headers);

                                            $message .= "De klant met klantnummer  <b>$CustomerID</b> is toegevoegd aan de database! Er is een verificatiemail verstuurd.  <br>";
                                    } else {
                                        // The user has already been verified
                                            // We send a welcome mail!
                                                $to         =       $Email;
                                                $subject    =       'IT4ALL - Welkom op onze site!';
                                                $headers    =       "From: webmaster.it4all@gmail.com\r\n";
                                                $headers    .=      "Reply-To: webmaster.it4all@gmail.com\r\n";
                                                $headers    .=      "MIME-Version: 1.0\r\n";
                                                $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                                            
                                                require "../../_AuthSys/Authentication_mails/MAIL_Welcome.php";
                                                                    
                                            // Now we send a mail
                                            mail($to, $subject, $WelMail, $headers);

                                        $message .= "De klant met klantnummer  <b>$CustomerID</b> is toegevoegd aan de database! Er is welkomstmail versturd. <br>";
                                    } 
                            } else {
                                $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
                            }
                        } else {
                            $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
                        }
                        // Now we send back the form with feedback information
                        $output = $message;
                        $redirectlocation = '../../index.php?page=forms&form=admin_form'. '&result=' .urlencode($output);
                        immediate_redirect_to($redirectlocation);
                }
            }
            } 
        
?>