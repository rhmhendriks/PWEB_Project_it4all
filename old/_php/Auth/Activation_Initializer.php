<?php
    // We initieren de variabelen die we gaan gebruiken
        $message = "";
        $debug = "";
    // We geven aan dat we een nieuwe sessie aanmaken of een huidige sessie willen gebruiken
        session_start();
  
    // We checken of de pagina niet rechtstreeks is aangevraagd
        if (!isset($_GET['page']) && !isset($_GET['auth'])){
            $message .= '<h1>Pagina niet rechtreeeks toegangkelijk!</h1><pre><pre>';
            $message .= 'Deze pagina is beveiligd en kan enkel aangeroepen worden via een mail verificatiesysteem. Gebruik AUB de link de mail.';
            $debug .= '<br>This page was not requested using index and auth!<br>';
        }

    // We checken of er een token is meegegeven in de URL, zo niet dan komt er een foutmelding. 
        if (!isset($_GET['token'])){
            if (isset($_GET['note'])){

            } else {
            $message .= '<h1> Pagina niet rechtreeeks toegangkelijk! </h1><pre><pre>';
            $message .= 'Deze pagina is beveiligd en kan enkel aangeroepen worden via een mail verificatiesysteem. Gebruik AUB de link de mail.';
            }
        } else {
            $Token = $_GET['token'];
            // We maken een connectie met de database om de Form Values op te halen
                // De connectie wordt aangemaakt en de array verwerkt
                    $ConnectionArray = MySqlDo_Connector('Connect');
                    if (!$ConnectionArray['result']){
                        // Conectie gefaald
                            $message .= 'Er is iets fout gegaan probeer het later opnieuw!<br>';
                            $debug .= $ConnectionArray['debug'];
                    } else {
                        // Connectie success
                            $debug .= $ConnectionArray['debug'];
                            $DBconnect = $ConnectionArray['connection'];
                            // We gaan wat waarden ophalen
                                $statementGetUser = "SELECT * FROM  Users WHERE Token = '$Token';";
                                if ($statementrunned = $DBconnect->query($statementGetUser)){
                                    $debug .= "<br> The statement <b>$statementGetUser</b> was succesfull!<br>";
                                    if ($statementrunned->num_rows > 0) {
                                        while ($rij = $statementrunned->fetch_assoc()) {
                                            $CustomerID = $rij['CustomerID'];
                                            $EmailAddress = $rij['EMail'];
                                        } // wanneer er geen rijen meer zijn
                                    } // afsluiting user gevonden

                                } else {// afsluiting statement gelukt
                                    $message .= "Er is iets fout gegaan probeer het later opnieuw!";
                                    $debug .= "The statement to get form information failed! the statement was <b> $statementGetUser </b>the error was <b>" . $DBconnect->error . "</b>.<br>";
                                }// Afsluiting statement gefaald

                    } // afsluting connectie
                 } // afsluiting wel een token



?>