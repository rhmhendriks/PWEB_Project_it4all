<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT4ALL Index</title>
    <link href="../_css/Newstylesheet.css?rnd=@Function.GUID~" rel="stylesheet" type="text/css">
    <!--<script type="text/javascript">
        function googleTranslateElementInit() {​​​​
            new google.translate.TranslateElement({​​​​pageLanguage: 'nl'}​​​​, 'google_translate_element');
        }​​​​
    </script>-->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                },
                'google_translate_element');
                }
    </script>
</head>

<body>
    <?php 
    session_start();
        require "_init/initialize.php";    
    ?>
    <header>
        <h1><a href="index.php">IT4ALL</a></h1>
        <p><?php echo WelcomeUser(); ?></p>
        <a href="index.php?inc=y&page=Order&Order=winkelwagen"><img src="_images/shopping_cart.png"></a>
    </header>

    <?php
        require "_Scripting/menu/menu.php";
    ?>

    <div id="content">
        <?php
            if (isset($_GET['page'])){
                $page = CheckValue($_GET['page']);
                if (isset($_GET['inc'])){
                    include $_SERVER['DOCUMENT_ROOT'] ."/_Scripting/Including/$page.php";
                } else {
                    include $_SERVER['DOCUMENT_ROOT'] ."/_contentpages/$page.php";
                }
            } else {
                include "_contentpages/Home.php";
            }

            include "_Scripting/translatepopup.php";
        ?>
    </div>

    <footer>
        <h2><?php include "_Scripting/copyright_year.php"; ?></h2>
        <div>Icons made by <b>Freepik and SmashIcons</b> from <a href="https://www.flaticon.com/" title="Flaticon"
                target="_blank">www.flaticon.com</a></div>
        <br>
        <div> <a href="index.php?inc=y&page=statements&statement=cookie">Cookie's</a> &nbsp;&nbsp;&nbsp; <a
                href="index.php?inc=y&page=statements&statement=privacy_statement">Privacy</a> &nbsp;&nbsp;&nbsp; <a
                href="index.php?inc=y&page=statements&statement=disclaimer">Disclaimer</a> &nbsp;&nbsp;&nbsp; <a
                href="index.php?inc=y&page=statements&statement=algemene_voorwaarden">Algemene Voorwaarden</a> </div>

    </footer>
    
    <script src="_Scripting/menu/menu.js"></script>
    <script src="_Scripting/Coockie-popup/Coockie.js"></script>

</body>

</html>