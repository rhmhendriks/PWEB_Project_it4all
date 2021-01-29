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
            require "SQLsystem.php";
            require "API_init.php";

            // retrieve GET parameters
            if (isset($_GET['token'])){$token = $_GET['token'];}
            if (isset($_GET['from'])){$from = $_GET['from'];}
            if (isset($_GET['til'])){$til = $_GET['til'];}
            if (isset($_GET['where'])){$where = $_GET['where'];}
            if (isset($_GET['between'])){$where = $_GET['where'];}
            if (isset($_GET['equalto'])){$equalto = $_GET['equalto'];}
            if (isset($_GET['secondwhere'])){$secondwhere = $_GET['secondwhere'];}
            if (isset($_GET['secondequalto'])){$secondequalto = $_GET['secondequalto'];}
            if (isset($_GET['secondbetween'])){$secondbetween = $_GET['secondbetween'];}
            if (isset($_GET['orderby'])){$secondbetween = $_GET['orderby'];}
        
            

            if (isset($_GET['type'])){$type = $_GET['type'];}

            // get date as they are in SQL
            $from = date('Y-m-d', strtotime($from));
            $til = date('Y-m-d', strtotime($til));

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
            $stat = createSelectStatementData($from, $til); 
            echo $from . "<br>";
            echo $til . "<br>";
            echo $stat . "<br>";

            $resultarray = runSelectStatement($stat); // <<<<<

            echo $resultarray["debug"] . "<br>";

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