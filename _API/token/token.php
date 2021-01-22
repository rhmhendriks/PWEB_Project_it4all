<?php
$token = bin2hex(random_bytes(50));
$valid_til = date("Y/m/d")
$company = "";

$conn = dbconnection();
$table_name = "API_token";

function insertToken() {

    // Insert the query
    $query = "INSERT INTO " . $table_name . "
        SET
            Token = $token,
            Valid til = $valid_til,
            Company = $company";

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