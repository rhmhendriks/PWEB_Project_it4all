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
include $_SERVER['DOCUMENT_ROOT'] . "_init/functionlibary.php";

$jsonCameroon = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=649100');
$jsonChad = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=647000');
$jsonCAR = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=646500');
$jsonCongo = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=644000');
$jsonCongo2 = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=644500');
$jsonGabon = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=645000');
$jsonGabon2 = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=645010');
?>

<h2>Heat table</h2>
<table class="generaltable">
  <tr>
    <th>Weather station</th>
    <th>Highest temperature</th>
    <th>Lowest temperature</th> 
    <th>Average tamperature</th>
  </tr>
  <tr>
    <td>Cameroon</td>
    <td><?php echo calculator($jsonCameroon)[0]; ?></td>
    <td><?php echo calculator($jsonCameroon)[1]; ?></td>
    <td><?php echo calculator($jsonCameroon)[2]; ?></td>
  </tr>
  <tr>
    <td>Chad</td>
    <td><?php echo calculator($jsonChad)[0]; ?></td>
    <td><?php echo calculator($jsonChad)[1]; ?></td>
    <td><?php echo calculator($jsonChad)[2]; ?></td>
  </tr>
  <tr>
    <td>Central African Republic</td>
    <td><?php echo calculator($jsonCAR)[0]; ?></td>
    <td><?php echo calculator($jsonCAR)[1]; ?></td>
    <td><?php echo calculator($jsonCAR)[2]; ?></td>
  </tr>
  <tr>
    <td>Congo</td>
    <td><?php echo calculator($jsonCongo)[0]; ?></td>
    <td><?php echo calculator($jsonCongo)[1]; ?></td>
    <td><?php echo calculator($jsonCongo)[2]; ?></td>
  </tr>
  <tr>
    <td>Congo</td>
    <td><?php echo calculator($jsonCongo2)[0]; ?></td>
    <td><?php echo calculator($jsonCongo2)[1]; ?></td>
    <td><?php echo calculator($jsonCongo2)[2]; ?></td>
  </tr>
  <tr>
    <td>Gabon</td>
    <td><?php echo calculator($jsonGabon)[0]; ?></td>
    <td><?php echo calculator($jsonGabon)[1]; ?></td>
    <td><?php echo calculator($jsonGabon)[2]; ?></td>
  </tr>
  <tr>
    <td>Gabon</td>
    <td><?php echo calculator($jsonGabon2)[0]; ?></td>
    <td><?php echo calculator($jsonGabon2)[1]; ?></td>
    <td><?php echo calculator($jsonGabon2)[2]; ?></td>
  </tr>
</table>


</body>
</html>