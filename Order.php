<?php
if (isset($_GET['Order'])){
    $order = $_GET['Order'];
    include "_Ordering/$order.php";
}
?>