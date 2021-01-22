<?php
    require require $_SERVER['DOCUMENT_ROOT']."/_API/API_init.php";

    $token = bin2hex(random_bytes(50));
    $valid_til = date("Y/m/d");
    $company = "";


    // Setup connection to databse
        $connectionArray = MySqlDo_Connector('Connect');
        $conn = $ConnectionArray['connection'];

    function insertToken() {

        // Insert the query
        $query = "INSERT INTO" . APItableName . "SET Token = " . $token . ", Valid = " . $valid_til . ", Company = " . $company;

        // Prepare the query
        $stmt = $conn->prepare($query);

        // Executing the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function dbconnection() {

    }

    // Command to get data from database between two dates
    // SELECT * FROM Meting
    // WHERE Datum BETWEEN '2020-12-17' AND '2020-12-18'
    // AND '2020-12-18'
?>