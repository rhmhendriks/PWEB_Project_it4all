<?php 
    // Below we have the databse parameters
    define("ServerName", "localhost:3306");
    define("DBSigninName", "it4alldbuser");
    define("DBKey", "It4llit4all2019!");
    define("DBname", "IT4all NEW");

    define("APItableName", "API_token");

    function MySqlDo_Connector($action, $Connection = NULL){
        $returnconnection = "";
        if ($action == 'Connect'){
            $Connection = @new mysqli(ServerName, DBSigninName, DBKey, DBname);
            if ($Connection->connect_error) { // Er wordt gecontroleerd op fouten bij de databaseverbinding
                $returndebug = die("Oops! The databse connection failed!, The infotmation below is generated for the site administrator. " . "<br />" . $Connection->connect_error) . "<br />";
                $resultfunction = false;
            } else {
                $returndebug = "Yeah! The connection is active! Now we can do some SQL statement!" . "<br />"; // Nu wordt er weergegeven dat de database connectie geslaagd is
                $resultfunction = true;
                $returnconnection = $Connection;
            }
         } elseif ($action == 'Disconnect') {
            $Connection->close();
            $resultfunction = true;
            $returndebug = "The Database connection has been closed. <br>";
            $resultconnection = "closed";
        }
        return $Information = array("debug"=>"$returndebug", "result"=>$resultfunction, "connection"=>$returnconnection);
    }
?>