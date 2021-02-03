<?php
#luc
 if (!$_SESSION['loggedin'] == 1){
    header("location:index.php?page=auth&auth=UserNoAccess");
} else {
// delete_cart.php
session_start();

// Als er iets in de winkelwagen zit
if(empty($_SESSION['winkelwagen']))
{
    // Terug sturen
    header('Location: winkelwagen.php');
}
// Anders
else
{
    // Leeg de winkwelwagen
    session_unset($_SESSION['winkelwagen']);

    // Terug sturen
    header('Location: winkelwagen.php');
}
}
?>