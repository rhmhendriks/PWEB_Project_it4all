<?php

require "../../_init/initialize.php";

if (isset($_POST['verzenden'])) {
    $message        = "";
    // wegschrijven naar variabele
    $Name           = CheckValue($_POST['naam']);
    $PhoneNumber    = CheckValue($_POST['telefoonnummer']);
    $EMailAddress   = CheckValue($_POST['emailadres']);
    $Question       = CheckValue($_POST['vraag_opmerking'], TRUE);

    // wegschrijven naar de database
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