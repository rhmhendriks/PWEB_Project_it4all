<?php
// Database connectie maken
require '../../../_init/initialize.php';

// Style pagina invoegen
echo '<link rel="stylesheet" type="text/css" href="winkelwagen.css" />';

$debug = "";
$message = "";

$connection = MySqlDo_Connector('Connect');

    // De connectie testen
        if ($connection['result']){
            $DBconnect = $connection['connection'];
                $debug .= $connection['debug'];
                $debug .= "<br>";

// Alle items uit de db halen
$statement = "SELECT * FROM Articles ORDER BY ArticleTitle ASC";
$statementRunned = $DBconnect->query($statement);

// Als query is gelukt
if($statementRunned)
{
    // Als er items zijn
    if ($statementRunned->num_rows > 0)
    {
        echo '<div class="wrapper">';
            // Alles loopen
            while ($rec = $statementRunned->fetch_assoc()) {
            //print_r($rec);
            //echo $rec['ArticleID'];
            //echo $rec['SellingPrice'];
           // echo $rec['ArticleDescription'];
            echo '<div class="artikel_p">';
                echo '<form action="add.php" method="post">';
                    // Product id
                    echo '<input type="hidden" name="ArticleID" value="'.$rec['ArticleID'].'" />';
                    
                    // De afbeelding
                    //echo '<img alt="" src="CSS/IMAGES/PRODUCTEN/'.$rec['afbeelding'].'" />';
                    
                    // Informatie rechterzijde
                    echo '<div class="info">';
                        // De titel
                        echo '<b>'.$rec['ArticleTitle'].'</b><br />';
                        
                        // Prijs
                        echo '<b>SellingPrice:</b> &euro;'.$rec['SellingPrice'].'<br />';
                        
                        // Aantal
                        echo '<b>Aantal:</b> <input class="aantal_p" type="text" name="NumberBought" size="2" maxlength="2" value="1" /><br />';
                        
                        // Omschrijving
                        echo '<b>Omschrijving:</b><br />';
                        echo nl2br($rec['ArticleDescription']);
                    echo '</div>';
                    
                    // Add knop
                    echo '<input class="submit_p" type="submit" value="Toevoegen" />';
                echo '</form>';
            echo '</div>';
        echo '</div>';
    }}
    // Anders
    else
    {
        // Geen producten
        echo '<p class="error">Er zijn nog geen producten in de etalage.</p>';
    }
}
// Anders
else
{
    // Mysql error opvangen
    echo 'Er is een fout opgetreden bij de query. <br />';
    echo $DBconnect->error;
}
}   else {
                        $debug .= $connection['debug'];
                        $debug .= "<br>";
                        $message .= "Er is iets fout gegaan probeer het later opnieuw";
         
                    }
?>











