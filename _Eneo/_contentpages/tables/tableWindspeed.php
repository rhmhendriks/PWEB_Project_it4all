<<<<<<< HEAD
<!DOCTYPE html>
<html>
<!-- 
    Author: Luc Willemse
-->
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>

<?php 
$today = date('Y-m-d');
$onemonthago = date('Y-m-d', strtotime("-1 months", strtotime($today)));
$json = file_get_contents("https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=$onemonthago&til=$today&filetype=JSON&type=W&stations=644000");

function calculator($json) {
	$array = json_decode($json, true);
    $list = array();
    $date = $array[0]['Datum'];
    $totalOfDay = 0;
    $i = 0;
    $k = 0;
    $last = count($array);
    foreach($array as $key => $value) {
        $k += 1;
        foreach($value as $key2 => $value2) {
            if ($key2 == "Datum") {
                if ($value2 == $date) {
                    $totalOfDay = $totalOfDay + ($value['Windsnelheid'] / 3.6);
                    $i += 1;
                }
                else {
                    $dayAverage = $totalOfDay / $i;
                    if($dayAverage > 0) {
                        array_push($list, array(round($dayAverage, 1), $date));
                    }
                    if ($k == $last) {
                        $dayAverage = $value['Windsnelheid'] / 3.6;
                        $date = $value2;
                        if($dayAverage > 0) {
                            array_push($list, array(round($dayAverage, 1), $date));
                        }
                        
                    }
                    $date = $value2;
                    $totalOfDay = $value['Windsnelheid'] / 3.6;
                    $i = 1;
                }
            }
        }
    }
    sort($list);
    return $list;
} 
?>

<h2>Windspeed Table</h2>

<table style="width:100%">
  <tr>
    <th>Weather station</th>
    <th>Windspeed day average > 4 m/s</th>
  </tr>
  <tr>
    <td>Cameroon</td>
    <td><?php foreach (calculator($json) as $av) {echo $av[0] . ' m/s average on day ' . $av[1]; echo '<br>';}?></td>
  </tr>
</table>


</body>
=======
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>

<?php 
/**
 * The map file creates the windspeed tables
 * source: mapbox.com
 * 
 * @author Luc Willemse
 * @version 2.0
 */
$today = date('Y-m-d');
$onemonthago = date('Y-m-d', strtotime("-1 months", strtotime($today)));
$json = file_get_contents("https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=$onemonthago&til=$today&filetype=JSON&type=W&stations=644000");

function calculator($json) {
	$array = json_decode($json, true);
    $list = array();
    $date = $array[0]['Datum'];
    $totalOfDay = 0;
    $i = 0;
    $k = 0;
    $last = count($array);
    foreach($array as $key => $value) {
        $k += 1;
        foreach($value as $key2 => $value2) {
            if ($key2 == "Datum") {
                if ($value2 == $date) {
                    $totalOfDay = $totalOfDay + ($value['Windsnelheid'] / 3.6);
                    $i += 1;
                }
                else {
                    $dayAverage = $totalOfDay / $i;
                    if($dayAverage > 0) {
                        array_push($list, array(round($dayAverage, 1), $date));
                    }
                    if ($k == $last) {
                        $dayAverage = $value['Windsnelheid'] / 3.6;
                        $date = $value2;
                        if($dayAverage > 0) {
                            array_push($list, array(round($dayAverage, 1), $date));
                        }
                        
                    }
                    $date = $value2;
                    $totalOfDay = $value['Windsnelheid'] / 3.6;
                    $i = 1;
                }
            }
        }
    }
    sort($list);
    return $list;
} 
?>

<h2>Windspeed Table</h2>

<table style="width:100%">
  <tr>
    <th>Weather station</th>
    <th>Windspeed day average > 4 m/s</th>
  </tr>
  <tr>
    <td>Cameroon</td>
    <td><?php foreach (calculator($json) as $av) {echo $av[0] . ' m/s average on day ' . $av[1]; echo '<br>';}?></td>
  </tr>
</table>


</body>
>>>>>>> dd53fcdd38c816e85c81a2ea42fbdbe3f61be888
</html>