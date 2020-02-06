<?php
// Sessie starten
session_start();

// Kijken of product_id geset is en een nummer is
if(!isset($_POST['ArticleID']) || !is_numeric($_POST['ArticleID']))
{
    exit('Er is geen product id meegezonden');
}
else
{
    $product_id = $_POST['ArticleID'];
}
// Kijken of aantal geset is en een nummer is
if(!isset($_POST['NumberBought']) || !is_numeric($_POST['NumberBought']))
{
    exit('Er is geen product id meegezonden');
}
else
{
    $NumberBought = $_POST['NumberBought'];
}



// Als er niks in de winkelwagen staat
if(empty($_SESSION['winkelwagen']))
{
    // Nieuwe aanmaken
    $_SESSION['winkelwagen'] = $product_id.','.$NumberBought;
}
// Anders
else
{
    // Winkelwagen opsplitsen op de pipe
    $cart = explode('|', $_SESSION['winkelwagen']);

    // Winkelwagen inhoud tellen
    $count = count($cart);

    // Var om te check voor het toevoegen
    $add = TRUE;
    foreach($cart as $products)
    {
        // Exploden
        /*
            $product[x] -->
            x == 0 -> productnummer
            x == 1 -> hoeveelheid
        */
        
        $product = explode(',', $products);
        // Als product al in de winkelwagen is
        if($product[0] == $product_id)
        {
            $product[1] = $product[1] + $NumberBought;
            $add = FALSE;  // Dus niet toevoegen
        }
    
        // En weer in de sessie zetten
        $i++;
        if($i == 1)
        {
            // In de sessie gooien
            $_SESSION['winkelwagen'] = $product[0].','.$product[1];
        }
        // Anders
        else
        {
            // Bij de oude sessie plaatsen
            $_SESSION['winkelwagen'] = $_SESSION['winkelwagen'].'|'.$product[0].','.$product[1];
        }
    }

    // Als er toegevoegd meot worden
    if($add)
    {
        $_SESSION['winkelwagen'] = $_SESSION['winkelwagen'].'|'.$product_id.','.$NumberBought;
    }
}

// Doorsturen
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>