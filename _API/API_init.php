<?php 
    // Below we have the databse parameters
    define("ServerName", "localhost:3306");
    define("DBSigninName", "it4alldbuser");
    define("DBKey", "It4llit4all2019!");
    define("DBnameWeather", "unwdmi_ron");
    define("DBnameSite", "IT4all NEW");

    define("APITOKENtableName", "API_token");
    define("APIIPtableName", "API_IPwhitelist");

    function MySqlDo_Connector($action, $Connection = NULL, $DB = "unwdmi_ron"){
        $returnconnection = "";
        if ($action == 'Connect'){
            $Connection = @new mysqli(ServerName, DBSigninName, DBKey, $DB);
            if ($Connection->connect_error) { // Er wordt gecontroleerd op fouten bij de databaseverbinding
                $returndebug = die("Oops! The databse connection failed!, The infotmation below is generated for the site administrator. " . "<br />" . $Connection->connect_error) . "<br />";
                echo "Oops! The databse connection failed!, The infotmation below is generated for the site administrator. " . "<br />" . $Connection->connect_error . "<br />";
                $resultfunction = false;
            } else {
                $returndebug = "Yeah! The connection is active! Now we can do some SQL statement!" . "<br />"; // Nu wordt er weergegeven dat de database connectie geslaagd is
                echo "Yeah! The connection is active! Now we can do some SQL statement!" . "<br />";
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

    function checkIP($ip) {

        // create connection
        $ConnectionArray = MySqlDo_Connector('Connect');
        $conn = $ConnectionArray['connection'];
        $debug = $ConnectionArray['debug'];

        // Select the query
        $query = "SELECT" . "*" . "FROM" . APIIPtableName . "WHERE 'IP Address = " . $ip;
        $result = mysqli_query($conn, $sql); // Erase line after testing


        $statementrunned = $conn->query($statement); // statement uitvoeren

        if ($statementrunned->num_rows > 0) {
            while($row = $statementrunned->fetch_assoc()) {
                $dbdate = date('Y-m-d', strtotime($row['Valid']));
                if (date('Y-m-d') <= $dbdate){
                    $result = TRUE;
                } else {
                    $result = FALSE;
                }
            }
        } else {
            $result = FALSE;
        }

        return $Information = array("data"=>$statementrunned, "result"=>$result, "debug"=>$ConnectionArray['debug']);
    }

    function checkToken($token) {

        // create connection
        $ConnectionArray = MySqlDo_Connector('Connect');
        $conn = $ConnectionArray['connection'];
        $debug = $ConnectionArray['debug'];
       

        if ($ConnectionArray['result']){

            $debug .= "CHECKTOKEN: The connection with the database was sucesfull <br>";
            
            // Select the query
            $query = "SELECT" . "*" . "FROM" . APITOKENtableName . "WHERE Token = " . $token; //. ", Valid = " . $valid_til . ", Company = " . $company
            $result = mysqli_query($conn, $sql); // Erase line after testing


            $statementrunned = $conn->query($statement); // statement uitvoeren

            //print_r($statementrunned);

            if ($statementrunned->num_rows > 0) {
                while($row = $statementrunned->fetch_assoc()) {
                    $dbdate = date('Y-m-d', strtotime($row['Valid']));
                    if (date('Y-m-d') <= $dbdate){
                        $result = TRUE;
                    } else {
                        $result = FALSE;
                    }
                }
            } else {
                $result = FALSE;
            }
        } else {
            $result = FALSE;
            $statementrunned = 'None';
            $debug .= "CHECKTOKEN: The connection with the database failed! <br>";
            
        }

        

        return $Information = array("data"=>$statementrunned, "result"=>$result, "debug"=>$ConnectionArray['debug']);
    }

    ### Data Retriever ###
    function retrieveData($fromDate=null, $tilDate=null, $types){
        // create connection
        $ConnectionArray = MySqlDo_Connector('Connect');
        $conn = $ConnectionArray['connection'];
        $debug = $ConnectionArray['debug'];

        if ($ConnectionArray['result']){
            // write debug
            $debug .= "RETRIEVEDATA: The connection with the database was sucesfull <br>";

            // translate the types using wileConstruction
            $tempArray = strtoupper($types);
            $typesArrayChars = str_split($types);

            $columns = array();

            for ($i=0;$i<sizeof($typesArrayChars)-1;$i++){
                $ch=$typesArrayChars[$i];

                switch($ch){
                    case W:
                        array_push($columns, "Windsnelheid");
                        break;
                    case T:
                        array_push($columns, "Temperatuur");
                        break;
                    case N:
                        array_push($columns, "Temperatuur");
                        break;
                    case T:
                        array_push($columns, "Temperatuur");
                        break;
                    case T:
                        array_push($columns, "Temperatuur");
                        break;
                    case T:
                        array_push($columns, "Temperatuur");
                        break;

                }
            }

        
        }

    }

    ### AUTH Check ###
    function checkAuth(){
        if(isset($_GET['token'])){
            $token = $_GET['token'];
            $tokenarray = checkToken($token);
            $ip = $_SERVER['REMOTE_ADDR'];
            $iparray = checkIP($ip);
            if ($tokenarray['result'] != TRUE && $iparray['result'] != TRUE){
                header('HTTP/1.0 403 Forbidden');
                immediate_redirect_to('403.html');
            } 
        } else {
            header('HTTP/1.0 403 Forbidden');
            immediate_redirect_to('403.html');
        }
    }

    function createJSON($data){
        while($row = $data->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }
        $json = json_encode($myArray);

        $token = $_GET['token'];
        $filepath = __DIR__ . './data/' . "$token" . '/' . date('Y-m-d_hisu').'.json';
        file_put_contents($filepath, $json);
        immediate_redirect_to($filepath);
    }

    function createXML($data){
        $xml = new SimpleXMLElement('<WEATHERDATA/>'); 
            while($row = $data->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
            
            foreach($myArray as $mesrow){
                $measurement = $xml->addChild('MEASUREMENT');
                foreach($mesrow as $tag => $value) {
                    //echo "$tag ====> $value";
                    $measurement->addChild($tag, $value);
                }
            }

        $token = $_GET['token'];
        $filepath = __DIR__ . './data/' . "$token" . '/' . date('Y-m-d_hisu').'.xml';
        $xml->asXML($filepath);
        immediate_redirect_to($filepath);
    }

    ### Imidiate Redirect ###
    function immediate_redirect_to($redirectlocation){
        header("location: {$redirectlocation}");
        exit;	
    }


?>