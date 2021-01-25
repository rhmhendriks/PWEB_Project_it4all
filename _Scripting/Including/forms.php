<?php
if (isset($_GET['form'])){
    $type = $_GET['formtype'];
    $dir = NULL;
    $form = $_GET['form'];

    switch ($type):
        case "content":
            $dir = _"contentpages/forms/";







    include "$dir/$form.php";
}
?>