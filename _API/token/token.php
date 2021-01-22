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
        // $query = "INSERT INTO APItableName SET Token = $token, Valid = $valid_til, Company = $company";

        // Prepare the query
        $stmt = $conn->prepare($query);

        // Executing the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function selectToken() {

        // Select the query
        $query = "SELECT" . * . "FROM" . APItableName . "WHERE Token = " . $token; //. ", Valid = " . $valid_til . ", Company = " . $company

        // Prepare the query
        $stmt = $conn->prepare($query);

        while($row = mysql_fetch_array($result)) {
            echo $row['column_name']; // Print a single column data
            echo print_r($row);       // Print the entire row data
        }
        // Executing the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // Command to get data from database between two dates
    // SELECT * FROM Meting
    // WHERE Datum BETWEEN '2020-12-17' AND '2020-12-18'
    // AND '2020-12-18'
?>