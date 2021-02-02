<?php
    /**
     * The process_NewTipTrick file processes the new tip trick.
     * 
     * @author Ronald H.M. Hendriks
     * @version 2.0
     */
    require "../../_init/initialize.php";
    if (isset($_POST['submit'])) {
        $message                    = "";
        $PageTitle             		= CheckValue($_POST['paginatitel']);
        $Date                       = CheckValue($_POST['datum']);
        $Authorname                 = CheckValue($_POST['Authorname']);
        $CategoryTitle              = CheckValue($_POST['categorie']);
        $Content                    = CheckValue($_POST['inhoud'], true);
        $Sources                    = CheckValue($_POST['bron'], true);
        $media                      = $_POST['fotoofvideo']; // Won't be checked, this happens later! 

        // Now a couple of scripts to get the ID numbers
                // We pick up the ID of the chosen author
                $connection = MySqlDo_Connector('Connect');
                if ($connection['result']){
                    if (DebugisOn){
                        $message .= $connection['debug'];
                        $message .= "<br>";
                    } 
                    $DBconnect = $connection['connection'];
                // We create and execute the statement
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
                // We get the ID of the category
                // We create and execute the statement
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

        // Now we continue to process the form to the database
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