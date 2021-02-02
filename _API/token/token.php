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

    function selectToken() {

        // Select the query
        $query = "SELECT" . * . "FROM" . APItableName . "WHERE Token = " . $token; //. ", Valid = " . $valid_til . ", Company = " . $company
        $result = mysqli_query($conn, $sql); // Erase line after testing

        // Prepare the query
        $stmt = $conn->prepare($query);

        // Erase after testing. Select test
        if (mysqli_num_rows($result) > 0) {
            while($row = mysql_fetch_array($result)) {
                echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            }
        } else {
            echo "No results!";
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