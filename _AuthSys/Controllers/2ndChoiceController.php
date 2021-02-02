<?php
     if (isset($_POST['madeChoice'])){
          // User made a choice 
          // check the choice 

          // create a token
          $token = bin2hex(random_bytes(128));

          // get username 
          $user = $_SESSION['Email'];

          // put the token to the database along with the users data from session. 
          $Connectionarray = MySqlDo_Connector('Connect');

                if ($Connectionarray['result']){
                    // connection succesfull
                    $DBconnect = $Connectionarray['connection']; // extract connection
                    $debug .= $Connectionarray['debug'];

                    $statementGetLink = "UPDATE AUTH_2FAlinks SET Token = $token WHERE User = $user";
                    $runned = $DBconnect->query($stmGetOTP);

                    if($DBconnect->affected_rows <= 0){
                         $message .= "Er ging iets fout aan onze kant! Probeer het later opnieuw!";
                         $debug .= "No rows are updated!";
                         
                         // remove possible old debug and message info
                         unset($_SESSION['message_su']);
                         unset($_SESSION['Debug_su']);
 
                         $_SESSION['Debug_2FAChoice'] = $message;
                         $_SESSION['Debug_2FAChoice'] = $debug;
 
                         immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAchoice");
                    } else {

                         if($_POST['VerificationMethod'] == "mailVerification"){
                              // The token has been added
                              // go to mail verification
                              immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=index&authenticate=y&token=$token");
                         } else {
                              // The token has been added
                              // now we can redirect the user to the app verification. 
                              immediate_redirect_to($_SERVER['DOCUMENT_ROOT'] . "/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=index&authenticate=y&token=$token");
                         }
                         

                    }
                }
     }
?>