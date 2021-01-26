<?php
if (isset($_GET['form'])){
    $type = $_GET['formtype'];
    $dir = NULL;
    $form = $_GET['form'];

<<<<<<< HEAD
    switch ($type) {
=======
    switch ($type){
>>>>>>> 344f894ed13934159b0de69f84a28fcba7904f1d
        case "content" :
            $dir = "_contentpages/forms/forms/";
            break;
        case "admin" :
            $dir = "_adminpages/Forms/forms/";
            break;
        case "ordering" :
            $dir = "_Ordering/Forms/";
            break;
<<<<<<< HEAD
        } 
=======
        default:
            $dir = "_forms";
            break;
        }
        
>>>>>>> 344f894ed13934159b0de69f84a28fcba7904f1d

    include "$dir/$form.php";
    }
?>