<?php 
if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    echo '<h1>Geen toegang!</h1>';
    echo '<br>';
    echo '<p>Helaas! Je hebt geen toegang tot deze pagina. Deze pagina is alleen toegangkelijk voor Administrators, ben je een Administrator? Log dan eerst in!</p>';
} else {

// Dit PHP gescripte stuk html code genereerd de overzichtpagina's van onze databases. 
// De juiste tabel wordt via de URL aan de hand van een GET request bepaald. 
    
    if (isset($_GET['page'])){ // Controleren of de pagina rechtreeks is opgevraagd of met een GET
        if (isset($_GET['overview'])){ // controleren of er een tabel is meegegeven
            $OverviewTable = CheckValue($_GET['overview']); // Ny=u zorgen we ervoor dat er geen slechte code wordt meegenomen
            // nu bouwen we de pagina
            echo "<h1>" . "Overzicht van de tabel: " . '"' . $OverviewTable . '"' . "</h1><br>";
            echo "<br>";
            echo "De iconen welke getoond zijn naast iedere bij zijn gemaakt door <b>SmashIcons</b> en <b>Freepik</b> van flaticon.com. ";
            // Hieronder wordt de tabel gemaakt
            $funtionarray = MySqlDo('Overview', $OverviewTable);
            // Nu printen we de tabel naar het scherm
            echo $funtionarray['ID'];
        } elseif (isset($_GET['overviewjoin'])){
            if ($_GET['overviewjoin'] == AdminForm){
                $columns = ["ClientNumber", "FirstName", "Lastname", "DateofBirth", "Gender", "Address", "PostalCode", "City", "Country", "BIC", "IBAN", "EMail", "LoginAttemps", "Verified", "PrivacyAccepted"];
                // nu bouwen we de pagina
                $OverviewTable = CheckValue($_GET['overviewjoin']);
                echo "<h1>" . "Overzicht van de tabel: " . '"' . $OverviewTable . '"' . "</h1><br>";
                echo "<br>";
                echo "De iconen welke getoond zijn naast iedere bij zijn gemaakt door <b>SmashIcons</b> en <b>Freepik</b> van flaticon.com. ";
                // Hieronder wordt de tabel gemaakt
                $funtionarray = MySqlDo_Overview('AdminForm', $columns, "ClientNumber", 'AdminForm');
                echo $funtionarray['table'];
            


            } else { // als het niet het admin form is
                 echo "<h1 class=OverViewH1>" . "Gebruik overview en geen overviewjoin!" . "</h1><br><br>";
                 echo "<p>" . "Controleer de URL! </p>";
            }
        } else { // als er geen overzicht is gespecificeerd
            echo "<h1 class=OverViewH1>" . "Geen overzicht meegegeven!" . "</h1><br><br>";
            echo "<p>" . "Er is geen overzicht aanvraag gedaan bij de aanroep van deze pagina!" . "<br>" . "Controleer de URL! </p>";
        }     
    } else { // als de pagina rechtstreeks is opgevraagd. 
        echo "<h1>" . "Deze pagina is niet rechtstreeks te benaderen!" . "</h1><br><br>";
        echo "<p>" . "Deze pagina kun je niet rechtstreekt opvragen! Gebruik de menuknoppen!";
    }
}
?>
