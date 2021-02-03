<html>
    <?php
    /**
     * The index file displays the graph.
     * 
     * @author Jurre de Vries and Ronald H.M. Hendriks
     * @version 2.0
     */
    ?>
    <head>
        <title>Learn Make Graphic with PHP</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
        <style type="text/css">
            .container {
                width: 60%;
                margin: 1px auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <canvas id="myChart" width="100" height="80"></canvas>
        </div>

        <div id="inputgeneral" >
            <form id="graphstationpicker">
            <label for="Cameroon (DOUALA OBS.) ">Verifieren via QR-code</label><input type="checkbox" id="CB_Cameroon" name="CB_Cameroon"  value="CB_Cameroon" checked>
            <label for="Central African Republic (BANGUI) ">Verifieren via QR-code</label><input type="checkbox" id="CB_car" name="CB_car"  value="CB_car" >
            <label for="Chad (NDJAMENA) ">Verifieren via QR-code</label><input type="checkbox" id="CB_Chad" name="CB_Chad"  value="CB_Chad" >
            <label for="Congo (DPOINTE-NOIRE.) ">Verifieren via QR-code</label><input type="checkbox" id="CB_congo" name="CB_congo"  value="CB_congo" >
            <label for="Congo (BRAZZAVILLE/MAYA-M) ">Verifieren via QR-code</label><input type="checkbox" id="CB_congo2" name="CB_congo2"  value="CB_congo2" >
            <label for="Gabon (LIBREVILLE) ">Verifieren via QR-code</label><input type="checkbox" id="CB_Gabon" name="CB_Gabon"  value="CB_Gabon" >
            <label for="Gabon (DOUALA OBS.) ">Verifieren via QR-code</label><input type="checkbox" id="CB_Gabon2" name="CB_Gabon2"  value="CB_Gabon2" >
            <input type="radio" id="mailVerification" name="VerificationMethod" value="mailVerification">
            <label for="temp">Temprature</label><br>
            <input type="radio" id="temp" name="datatype" value="temp">
            <label for="wind">WindSpeed</label><br>
            <input type="radio" id="wind" name="datatype" value="wind">
            <div id="submitgeneral">
                <input type="submit" class= "btn" value="Update" name="update" id="update">
            </div>
            </form>
        </div>



        <?php 
            $json = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=649100-647000-646500-644000-644500-645000-645010-870160');
            // 1=Cameroon - Chad - Central African Republic - Congo - Congo - Gabon - Gabon
            // gemaakt door Luc, zit een kleine kanttekening bij deze functie, maar die haal ik er morgen uit.
            // 1ste []= country code. 2de []= 0 = temp, 1 = wind, 2 = date. 3de []= particular value
            function calculator($json) {
                $array = json_decode($json, true);
                echo $array[1][1];
                $i = 0;
                $list = array();
                $countryCode = 0;
                $listTemp = array();
                $listDate = array();
                $listWind = array();
                foreach($array as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        if ($key2 == "stn") {
                            if ($value2 != $countryCode && $i != 0) {
                                $countryCode = $value2;
                                
                                array_push($list, array($listTemp, $listWind, $listDate));
                            } 
                        }
                        elseif ($key2 == "Temperatuur") {
                            $i += 1;
                            array_push($listTemp, $value2);
                        }
                        elseif ($key2 == "Datum") {
                            $i += 1;
                            array_push($listDate, $value2);
                        }
                        elseif ($key2 == "Windsnelheid") {
                            $i += 1;
                            array_push($listWind, $value2);
                        }
                    }
                }
                return $list;
}


        
            function getXandY($type){
                /**
                 * TODO: Last 2 weeks dates
                 */
                $data = file_get_contents("https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=$type&stations=649100-647000-646500-644000-644500-645000-645010");
                $arrayData = json_decode($data, true);
                $constructuredData = array();

                foreach($arrayData as $v ){
                    $datum = $v['Datum'];
                    $stn = $v['stn'];
                    $temp = $v['Temperatuur'];
                    

                    if (array_key_exists($datum, $constructuredData)){
                        if (array_key_exists($stn, $constructuredData[$datum])){
                            $constructuredData[$datum][$stn][sizeof($constructuredData[$datum][$stn])+1] = $temp;
                        } else {
                            $constructuredData[$datum][$stn][0] = $temp;
                        }
                    } else {
                        $constructuredData[$datum][$stn][0] = $temp;
                    }
                }

                $arraystnav = array();

                foreach($constructuredData as $k => $a ){
                    $arraystnav[$k];
                    foreach($a as $k2 => $b ){
                        $arraystnav[$k][$k2] = array_sum($b)/count($b);
                    }
                }
                $dates = "[";


                $stnArrays = array();

            }
             
        
        
        
        $labString = "[1,2,3,4,5,6,7,8,9,10]";
            $arrayValues = "";

            $labelsArray = calculator($json)[1][2];
            $valueSTNOneArray = calculator($json)[1][2];

            if (isset($_POST['update'])){
                $stationsToUse = '';
                if ($_POST['CB_Cameroon'] == 1){
                    $stationsToUse .= 1;
                } else if ($_POST['CB_car'] == 1){
                    $stationsToUse .= 3;
                } else if ($_POST['CB_Chad'] == 1){
                    $stationsToUse .= 2;
                } else if ($_POST['CB_congo'] == 1){
                    $stationsToUse .= 4;
                } else if ($_POST['CB_congo2'] == 1){
                    $stationsToUse .= 5;
                } else if ($_POST['CB_Gabon'] == 1){
                    $stationsToUse .= 6;
                } else if ($_POST['CB_Gabon2'] == 1){
                    $stationsToUse .= 7;
                }

                $datatype=0;
                if ($_POST['datatype'] == temp){
                    $datatype = 1;
                } else {
                    $datatype = 0;
                }

                if (strlen($stationsToUse) < 0 || strlen($stationsToUse) > 0 ){
                    $_SESSION['graphMessage'] = "Select at least one and max 3 stations to show!";
                } else {
                    // labels
                    $labelsArray = calculator($json)[1][2];

                    $labString = "[";
                    foreach($labelsArray as $lab){
                        $labString .= $lab . ", ";
                    }

                    $labString = trim($labString); // LABELS
                    $labString .= "]"; // LABELS
                    $arrayValues = array();

                    $arrayValues[0] = "nothing";

                    for ($i=1; $i<str.length()+1; $i++){
                        $arrayValues[$i] = calculator($json)[$i][$datatype];
                    }
                }
            }

                function arrayToString($array){
                    $str = "[";
                    foreach ($array as $a){
                        $str .= $a . ", ";
                    }

                    $str = trim($str);
                    $str .= "]";

                    return $str;
                }
            
        
            
        ?>






        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo $labString;?>, // X-As
                    datasets: [{
                            label: 'Station 1',
                            data: <?php if ($arrayValues != ""){ echo $arrayValues[0]; } else {echo "[1,2,3,4,5,6,8,9,10]";} ?>,  // Y-As
                            backgroundColor: [
                                'rgba(157, 219, 250, 0.4)',
                            ],
                            borderColor: [
                                'rgba(13, 105, 165, 10)',
                            ],
                            borderWidth: 1
                        },{
                            label: 'Station 2',
                            data: <?php if ($arrayValues != ""){ echo $arrayValues[0]; } else {echo "[1,2,3,4,5,6,8,9,10]";} ?>,  // Y-As
                            backgroundColor: [
                                'rgba(250, 172, 207, 0.4)',
                            ],
                            borderColor: [
                                'rgba(232, 0, 104, 10)',
                            ],
                            borderWidth: 1
                        },{
                            label: 'Station 3',
                            data: <?php if ($arrayValues != ""){ echo $arrayValues[0]; } else {echo "[1,2,3,4,5,6,8,9,10]";} ?>,  // Y-As
                            backgroundColor: [
                                'rgba(57, 92, 50, 0.2)',
                            ],
                            borderColor: [
                                'rgba(13, 69, 1, 10)',
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
    </body>
</html>