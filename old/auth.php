<?php
session_start();
if (isset($_GET['auth'])){
    $auth = $_GET['auth'];
    include "_AuthSys/$auth.php";
}
?>