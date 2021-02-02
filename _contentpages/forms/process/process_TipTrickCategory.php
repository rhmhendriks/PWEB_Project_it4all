<?php
    /**
     * The process_TipTrickCategory file processes the new tip trick category.
     * 
     * @author Ronald H.M. Hendriks
     * @version 2.0
     */
    require "../../_init/initialize.php";
    if (isset($_POST['submit'])) {
        $message                        = "";
        $GroupTitle              		= CheckValue($_POST['categorytitel']);

        // It's time to write information to the database
        $AddArray = MySqlDo('Add', 'TipsGroup', "$GroupTitle");
        if (DebugisOn){
            // Now a bit of debug information
            $message .= $AddArray['debug'];
            $message .= "<br>";
        } 
        if ($AddArray['result']){
            $GroupID = $AddArray['ID'];
            $message .= "De Categorie <b>$GroupTitle</b> is toegevoegd aan de database! en heeft als ID: <b>$GroupID</b> <br>";
        } else {
            $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
        }
        // Sending back to the form with feedback information
        $output = $message;
        $redirectlocation = "../../index.php?page=forms&form=tips_tricks_category". "&result=" .urlencode($output);
        immediate_redirect_to($redirectlocation);
    }