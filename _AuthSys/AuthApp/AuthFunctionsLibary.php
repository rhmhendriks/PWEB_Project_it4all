<?php

    /**
     * * The funtion libary for authentication purposes
     * 
     *   This file contains multimple functions that 
     *   are used by our authentication system. 
     * 
     *   AT SOME POINT WE HAVE USED THE REGULAR 
     *   FUNCTIONSLIBARY. 
     * 
     *   File created by: Ronald H.M. Hendriks 
     *   File created on: 30/01/2021 at 09:22 AM
     * 
     *   Last Update on: 
     *   Lats Update by:
     * 
     *   short reason:
     */

    require $_SERVER['DOCUMENT_ROOT']."/_init/initialize.php";

    function tokenValidator($token){
        $connarray = MySqlDo_Connector('Connect'); // Get the connection 
        $conn = $connarray['connection']; // Get the connection from array
        $debug = $connarray['debug']; // get the debug data from the array

        $result = false;
        $failReason = 0; // 0 = success, 1 = expired, 3 = multiple or none records

        // prepare statement
        $stm = "SELECT Token from AUTH_2FAapp where Token = $token" . ';';
    
        // run statement
        $runned = $conn->query($stm);
        

        if ($runned->num_rows == 1) { // Check if we have exactly 1 result
            // A token was found
            $debug .= "The statement did run sucesfull!" . "<br />"; // Success geprint naar scherm
            while ($row = $runned->fetch_assoc()){
                $data = $row;
            }

            // Let's verify the token
                // we need the creation and current date
                $timestamp = strtotime($data['GenerationDate']);
                $createDate = date("Y/m/d H:i:s", $timestamp);
                $compareDate = date("Y/m/d H:i:s", strtotime("+30 minutes", $createDate)); // createiontime + 30 minutes
                $currentDate = date("Y/m/d H:i:s"); //current date and time

                // check if token is still valid
                if ($currentDate < $compareDate){
                    // still valid
                    $result = true;
                    $debug .= "The Token is valid" . "<br />";
                    
                } else {
                    // not valid anymore, delete the record
                    $debug .= "The token is expired" . "<br />";
                    $delArray = MySqlDo_Delete('AUTH_2FAapp', 'Token', $token);
                    $debug .= $delArray['debug'];
                    $failReason = 1;
                }
            } else {
                // the token is invalid. 
                $debug .= "The token resulted in none or multiple record. " . "<br />";
                $failReason = 2;
            }

        return array('debug'=>$debug, 'result'=>$result, 'reason'=>$failReason, 'user'=>$data['user'], 'OTP'=>$data['OTP'], 'sessionID'=>$data['sessionID']);
    }

    



?>