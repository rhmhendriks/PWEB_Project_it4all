<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eneo index</title>
    <link rel="stylesheet" href="_css/Stylesheet.css" type="text/css">
</head>

<body>
    <?php 
    session_start();
        require "../_init/initialize.php";    
    ?>
    <header>
        <h1><a href="index.php"></a></h1>
    </header>
    <?php
        require "_Scripting/menu/menu.php";
    ?>

    <div id="content">
        <?php
            if (isset($_GET['page'])){
                $page = CheckValue($_GET['page']);
                include "$page.php";
            } else {
                include "_contentpages/Home.php";
            }
                
        ?>
    </div>

    <footer>
        <h2><?php include "_Scripting/copyright_year.php"; ?></h2>
        <div>Icons made by <b>Freepik and SmashIcons</b> from <a href="https://www.flaticon.com/" title="Flaticon" target="_blank">www.flaticon.com</a></div>
    </footer>

<script src="_Scripting/menu/menu.js"></script>
<script src="_Scripting/Coockie-popup/Coockie.js"></script>

</body>

</html>