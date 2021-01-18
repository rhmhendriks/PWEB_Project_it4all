<?php
    require "../../_init/initialize.php";
    if (isset($_POST['submit'])) {
        $message                        = "";
        $GroupTitle              		= CheckValue($_POST['groepstitel']);

        // Tijd de informatie naar de database te schrijven
        $AddArray = MySqlDo('Add', 'ArticleGroup', "$GroupTitle");
        if (DebugisOn){
            // nu een beetje debug informatie
            $message .= $AddArray['debug'];
            $message .= "<br>";
        } 
        if ($AddArray['result']){
            $GroupID = $AddArray['ID'];
            $message .= "De Artikelgroep <b>$GroupTitle</b> is toegevoegd aan de database! en heeft als ID: <b>$GroupID</b> <br>";
        } else {
            $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
        }
        // terugsturen naar het formulier met feedback informatie
        $output = $message;
        $redirectlocation = "../../index.php?page=forms&form=artikelgroep_toevoegen". "&result=" .urlencode($output);
        immediate_redirect_to($redirectlocation);
    }
?>