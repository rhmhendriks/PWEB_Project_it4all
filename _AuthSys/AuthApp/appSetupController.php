<?php
    require "../../_init/initialize.php";
    session_start();

        // initialization of variables
            $message = "";
            $debug = "";
            $authstatus ="";

        // This script starts when the OTPapp form is submitted 
            if (isset($_POST['checkCode'])){
                // request a new database connection
                $Connectionarray = MySqlDo_Connector('Connect');

                if ($Connectionarray['result']){
                    // connection succesfull
                    $DBconnect = $Connectionarray['connection']; // extract connection
                    $debug .= $Connectionarray['debug'];

                    // retrieval of filled in data
                    $sessionID = CheckValue($_POST['session']);
                    $enteredOTP = CheckValue($_POST['OTP']);
                        
                    // now we need to retrieve the OTP hash to very the identification code
                    $stmGetOTP = "SELECT * FROM AUTH_2FAapp WHERE sessionID = '$sessionID'";
                    $runned = $DBconnect->query($statementGetUDATA);

                    while ($row = $statementRunnedGetUDATA->fetch_assoc()) {
                        $user = $row['User'];
                        $OTPhash = $row['OTP'];
                    }

                    if (!password_verify($PasswordEntered, $PasswordHash)){
                        // incorrect OTP was entered
                        $authstatus = false;

                        
                        $message .= "<br> De ingevoerde identificatiecode is onjuist! <a href='http://it4all.rhmhendriks.nl/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=index&setup=y'>Klik hier om het nogmaals te proberen.</a>";
                        $debug .= "<br> The password doesn't match the database hash! User has to try again, session removed from database. ";
                        $delArray = MySqlDo_Delete('AUTH_2FAapp', 'sessionID', $sessionID);
                        $_SESSION['Debug_2FAsetup'] = $message;
                        $_SESSION['Debug_2FAsetup'] = $debug;

                        $redirectlocation = $_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=setup2FAapp";
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
                    $redirectlocation = $_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=setup2FAapp";
                }
            }
                                                

?>