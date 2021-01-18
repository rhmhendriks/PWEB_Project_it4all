<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT4ALL Index</title>
    <link href="../_css/Newstylesheet.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php 
    session_start();
        require "_init/initialize.php";    
    ?>
    <header>
        <h1><a href="index.php">IT4ALL</a></h1>
        <p><?php echo WelcomeUser(); ?></p>
        <a href="index.php?page=Order&Order=winkelwagen"><img src="_images/shopping_cart.png"></a>
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
        <br>
        <div> <a href="index.php?page=statements&statement=cookie">Cookie's</a> &nbsp;&nbsp;&nbsp; <a href="index.php?page=statements&statement=privacy">Privacy</a> &nbsp;&nbsp;&nbsp; <a href="index.php?page=statements&statement=disclaimer">Disclaimer</a> &nbsp;&nbsp;&nbsp; <a href="index.php?page=statements&statement=voorwaarden">Algemene Voorwaarden</a> </div>

    </footer>

<script src="_Scripting/menu/menu.js"></script>
<script src="_Scripting/Coockie-popup/Coockie.js"></script>
</body>

</html>