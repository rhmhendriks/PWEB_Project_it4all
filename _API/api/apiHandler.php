<?php
include("api.php");

$apiObject = new API();

if($_GET["action" == 'outputData']) {
    $data = $apiObject->outputData();
}
?>