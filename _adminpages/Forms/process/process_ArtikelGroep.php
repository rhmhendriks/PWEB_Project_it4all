<?php
    /**
    * The process_Artikelgroep file processes an article group.
    * 
    * @author Ronald Hendriks
    * @version 2.0
    */
    require "../../_init/initialize.php";
    if (isset($_POST['submit'])) {
        $message                        = "";
        $GroupTitle              		= CheckValue($_POST['groepstitel']);

        // It's time to write information to the database
        $AddArray = MySqlDo('Add', 'ArticleGroup', "$GroupTitle");
        if (DebugisOn){
            // Now a bit of debug information
            $message .= $AddArray['debug'];
            $message .= "<br>";
        } 
        if ($AddArray['result']){
            $GroupID = $AddArray['ID'];
            $message .= "De Artikelgroep <b>$GroupTitle</b> is toegevoegd aan de database! en heeft als ID: <b>$GroupID</b> <br>";
        } else {
            $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
        }
        // Sending back to the form with feedback information
        $output = $message;
        $redirectlocation = "../../index.php?page=forms&form=artikelgroep_toevoegen". "&result=" .urlencode($output);
        immediate_redirect_to($redirectlocation);
    }
?>