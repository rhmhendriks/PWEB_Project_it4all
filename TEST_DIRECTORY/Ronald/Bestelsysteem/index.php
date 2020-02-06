<?php
require '../../../_init/initialize.php';
// Database connectie maken

// Style pagina invoegen
echo '<link rel="stylesheet" type="text/css" href="winkelwagen.css" />';

$debug = "";
$message = "";

// Database Connectie maken
    $connection = MySqlDo_Connector('Connect');

    // De connectie testen
        if ($connection['result']){
            $DBconnect = $connection['connection'];
                $debug .= $connection['debug'];
                $debug .= "<br>";

// Alle items uit de db halen
//$sql = mysql_query("SELECT * FROM producten ORDER BY titel ASC");
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
            while ($rec = $statementRunned->fetch_assoc())
            {
                echo '<div class="artikel_e">';
                    // Product id
                    echo '<input type="hidden" name="ArticleID" value="'.$rec['ArticleID'].'" />';
                    
                    // De titel
                    echo '<b>'.$rec['ArticleTitle'].'</b><br />';
                    
                    // De afbeelding
                    //echo '<img alt="" src="CSS/IMAGES/PRODUCTEN/'.$rec['afbeelding'].'" /><br />';
                    
                    // Prijs
                    echo 'SellingPrice: &euro;'.$rec['SellingPrice'].'<br />';
                    
                    echo '<a href="product.php?Pid='.$rec['ArticleID'].'">Meer details</a>';
                echo '</div>';
            }
        echo '</div>';
    }
    // Anders
    else
    {
        // Geen producten
        echo 'Er zijn nog geen producten in de etalage.';
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








