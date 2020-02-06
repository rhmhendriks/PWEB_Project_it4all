<?php
require '../../../_init/initialize.php';
// variabelen initialiseren
    $message = "";
    $debug = "";

// Sessie starten
    session_start();
    $_SESSION['user_id'] = '1';

// Statement aanmaken
    $statement = "INSERT INTO Orders (CustomerID, OrderDate) VALUES (" . intval($_SESSION['user_id']) . ", NOW())";

// Database Connectie maken
    $connection = MySqlDo_Connector('Connect');

    // De connectie testen
        if ($connection['result']){
            $DBconnect = $connection['connection'];
                $debug .= $connection['debug'];
                $debug .= "<br>";

        // Het statement gaan we uitvoeren
            $statementRun = $DBconnect->query($statement);

            // Controleren of het statement is geslaagd
                if($statementRun){

                // Winkelwagen openen
                $cart = explode('|', $_SESSION['winkelwagen']);
        
                // $bestel id aanmaken
                $OrderID = mysql_insert_id();
        
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
                                    $statement2 = "INSERT INTO bestelregel (OrderID, ArticleID, NumberBought) VALUES (" . intval($OrderID) . $product[0] . $product[1] . ")";
                                // Het statement uitvoeren
                                    $statementRun2 = $DBconnect->query($statement2);   

                            // Als het statement is geslaagd
                                if($sql2){
                                    if($i == 1){
                                        $message .= 'Uw Bestelling is geplaatst.';
                                    }
                                }
                            // Als het statement heeft gefaald
                                else{
                                    // Mysql error opvangen
                                    $debug .= 'Er is een fout opgetreden in query nr: 2 <br />';
                                    echo "the statement was $statement";
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
?>