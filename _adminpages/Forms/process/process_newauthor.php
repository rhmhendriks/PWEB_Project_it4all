<?php
    /**
    * The process_newauthor file processes the new author.
    * 
    * @author Ronald Hendriks
    * @version 2.0
    */
    require "../../_init/initialize.php";
    if (isset($_POST['submit'])) {
        $message                        = "";
        $FirstName                 		= CheckValue($_POST['voornaam']);
        $LastName                       = CheckValue($_POST['achternaam']);
        $LoginID                        = CheckValue($_POST['loginid']);
    
        // It's time to write information to the database
        $AddArray = MySqlDo('Add', 'Author', "$FirstName", "$LastName", "$LoginID");
        if (DebugisOn){
            // Now a bit of debug information
            $message .= $AddArray['debug'];
            $message .= "<br>";
        } 
        if ($AddArray['result']){
            $AuthorID = $AddArray['ID'];
            $message .= "<b>$FirstName $LastName</b> is nu als auteur toegevoegd aan de database! Het auteur ID is <b>$AuthorID</b><br>";
        } else {
            $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
        }
        // Sending back to the form with feedback information
        $output = $message;
        $redirectlocation = "../../index.php?page=forms&form=author_toevoegen". "&result=" .urlencode($output);
        immediate_redirect_to($redirectlocation);
    }
?>