<!--
    autheur: Luc Willemse
    source: mapbox.com
 -->
 <script src="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.css" rel="stylesheet" />
<style>
    body {
        margin: 0;
        padding: 0;
    }

    #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    }
</style>

<?php
echo 'HOIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII';

$json = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=WT&stations=649100-647000-646500-644000-644500-645000-645010-870160');

function calculator($json)
{
    $array = json_decode($json, true);
    $i = 0;
    $latestTemp = 0;
    $latestWind = 0;
    $list = array();
    $countryCode = 0;
    foreach ($array as $key => $value) {
        foreach ($value as $key2 => $value2) {
            if ($key2 == "stn") {
                if ($value2 != $countryCode && $i != 0) {
                    $countryCode = $value2;
                    $latestWind = $latestWind / 3.6;
                    array_push($list, array($latestTemp, round($latestWind, 1)));
                    $i = 0;
                }
            } elseif ($key2 == "Temperatuur") {
                $i += 1;
                $latestTemp = $value2;
            } elseif ($key2 == "Windsnelheid") {
                $i += 1;
                $latestWind = $value2;
            }
        }
    }
    return $list;
}
echo calculator($json)[1][1];
?>
<style>
    .mapboxgl-popup {
        max-width: 400px;
        font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
    }
</style>