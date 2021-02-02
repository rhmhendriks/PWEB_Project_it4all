<!DOCTYPE html>
<html lang="en">
<head> 
        <meta charset="UTF-8">
        <title>API</title>
    </head>
<html>
    <!--<html lang="en">-->
    <body>
        <!--?token=rhgy8gfyeaihgfiuyeragyuiherauyigfhuh&from=23022021&til=25022021-->
        <?php
            /**
             * The index file shows the requested data.
             * 
             * @author Jurre de Vries and Ronald H.M. Hendriks
             * @version 3.0
             */
            //require "SQLsystem.php";
            require "API_init.php";

            // retrieve GET parameters
            if (isset($_GET['token'])){$token = $_GET['token'];}
            if (isset($_GET['from'])){$from = $_GET['from'];}
            if (isset($_GET['til'])){$til = $_GET['til'];}
            if (isset($_GET['stations'])){$stations = $_GET['stations'];} else {$stations = null;}
            if (isset($_GET['filetype'])){$ft = $_GET['filetype'];}
            //if (isset($_GET['where'])){$where = $_GET['where'];}
            //if (isset($_GET['between'])){$where = $_GET['where'];}
            //if (isset($_GET['equalto'])){$equalto = $_GET['equalto'];}
            //if (isset($_GET['secondwhere'])){$secondwhere = $_GET['secondwhere'];}
            //if (isset($_GET['secondequalto'])){$secondequalto = $_GET['secondequalto'];}
            //if (isset($_GET['secondbetween'])){$secondbetween = $_GET['secondbetween'];}
            //if (isset($_GET['orderby'])){$secondbetween = $_GET['orderby'];}           

            // Check the weather type
            if (isset($_GET['type'])){$type = $_GET['type'];} 

            // get date as they are in SQL
            $from = date('Y-m-d', strtotime($from));
            $til = date('Y-m-d', strtotime($til));
            echo "from date $from <br> til date $til <br>";

            //https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=01022020&til=02022020&filetype=JSON&type=WT

            /*
                -------------------------------
                Type Explanations (EG. WVXEZ)
                   -no type is display all -
                -------------------------------
                W = windspeed
                T = temprature
                N = rainfall
                S = snowfall
                D = winddirection
                P = airpressure Station
                O = airpressure Sea
                X = station
                V = visability
                C = clouds
                E = Events
                Z = Dewpoint
            */

            // check auth
            checkAuth();
        
            // create statement
            $resultarray = retrieveData($from, $til, $type, $stations);

            echo $resultarray["debug"] . "<br>";
            echo $ft;
            if ($resultarray['result']){
                $data = $resultarray["data"];
                $ft = strtoupper($ft);
                if ($ft == "XML"){
                    createXML($data);
                } elseif ($ft=="JSON"){
                    createJSON($data);
                }
            }

            //echo $resultarray["debug"] . "<br>";

            /*
            //if ($resultarray['result']){
                // we will parse
                // parsing to .json
                print_r($resultarray['data']);
                $count = 0;
                while($row = $resultarray['data']->fetch_assoc()) {
                    var_dump($row);
                    $count++;
                    if ($count >= 1){
                        break;
                    }

                }
                */
        ?>
    </body>
</html>