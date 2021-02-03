<?php
    require "../API_init.php";
    function createSelectStatementData($fromdate, $tildate){
        return "SELECT * FROM Meting WHERE Datum BETWEEN '$fromdate' AND '$tildate'";
    }

    function runSelectStatement($statement){
        echo "HALOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO";
        $ConnectionArray = MySqlDo_Connector('Connect');
        //print_r($ConnectionArray);
        $conn = $ConnectionArray['connection'];
        echo $ConnectionArray['debug'];

        $statementrunned = $conn->query($statement); // statement uitvoeren

        print_r($statementrunned);

        /*if ($statementrunned->num_rows > 0) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }*/

        //$conn->close();

        return $Information = array("data"=>$statementrunned, "result"=>true, "debug"=>$ConnectionArray['debug']);
    }


?>