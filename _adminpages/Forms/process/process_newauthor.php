<?php
    require "../../_init/initialize.php";
    if (isset($_POST['submit'])) {
        $message                        = "";
        $FirstName                 		= CheckValue($_POST['voornaam']);
        $LastName                       = CheckValue($_POST['achternaam']);
        $LoginID                        = CheckValue($_POST['loginid']);
    
        // Tijd de informatie naar de database te schrijven
        $AddArray = MySqlDo('Add', 'Author', "$FirstName", "$LastName", "$LoginID");
        if (DebugisOn){
            // nu een beetje debug informatie
            $message .= $AddArray['debug'];
            $message .= "<br>";
        } 
        if ($AddArray['result']){
            $AuthorID = $AddArray['ID'];
            $message .= "<b>$FirstName $LastName</b> is nu als auteur toegevoegd aan de database! Het auteur ID is <b>$AuthorID</b><br>";
        } else {
            $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
        }
        // terugsturen naar het formulier met feedback informatie
        $output = $message;
        $redirectlocation = "../..//index.php?page=forms&form=author_toevoegen". "&result=" .urlencode($output);
        immediate_redirect_to($redirectlocation);
    }
?>