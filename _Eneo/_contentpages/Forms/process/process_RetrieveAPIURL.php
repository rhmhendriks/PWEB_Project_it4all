<?php
/// AUTHOR: JURRE DE VRIES ///

$token = bin2hex(random_bytes(50));
    $valid_til = date("Y/m/d");
    $company = "";


    // Setup connection to databse
        $connectionArray = MySqlDo_Connector('Connect');
        $conn = $ConnectionArray['connection'];

    function insertToken() {

        // Insert the query
        $query = "INSERT INTO" . APItableName . "SET Token = " . "$token" . ", Valid = " . $valid_til . ", Company = " . $company; // Double quotes added
        // $query = "INSERT INTO APItableName SET Token = $token, Valid = $valid_til, Company = $company";
        // $query = "INSERT INTO APItableName (Token, Valid, Company) VALUES ($token, $valid_til, $company)";

        // Prepare the query
        $stmt = $conn->prepare($query);

        // Executing the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

?>