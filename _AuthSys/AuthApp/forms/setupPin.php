<?php
     /**
     * Author: Ronald H.M. Hendriks
     */
    require "../../_init/initialize.php";
    session_start();

        // initialization of variables
            $message = "";
            $debug = "";
            $authstatus ="";

        // This script starts when the OTPapp form is submitted 
            if (isset($_POST['savePin'])){
                // request a new database connection
                $Connectionarray = MySqlDo_Connector('Connect');

                if ($Connectionarray['result']){
                    // connection succesfull
                    $DBconnect = $Connectionarray['connection']; // extract connection
                    $debug .= $Connectionarray['debug'];

                    // retrieval of filled in data
                    $sessionID = CheckValue($_POST['session']);
                    $enteredPin = CheckValue($_POST['Pin']);
                    $enteredPin2 = CheckValue($_POST['Pin2']);
                    $enteredsqA = CheckValue($_POST['sqA']);
                    $enteredsqB = CheckValue($_POST['sqB']);

                    if(!$enteredPin == $enteredPin2){
                        $message .= "De pincodes komen niet overeen! Probeer het opnieuw.";
                        $debug .= "The passwords didn't match, the javascript must have been disabled.";
                        
                        // remove possible old debug and message info
                        unset($_SESSION['message_su']);
                        unset($_SESSION['Debug_su']);

                        $_SESSION['Debug_2FAsetup'] = $message;
                        $_SESSION['Debug_2FAsetup'] = $debug;

                        immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=setup2FAapp");
                    }
                        
                    // Now we need to hash the data and send it to the database
                    // We also remove the token because of the fact that 2FAapp is enabled from now on. 
                    $pin = password_hash($enteredPin, PASSWORD_DEFAULT);
                    $sqA = password_hash($enteredsqA, PASSWORD_DEFAULT);
                    $sqB = password_hash($enteredsqB, PASSWORD_DEFAULT);



                    $stmGetOTP = "UPDATE AUTH_2FAlinks SET Pincode = $pin, SecurityQuestionA = '$sqA', SecurityQuestionB = '$sqB', Token = 'null' WHERE 'AUTH_2FAlinks.ID' = $sessionID;";
                    $runned = $DBconnect->query($stmGetOTP);

                    if($DBconnect->affected_rows <= 0){
                        $message .= "Er ging iets fout aan onze kant! Probeer het later opnieuw!";
                        $debug .= "No rows are updated!";
                        
                        // remove possible old debug and message info
                        unset($_SESSION['message_su']);
                        unset($_SESSION['Debug_su']);

                        $_SESSION['Debug_2FAsetup'] = $message;
                        $_SESSION['Debug_2FAsetup'] = $debug;

                        immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=setup2FAapp");
                    }

                    if (!password_verify($PasswordEntered, $PasswordHash)){
                        // incorrect OTP was entered
                        $authstatus = false;

                        
                        $message .= "<br> De ingevoerde identificatiecode is onjuist! <a href='http://it4all.rhmhendriks.nl/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=index&setup=y'>Klik hier om het nogmaals te proberen.</a>";
                        $debug .= "<br> The password doesn't match the database hash! User has to try again, session removed from database. ";
                        $delArray = MySqlDo_Delete('AUTH_2FAapp', 'sessionID', $sessionID);
                        $_SESSION['Debug_2FAsetup'] = $message;
                        $_SESSION['Debug_2FAsetup'] = $debug;

                        immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=setup2FAPin");
                    } else {
                        // Correct OTP was entered

                        // remove possible old debug and message info
                        unset($_SESSION['Debug_2FAsetup']);
                        unset($_SESSION['message_su']);
                        unset($_SESSION['Debug_su']);

                        $_SESSION['Debug_2FAsetup'] = $message;
                        $_SESSION['Debug_2FAsetup'] = $debug;

                        // redirect to tutorial
                        immediate_redirect_to($redirectlocation);
                    }
                } else {
                    $debug .= $Connectionarray['debug'];
                    $message .= "Er is iets fout gegaan aan onze kant! Probeer het over een paar seconden opnieuw!";
                    $_SESSION['Debug_2FAsetup'] = $message;
                    $_SESSION['Debug_2FAsetup'] = $debug;
                    immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=setup2FAPin");
                }
            }
                                                

?>