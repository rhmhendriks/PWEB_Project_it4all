<?php
$data = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=649100-647000-646500-644000-644500-645000-645010');

$array = json_decode($data, true);
print_r($array);
?>