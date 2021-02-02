<?php
/**
 * The FormOverview file shows an overview of the available forms.
 * 
 * @author Rienan Poortvliet, Jurre de Vries, Luc Willemse and Ronald H.M. Hendriks
 * @version 2.0
 */
if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    echo '<h1>Geen toegang!</h1>';
    echo '<br>';
    echo '<p>Helaas! Je hebt geen toegang tot deze pagina. Deze pagina is alleen toegangkelijk voor Administrators, ben je een Administrator? Log dan eerst in!</p>';
} else {

// This PHP scripted piece of html code generates the overview pages of our database.
// The correct table is determined by an URL on the basis of a GET request.
    
    if (isset($_GET['page'])){ // Check if a page has been directly requested with a GET
        if (isset($_GET['overview'])){ // Check if a table has been given
            $OverviewTable = CheckValue($_GET['overview']); // Here we make sure that no bad code is included
            // Now we build the page
            echo "<div class=CRUDoverview>";
            echo "<h1>" . "Overzicht van de tabel: " . '"' . $OverviewTable . '"' . "</h1><br>";
            echo "<br>";
            echo "De iconen welke getoond zijn naast iedere bij zijn gemaakt door <b>SmashIcons</b> en <b>Freepik</b> van flaticon.com. ";
            // Here below we create the table
            $funtionarray = MySqlDo('Overview', $OverviewTable);
            // Now we print the table to the schema
            echo $funtionarray['ID'];
        } elseif (isset($_GET['overviewjoin'])){
            if ($_GET['overviewjoin'] == AdminForm){
                $columns = ["ClientNumber", "FirstName", "Lastname", "DateofBirth", "Gender", "Address", "PostalCode", "City", "Country", "BIC", "IBAN", "EMail", "LoginAttemps", "Verified", "PrivacyAccepted"];
                // Now we build the page
                $OverviewTable = CheckValue($_GET['overviewjoin']);
                echo "<h1>" . "Overzicht van de tabel: " . '"' . $OverviewTable . '"' . "</h1><br>";
                echo "<br>";
                echo "De iconen welke getoond zijn naast iedere bij zijn gemaakt door <b>SmashIcons</b> en <b>Freepik</b> van flaticon.com. ";
                // Here below we create the table
                $funtionarray = MySqlDo_Overview('AdminForm', $columns, "ClientNumber", 'AdminForm');
                echo $funtionarray['table'];
                echo "</div>";
            


            } else { // If it's not the admin form
                 echo "<h1 class=OverViewH1>" . "Gebruik overview en geen overviewjoin!" . "</h1><br><br>";
                 echo "<p>" . "Controleer de URL! </p>";
            }
        } else { // If no overview has been specified
            echo "<h1 class=OverViewH1>" . "Geen overzicht meegegeven!" . "</h1><br><br>";
            echo "<p>" . "Er is geen overzicht aanvraag gedaan bij de aanroep van deze pagina!" . "<br>" . "Controleer de URL! </p>";
        }     
    } else { // If a page has been requested directly
        echo "<h1>" . "Deze pagina is niet rechtstreeks te benaderen!" . "</h1><br><br>";
        echo "<p>" . "Deze pagina kun je niet rechtstreekt opvragen! Gebruik de menuknoppen!";
    }
}
?>
