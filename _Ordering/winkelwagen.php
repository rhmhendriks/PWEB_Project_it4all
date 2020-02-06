<?php
// Sessie starten
session_start();

$error = false;

// Database connectie maken
#require '../../../_init/initialize.php';

// Style pagina invoegen
echo '<link rel="stylesheet" type="text/css" href="../_css/Newstylesheet.css" />';

// Kijk of er iets in de winkelwagen zit
if(empty($_SESSION['winkelwagen']))
{
    echo '<div id=errorWrapper>';
    echo '<p class="error">Uw winkelwagen is momenteel leeg.</p>';
    echo '</div>';
}
// Anders
else
{
    // De tabelkoppen
    echo '<div id="ShoppingOverflow">';
    echo '<table class="shoppingcart">' . '<br>' ;
    echo '<tr>';
    echo    '<th>Aantal</th> <th>Artikelnummer</th> <th>Product</th> <th>Prijs</th>' ;
    echo '</tr>';
    
        // Exploden
        $cart = explode('|', $_SESSION['winkelwagen']);


        // Begin formulier
        echo '<form action="upd_winkelwagen.php" method="post">';
            // Show winkelwagen
            $i = 0;




            foreach($cart as $products)
            {
                // Split
                /*
                $product[x] -->
                    x == 0 -> product id
                    x == 1 -> hoeveelheid
                */
                $product = explode(',', $products);

                $debug = "";
                $message = "";

                $connection = MySqlDo_Connector('Connect');

    // De connectie testen
        if ($connection['result']){
            $DBconnect = $connection['connection'];
                $debug .= $connection['debug'];
                $debug .= "<br>";
        
                // Get product info
                $statement = ("SELECT * FROM Articles WHERE ArticleID = '".intval($product[0])."'");
                $statementRunned = $DBconnect->query($statement);
              
                // Als query gelukt is
                if($statementRunned)
                {

                    
                    
                    // Als er items zijn
                    if ($statementRunned->num_rows > 0)
                    {
                       
                        // Alle items echoën
                        $rec = $statementRunned->fetch_assoc();
                        // Verborgen vars
                        echo '<input type="hidden" name="productnummer_'.$i.'" value="'.$product[0].'" />';
                        $i++;

                            // Aantal
                            echo '<tr><td><input type="text" class="aantal_w" name="hoeveelheid_'.$i.'" value="'.$product[1].'" size="2" maxlength="2" onKeyPress="return submitenter(this,event)" /></td>';
                            
                            // Artikel nummer
                            echo '<td>';
                                if($rec['NumberInStock'] < $product[1])
                                {
                                    echo '<font style="color: #FF0000;">'.$product[0].'</font>';
                                    $error = TRUE;
                                }
                                else
                                {
                                    echo $product[0];
                                }
                            echo  '</td>';
                   
                            // titel
                            echo '<td>';
                                echo $rec['ArticleTitle'];
                            echo '</td>';
                            
                            // Prijs
                            echo '<td>';
                                echo '&euro; '.($rec['SellingPrice'] * $product[1]);
                            echo '</td></tr>';
                    }
                    // Anders
                    else
                    {
                        // Fout weergeven
                        echo '<p class="error">Dit product is er niet meer.</p>';
                    }
                    
                }
                // Anders
                else
                {
                    // Mysql error opvangen
                    echo 'Er is een fout opgetreden in de query. <br />';
                    echo mysql_error();
                }
            }   else {
                        $debug .= $connection['debug'];
                        $debug .= "<br>";
                        $message .= "Er is iets fout gegaan probeer het later opnieuw";
         
                    }
            }
        echo '</form>';
        
        if($error == TRUE)
        {
            echo '<p class="error">';
                echo 'Van artikelen waarvan het artikelnummer rood is gekleurd hebben we niet voldoende op voorraad om je bestelling direct uit te kunnen leveren.';
            echo '</p>';
        }
        echo '</table>';
        echo ' <div id="temporaryform">;
         <form method="post" action="" > <input type="submit" name="legen" value="Winkelwagen leeghalen"></form><br />
         <form method="post" action="index.php?page=Order&Order=afreken" > <input type="submit" name="legen" value="afrekenen"></form>
         </div>';

    if (isset($_POST['legen'])) {
        unset($_SESSION['winkelwagen']);
    }

    
    
}
?>