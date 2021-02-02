<?php
/**
 * The process_newarticle file processes a new article.
 * 
 * @author Jurre de Vries and Ronald Hendriks
 * @version 2.0
 */
require "../../_init/initialize.php";
if (isset($_POST['submit'])) {
    $message                        = "";
    $ArticleTitelField				= CheckValue($_POST['artikelnaam']);
    $ArticleDescriptionField		= CheckValue($_POST['artikelomschrijving'], true);
    $ArticleGroupField				= CheckValue($_POST['Articlegroup']);
    $NumberInStockField				= CheckValue($_POST['aantalartikel']);
    $SellingPriceField				= CheckValue($_POST['verkoopprijs']);
    $StockPriceField				= CheckValue($_POST['inkoopprijs']);

    // We get the ID of the selected article group
    $connection = MySqlDo_Connector('Connect');
    if ($connection['result']){
        if (DebugisOn){
            $message .= $connection['debug'];
            $message .= "<br>";
        } 
        $DBconnect = $connection['connection'];
        // We create and execute the statement
        $statement = "SELECT ArticleGroupID FROM ArticleGroups WHERE GroupTitle = '$ArticleGroupField'";
        $statementRun = $DBconnect->query($statement);
        while ($row = $statementRun->fetch_assoc()){
            $ArticleGroupFieldID = $row["ArticleGroupID"];
        if (DebugisOn){
            $message .= "the articlegroup ID = $ArticleGroupFieldID <br>";
            $message .= "Statement = $statement <br>";
            $message .= "<br>";
        }
        if (isset($ArticleGroupFieldID)) {
            $AddArray = MySqlDo('Add', 'Article', "$ArticleTitelField", "$ArticleDescriptionField", "$ArticleGroupFieldID", "$NumberInStockField", "$StockPriceField", "$SellingPriceField");
            if (DebugisOn){
                $message .= $AddArray['debug'];
                $message .= "<br>";
            } if ($AddArray['result']){
                $ArticleID = $AddArray['ID'];
                $imagecategory = "Article";
                //include "../Upload_Image.php";
                $message .= "Het Artikel met ID $ArticleID is toegevoegd aan de database! <br>";
            } else {
                $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
            }
        } else {
            $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
        }
    }
} else {
    if (DebugisOn){
        $message .= $connection['Debug'];
        $message .= "<br>";
    }
    $message .= "Er is iets fout gegeaan! Probeer het later opnieuw!";
}
    if (DebugisOn){
        $output = $message . $imageresultdebug;
    } else {
        $output = $message;
    }

    $redirectlocation = "../../index.php?page=forms&form=toevoegen_artikel". "&result=" .urlencode($output);
  immediate_redirect_to($redirectlocation);
}
?>