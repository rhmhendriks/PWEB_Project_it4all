<!DOCTYPE html>
<html>
<?php
/**
 * The table file displays the table.
 * 
 * @author Luc Willemse
 * @version 2.0
 */
?>

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
$json = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=649100-647000-646500-644000-644500-645000-645010-870160');
$json = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=649100-647000-646500-644000-644500-645000-645010-10010');


function calculator($json) {
    $array = json_decode($json, true);
    $highest = -100;
    $lowest = 100;
    $total = 0;
    $i = 0;
    $list = array();
    $countryCode = 0;
    foreach($array as $key => $value) {
        foreach($value as $key2 => $value2) {
            if ($key2 == "stn") {
                if ($value2 != $countryCode && $i != 0) {
                    $countryCode = $value2;
                    $average = $total / $i;
                    array_push($list, array(round($highest, 1), round($lowest, 1), round($average, 1), $countryCode));
                    $highest = -100;
                    $lowest = 100;
                    $average = 0;
                    $total = 0;
                    $i = 0;
                } 
            }
            elseif ($key2 == "Temperatuur") {
                $i += 1;
                $total += $value2;
                if ($value2 < $lowest) {
                    $lowest = $value2;
                }
                elseif ($value2 > $highest) {
                    $highest = $value2;
                }
            }
        }
    }
    return $list;
} 
?>

<h2>Heat table</h2>

<table style="width:100%">
  <tr>
    <th>Weather station</th>
    <th>Highest temperature</th>
    <th>Lowest temperature</th> 
    <th>Average tamperature</th>
  </tr>
  <tr>
    <td>Cameroon</td>
    <td><?php echo calculator($json)[1][0]; ?></td>
    <td><?php echo calculator($json)[1][1]; ?></td>
    <td><?php echo calculator($json)[1][2]; ?></td>
  </tr>
  <tr>
    <td>Chad</td>
    <td><?php echo calculator($json)[2][0]; ?></td>
    <td><?php echo calculator($json)[2][1]; ?></td>
    <td><?php echo calculator($json)[2][2]; ?></td>
  </tr>
  <tr>
    <td>Central African Republic</td>
    <td><?php echo calculator($json)[3][0]; ?></td>
    <td><?php echo calculator($json)[3][1]; ?></td>
    <td><?php echo calculator($json)[3][2]; ?></td>
  </tr>
  <tr>
    <td>Congo</td>
    <td><?php echo calculator($json)[4][0]; ?></td>
    <td><?php echo calculator($json)[4][1]; ?></td>
    <td><?php echo calculator($json)[4][2]; ?></td>
  </tr>
  <tr>
    <td>Congo</td>
    <td><?php echo calculator($json)[5][0]; ?></td>
    <td><?php echo calculator($json)[5][1]; ?></td>
    <td><?php echo calculator($json)[5][2]; ?></td>
  </tr>
  <tr>
    <td>Gabon</td>
    <td><?php echo calculator($json)[6][0]; ?></td>
    <td><?php echo calculator($json)[6][1]; ?></td>
    <td><?php echo calculator($json)[6][2]; ?></td>
  </tr>
  <tr>
    <td>Gabon</td>
    <td><?php echo calculator($json)[7][0]; ?></td>
    <td><?php echo calculator($json)[7][1]; ?></td>
    <td><?php echo calculator($json)[7][2]; ?></td>
  </tr>
</table>


</body>
</html>