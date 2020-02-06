<?php
if (isset($_GET['form'])){
    $form = $_GET['form'];
    include "_forms/$form.php";
}
?>