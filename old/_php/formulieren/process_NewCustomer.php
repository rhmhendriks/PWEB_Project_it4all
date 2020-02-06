<?php
        require "../../_init/initialize.php";
    	if (isset($_POST['submit'])) {
            $CustomerID 	= null; //tijdelijk null
            $Firstname		= CheckValue($_POST['voornaam']);
            $Lastname		= CheckValue($_POST['achternaam']);
            $DateOfBirth	= CheckValue($_POST['geboortedag']);
            $Gender			= CheckValue($_POST['gender']);
            $Address		= CheckValue($_POST['adres']);
            $Postalcode		= CheckValue($_POST['postcode1']) . CheckValue($_POST['postcode2']));
            $City           = CheckValue($_POST['plaats']);
            $Country		= CheckValue($_POST['land']);
            $BIC			= CheckValue($_POST['BIC']);
            $IBAN			= CheckValue($_POST['IBAN']);

          // Tijd de informatie naar de database te schrijven
          $AddArray = MySqlDo('Add', 'Customer', "$Firstname", "$Lastname", "$DateOfBirth", "$Gender", "$Address", "$Postalcode", "$City", "$Country", "$BIC", "$IBAN");
          if (DebugisOn){
              // nu een beetje debug informatie
              $message .= $AddArray['debug'];
              $message .= "<br>";
          } 
          if ($AddArray['result']){
              $CustomerID = $AddArray['ID'];
              $message .= "De klant is toegevoegd aan de database! en heeft het klantnummer <b>$CustomerID</b> <br>";
          } else {
              $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
          }
          // terugsturen naar het formulier met feedback informatie
          $output = $message;
          $redirectlocation = "../../index.php?page=forms&form=toevoegen_klant". "&result=" .urlencode($output);
          immediate_redirect_to($redirectlocation);
      }
?>