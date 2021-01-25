<?php
    function createSelectStatementData($fromdate, $tildate){
        return "SELECT * FROM Meting ORDER BY id WHERE Datum BETWEEN $fromdate AND $tildate";
    }

    function runSelectStatement($statement){
        $connectionArray = MySqlDo_Connector('Connect');
        $conn = $ConnectionArray['connection'];

        $statementrunned = $conn->query($statement); // statement uitvoeren

        if ($statementrunned->num_rows > 0) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }

        $conn->close();

        return $Information = array("data"=>$statementrunned, "result"=>$result);
    }


?>