<?php
 if (!$_SESSION['loggedin'] == 1){
    header("location:index.php?page=auth&auth=UserNoAccess");
} else {
// variabelen initialiseren
    $message = "";
    $debug = "";

// Sessie starten
    session_start();

// Statement aanmaken
    $statement = "INSERT INTO Orders (CustomerID, OrderDate) VALUES (" . intval( $_SESSION['CustomerID']) . ", NOW())";

// Database Connectie maken
    $connection = MySqlDo_Connector('Connect');

    // De connectie testen
        if ($connection['result']){
            $DBconnect = $connection['connection'];
                $debug .= $connection['debug'];
                $debug .= "<br>";

            // Controleren of het statement is geslaagd
                if($statementRun = $DBconnect->query($statement)){

                // Winkelwagen openen
                $cart = explode('|', $_SESSION['winkelwagen']);
        
                // $bestel id aanmaken
                $OrderID = $DBconnect->insert_id;
        
                // Voor elk product
                    $i = 1;
                        foreach($cart as $products){
                            // Split
                                /*
                                    $product[x] -->
                                        x == 0 -> product id
                                        x == 1 -> hoeveelheid
                                */

                            // Product eigenschappen splitsen
                                $product = explode(',', $products);
                            
                            // Bestelde producten in de database zetteb
                                // Het statement opmaken
                                    $statement2 = "INSERT INTO OrderRules (OrderID, ArticleID, NumberBought) VALUES (" . intval($OrderID) .", ". $product[0] .", " . $product[1] . ")";

                            // Als het statement is geslaagd
                                if($statementRun2 = $DBconnect->query($statement2)){
                                    if($i == 1){
                                        $message .= 'Uw Bestelling is geplaatst.';
                                        unset($_SESSION['winkelwagen']);

                                        $to         =       $_SESSION['Email'];
                                        $subject    =       'IT4ALL - Uw bestelling';
                                        $headers    =       "From: webmaster.it4all@gmail.com\r\n";
                                        $headers    .=      "Reply-To: webmaster.it4all@gmail.com\r\n";
                                        $headers    .=      "MIME-Version: 1.0\r\n";
                                        $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                                                    
                                        require "MAIL_Sending.php";
                                                                    
                                        // Nu gaan we de mail verzenden
                                            mail($to, $subject, $WelMail, $headers);
                                    }
                                }
                            // Als het statement heeft gefaald
                                else{
                                    // Mysql error opvangen
                                    $debug .= 'Er is een fout opgetreden in query nr: 2 <br />';
                                    echo "the statement was $statement2";
                                    $debug .= $DBconnect->error;
                                    $message .= "Er is iets fout gegaan! Probeer het later opnieuw!";
                                }
                            $i++;
                            }
                        } else { // als statement 1 heeft gefaald 
                         // Mysql error opvangen
                            $debug .= "Er is een fout opgetreden in query nr: 1 <br />";
                            echo "the statement was $statement";
                            $debug .= $DBconnect->error;
                            $message .= "Er is iets fout gegaan! Probeer het later opnieuw!";
                        }
                    } else {
                        $debug .= $connection['debug'];
                        $debug .= "<br>";
                        $message .= "Er is iets fout gegaan probeer het later opnieuw";
         
                    }

// De berichten naar het scherm
    if (DebugisOn){
        echo $debug . $message;
    } else {
        echo $message;
    }
}
?>