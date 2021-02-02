<html>
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
            <label for="Cameroon (DOUALA OBS.) ">Verifieren via QR-code</label><input type="checkbox" id="CB_Cameroon" name="CB_Cameroon"  value="CB_Cameroon" >
            <label for="Central African Republic (BANGUI) ">Verifieren via QR-code</label><input type="checkbox" id="CB_car" name="CB_car"  value="CB_car" >
            <label for="Chad (NDJAMENA) ">Verifieren via QR-code</label><input type="checkbox" id="CB_Chad" name="CB_Chad"  value="CB_Chad" >
            <label for="Congo (DPOINTE-NOIRE.) ">Verifieren via QR-code</label><input type="checkbox" id="CB_congo" name="CB_congo"  value="CB_congo" >
            <label for="Congo (BRAZZAVILLE/MAYA-M) ">Verifieren via QR-code</label><input type="checkbox" id="CB_congo2" name="CB_congo2"  value="CB_congo2" >
            <label for="Gabon (LIBREVILLE) ">Verifieren via QR-code</label><input type="checkbox" id="CB_Gabon" name="CB_Gabon"  value="CB_Gabon" >
            <label for="Gabon (DOUALA OBS.) ">Verifieren via QR-code</label><input type="checkbox" id="CB_Gabon2" name="CB_Gabon2"  value="CB_Gabon2" >
                
            <div id="submitgeneral">
                <input type="submit" class= "btn" value="Pincode Opslaan" name="savePin" id="savePin">
            </div>
            </form>
        </div>



        <?php 
        
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



                
                // lijstje met datums
                // lijstje met stationnummetd
                // lijstje waarden per station



                array_sum($a)/count($a)

                array[stn] = [temp > values, wind > values, etc. ]



                array[datum][station][temp]
                $constructuredData['10010']['temp'] = Array met values

                foreach($arrayData as $v {
                    $constructuredData.push($k)
                }
            }
             
        
        
        
        
        
        ?>






        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["1", "2", "3", "4", "5", "6"], // X-As
                    datasets: [{
                            label: 'Weather Data',
                            data: <?php echo $data1; ?>[5, 10, 13, 12, 8, 2],  // Y-As
                            backgroundColor: [
                                'rgba(157, 219, 250, 0.4)',
                            ],
                            borderColor: [
                                'rgba(13, 105, 165, 10)',
                            ],
                            borderWidth: 1
                        },{
                            label: 'None',
                            data: [],  // Y-As
                            backgroundColor: [
                                'rgba(250, 172, 207, 0.4)',
                            ],
                            borderColor: [
                                'rgba(232, 0, 104, 10)',
                            ],
                            borderWidth: 1
                        },{
                            label: 'None',
                            data: [],  // Y-As
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