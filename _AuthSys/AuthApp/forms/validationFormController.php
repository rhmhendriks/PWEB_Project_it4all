<?php
    require "../../_init/initialize.php";
    session_start();

        // initialization of variables
            $message = "";
            $debug = "";
            $authstatus ="";

        // This script starts when the OTPapp form is submitted 
            if (isset($_POST['checkPin'])){
                // request a new database connection
                $Connectionarray = MySqlDo_Connector('Connect');

                if ($Connectionarray['result']){
                    // connection succesfull
                    $DBconnect = $Connectionarray['connection']; // extract connection
                    $debug .= $Connectionarray['debug'];

                    // retrieval of filled in data
                    $sessionID = CheckValue($_POST['session']);
                    $enteredPin = CheckValue($_POST['Pin']);
                        
                    // retrieve the pincode hash from the database
                    $stmGetOTP = "SELECT Pincode FROM AUTH_2FAlinks WHERE sessionID = $sessionID;";
                    $runned = $DBconnect->query($statementGetUDATA);

                    if ($runned->num_rows == 1) { // Hier wordt het statement uitgevoerd en checken we of hij is geslaagd. 
                        $debug .= "The statement did tun sucesfull!" . "<br />"; // Success geprint naar scherm
                        while ($row = $runned->fetch_assoc()){
                            $pinHash = $row["Pincode"];
                            $pinAttemptsDB = $row["Pincode"];
                        }

                    if ($pinAttemptsDB < 3){
                        if (!password_verify($enteredPin, $pinHash)){
                            // incorrect Pin was entered
                            $authstatus = false;
                            $pinAttemps++;
    
                            if ($pinAttemptsDB >= 3){
                                $message .= "<br> Uw pincode was onjuist! U heeft geen pogingen meer over, klik HIER om een nieuwe pincode te genereren</a>";
                                $debug .= "<br> The password doesn't match the database hash. The user has $pinAttemptsDB failed attemps. ";
                                
                                $stmRemPin = "UPDATE AUTH_2FAlinks SET Pincode = 'null' WHERE sessionID = $sessionID;";
                                $runned = $DBconnect->query($stmRemPin);

                                if($DBconnect->affected_rows <= 0){
                                    $message .= "Er ging iets fout aan onze kant! Probeer het later opnieuw!";
                                    $debug .= "No rows are updated!";
                                    
                                    // remove possible old debug and message info
                                    unset($_SESSION['message_su']);
                                    unset($_SESSION['Debug_su']);

                                    $_SESSION['message_2FAsetup'] = $message;
                                    $_SESSION['Debug_2FAsetup'] = $debug;

                                    immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=validationForm");
                                }


                                $_SESSION['message_2FAsetup'] = $message;
                                $_SESSION['Debug_2FAsetup'] = $debug;
                            } else {
                                $left = 3-$pinAttemptsDB;
                                $message .= "<br> Uw pincode was onjuist! U heeft nog $left pogingen meer over.</a>";
                                $debug .= "<br> The password doesn't match the database hash. The user has $left attemps left.";
                                
                                $stmResAtmp = "UPDATE AUTH_2FAlinks SET PinAttempts = $pinAttemptsDB WHERE sessionID = $sessionID;";
                                $runned = $DBconnect->query($stmResAtmp);

                                if($DBconnect->affected_rows <= 0){
                                    $message .= "Er ging iets fout aan onze kant! Probeer het later opnieuw!";
                                    $debug .= "No rows are updated!";
                                    
                                    // remove possible old debug and message info
                                    unset($_SESSION['message_su']);
                                    unset($_SESSION['Debug_su']);

                                    $_SESSION['message_2FAsetup'] = $message;
                                    $_SESSION['Debug_2FAsetup'] = $debug;

                                    immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=validationForm");
                                }

                                $_SESSION['message_2FAsetup'] = $message;
                                $_SESSION['Debug_2FAsetup'] = $debug;
                            }
                        } else {
                            // Correct Pin was entered
                            // create OTP
                            $plainOTP = mt_rand(10000000, 99999999);
                            $hashedOTP = password_hash($plainOTP, PASSWORD_DEFAULT);
                            
                            $stmResAtmp = "UPDATE AUTH_2FAlinks SET PinAttempts = 0 WHERE sessionID = $sessionID;";
                            $runned = $DBconnect->query($stmResAtmp);

                            if($DBconnect->affected_rows <= 0){
                                $debug .= "No rows are updated!";
                                
                                // remove possible old debug and message info
                                unset($_SESSION['message_su']);
                                unset($_SESSION['Debug_su']);

                                unset($_SESSION['Debug_2FAsetup']);
                                unset($_SESSION['message_su']);
                                unset($_SESSION['Debug_su']);
        
                                $_SESSION['message_2FAsetup'] = $message;
                                $_SESSION['Debug_2FAsetup'] = $debug;
                                $_SESSION['plainOTP'] = $plainOTP;

                                immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=validationForm");
                            }

                            // remove possible old debug and message info
                            unset($_SESSION['Debug_2FAsetup']);
                            unset($_SESSION['message_su']);
                            unset($_SESSION['Debug_su']);
    
                            $_SESSION['message_2FAsetup'] = $message;
                            $_SESSION['Debug_2FAsetup'] = $debug;
                            $_SESSION['plainOTP'] = $plainOTP;
    
                            // redirect back to form
                            immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=validationForm");


                    }
                    }
            }
        } else {
            $debug .= $Connectionarray['debug'];
            $message .= "Er is iets fout gegaan aan onze kant! Probeer het over een paar seconden opnieuw!";
            $_SESSION['message_2FAsetup'] = $message;
            $_SESSION['Debug_2FAsetup'] = $debug;
            immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=validationForm");
        }
    }
?>