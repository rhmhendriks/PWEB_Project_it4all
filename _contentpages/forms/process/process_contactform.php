<?php
/**
 * The process_contactform file processes the contact form.
 * 
 * @author Ronald H.M. Hendriks
 * @version 2.0
 */

require "../../_init/initialize.php";

if (isset($_POST['verzenden'])) {
    $message        = "";
    // write to a variable
    $Name           = CheckValue($_POST['naam']);
    $PhoneNumber    = CheckValue($_POST['telefoonnummer']);
    $EMailAddress   = CheckValue($_POST['emailadres']);
    $Question       = CheckValue($_POST['vraag_opmerking'], TRUE);

    // write to the database
    $AddArray = MySqlDo('Add', 'Contactform', "$Name", "$PhoneNumber", "$EMailAddress", "$Question");
            if (DebugisOn){
                $message .= $AddArray['debug'];
                $message .= "<br>";
            } if ($AddArray['result']){
                $ApplyID = $AddArray['ID'];
                $message .= "Je contactformulier is verzonden!<br>";
            } else {
                    $message .= "Er is iets fout gegaan! Probeer het later opnieuw!";
                }
            

                $output = $message;
                $redirectlocation = "../../index.php?page=forms&form=contactformulier". "&result=" .urlencode($output);
                immediate_redirect_to($redirectlocation);
} 

?>