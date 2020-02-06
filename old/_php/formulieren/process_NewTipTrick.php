<?php
    require "../../_init/initialize.php";
    if (isset($_POST['submit'])) {
        $message                    = "";
        $PageTitle             		= CheckValue($_POST['paginatitel']);
        $Date                       = CheckValue($_POST['datum']);
        $Authorname                 = CheckValue($_POST['Authorname']);
        $CategoryTitle              = CheckValue($_POST['categorie']);
        $Content                    = CheckValue($_POST['inhoud'], true);
        $Sources                    = CheckValue($_POST['bron'], true);
        $media                      = $_POST['fotoofvideo']; // Wordt niet gecontroleerd, dit gebeurd later! 

        // Nu een tweetal script om ID nummers op te halen
                // We gaan het ID ophalen van de gekozen auteur
                $connection = MySqlDo_Connector('Connect');
                if ($connection['result']){
                    if (DebugisOn){
                        $message .= $connection['debug'];
                        $message .= "<br>";
                    } 
                    $DBconnect = $connection['connection'];
                // We gaan het statement aanmaken en uitvoeren
                $statement = "SELECT AuthorID FROM Authors WHERE FirstName = '$Authorname'";
                $statementRun = $DBconnect->query($statement);
                while ($row = $statementRun->fetch_assoc()){
                    $AuthorID = $row["AuthorID"];
                if (DebugisOn){
                    $message .= "the Author ID = $AuthorID <br>";
                    $message .= "The statment was <b>$statement</b> <br>";
                    $message .= "<br>";
                }
            }
                // We gaan het ID van de categorie ophalen
                // We gaan het statement aanmaken en uitvoeren
                $statement = "SELECT CategoryID FROM TipsTricksCategory WHERE CategoryTitle = '$CategoryTitle'";
                $statementRun = $DBconnect->query($statement);
                while ($row = $statementRun->fetch_assoc()){
                    $CategoryID = $row["CategoryID"];
                if (DebugisOn){
                    $message .= "the Category ID = $CategoryID <br>";
                    $message .= "The statment was <b>$statement</b> <br>";
                    $message .= "<br>";
                }
            }
            MySqlDo_Connector('disconnect', $DBconnect);
        }

        // Nu gaan we verder met het verwerken van het formulier naar de database
        if (isset($AuthorID, $CategoryID)){
            $AddArray = MySqlDo('Add', 'Tip_Trick', "$PageTitle", "$Date", "$AuthorID", "$CategoryID", "$Content", "$Sources");
            if (DebugisOn){
                $message .= $AddArray['debug'];
                $message .= "<br>";
            } if ($AddArray['result']){
                $PageID = $AddArray['ID'];
                $imagecategory = "TipTrick";
                //include "../Upload_Image.php";
                $message .= "De pagina is opgelagen onder ID <b>$PageID</b> in de database! <br>";
            } else {
                $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
            }
        } else {
            $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
        }
    
        $output = $message;
        $redirectlocation = '../../index.php?page=forms&form=New_TipTrick' . "&result=" .urlencode($output);
        immediate_redirect_to($redirectlocation); 
    }     
?>