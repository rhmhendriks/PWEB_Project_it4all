<?php
    $debug = "";

    // check if the page is requested trough autsys
        if (isset($_GET['auth'])){

            // check what the user wants to do
            if (isset($_GET['setup']) && (isset($_GET['token']))){
                $token = $_GET['token'];
                // 1. validate token
                $tokenResult = tokenValidator($token);

                if ($tokenResult['result'] == true){
                    // 2. send mail with OTP for verification (30min)
                    $plainOTP = mt_rand(10000000, 99999999);

                    // 2.1 Hash the OTP 
                    $hashedOTP = password_hash($plainOTP, PASSWORD_DEFAULT);

                    // 2.2 Retrieve user data
                    $user = $tokenResult['user'];

                    // Get a database connection
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
                                $statement = "SELECT * FROM Users WHERE EMail='$user'";
                                $statementrunned = $DBconnect->query($statement);
                                if ($statementrunned->num_rows > 0) {
                                    while ($rij = $statementrunned->fetch_assoc()) {
                                        $FirstName = $rij['FirstName'];
                                        $LastName = $rij['LastName'];
                                        $Email = $rij['EMail'];
                                    } // wanneer er geen rijen meer zijn
                                }
                            }

                    $FirstName = 

                    // 2.2 send the mail
                    $to         =       $Email;
                    $subject    =       'IT4ALL - Your personal identification code';
                    $headers    =       "From: rhmhendriks@rhmhendriks.nl\r\n";
                    $headers    .=      "Reply-To: rhmhendriks@rhmhendriks.nl\r\n";
                    $headers    .=      "MIME-Version: 1.0\r\n";
                    $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    
                    require "../Authentication_mails/MAIL_2FAappOTPmailVerify.php";
                    
                    // Nu gaan we de mail verzenden
                        mail($to, $subject, $OTPMail, $headers);
                        $debug .= "We have send an email to $Email <br>";
                        $codeSend = date("Y/m/d H:i:s");

                    // 3. check OTP 
                    // 4. Give user form to create pincode
                    // 5. display short tutorial
                    // 6. test if it works

                    $_SESSION['Debug_2FAsetup'] = $debug;
                    $sessionID = $tokenResult['sessionID'];
                    // the actions described above are executed by another page. 
                    immediate_redirect_to("../forms/setup2FAapp.php?sessionID=$sessionID");
                }
                    

            } elseif (isset($_GET['update']) && (isset($_GET['token']))) {
                echo "";
                // 1. validate token
                // 2. send mail with OTP for verification (30min)
                // 3. check OTP 
                // 4. Give user form to create pincode
                // 6. test if it works

            } elseif (isset($_GET['authenticate']) && (isset($_GET['token']))) {
                $token = $_GET['token'];
                // 1. validate token
                $tokenResult = tokenValidator($token);

                if ($tokenResult['result'] == true){
                    // present the user with the pincode form,
                    // after filling this the user will be presented
                    // with the OTP. 
                    // * This is managed from the form controller.

                    immediate_redirect_to("../forms/validationForm.php?sessionID=$sessionID");
                }

            } else {
                echo "<h1>Something went wrong!</h1>";
                echo "<p>The given action in the URL is incorrect. Try again later</p>";
            }
    }

?>