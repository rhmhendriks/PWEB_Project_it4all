<?php
if (isset($_GET['form'])){
    $type = $_GET['formtype'];
    $dir = NULL;
    $form = $_GET['form'];

    switch ($type) {
        case "content" :
            $dir = "_contentpages/forms/forms/";
            break;
        case "admin" :
            $dir = "_adminpages/Forms/forms/";
            break;
        case "ordering" :
            $dir = "_Ordering/Forms/";
            break;
        } 

    include "$dir/$form.php";
}
?>