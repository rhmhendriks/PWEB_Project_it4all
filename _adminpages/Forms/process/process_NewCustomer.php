<?php
        /**
        * The process_NewCustomer file processes the new customer.
        * 
        * @author Ronald Hendriks
        * @version 2.0
        */
        require "../../_init/initialize.php";
    	if (isset($_POST['submit'])) {
            $CustomerID 	= null; // Temporary null
            $Firstname		= CheckValue($_POST['voornaam']);
            $Lastname		= CheckValue($_POST['achternaam']);
            $DateOfBirth	= CheckValue($_POST['geboortedag']);
            $Gender			= CheckValue($_POST['gender']);
            $Address		= CheckValue($_POST['adres']);
            $Postalcode		= CheckValue($_POST['postcode1']) . CheckValue($_POST['postcode2']);
            $City           = CheckValue($_POST['plaats']);
            $Country		= CheckValue($_POST['land']);
            $BIC			= CheckValue($_POST['BIC']);
            $IBAN			= CheckValue($_POST['IBAN']);

          // It's time to write information to the database
          $AddArray = MySqlDo('Add', 'Customer', "$Firstname", "$Lastname", "$DateOfBirth", "$Gender", "$Address", "$Postalcode", "$City", "$Country", "$BIC", "$IBAN");
          if (DebugisOn){
              // Now a bit of debug information
              $message .= $AddArray['debug'];
              $message .= "<br>";
          } 
          if ($AddArray['result']){
              $CustomerID = $AddArray['ID'];
              $message .= "De klant is toegevoegd aan de database! en heeft het klantnummer <b>$CustomerID</b> <br>";
          } else {
              $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
          }
          // Sending back to the form with feedback information
          $output = $message;
          $redirectlocation = "../../index.php?page=forms&form=toevoegen_klant". "&result=" .urlencode($output);
          immediate_redirect_to($redirectlocation);
      }
?>