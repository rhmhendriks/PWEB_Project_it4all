<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Document</title>
    </head>

    <body>
        ?token=rhgy8gfyeaihgfiuyeragyuiherauyigfhuh&from=23022021&til=25022021
        <?php

            require "../api/SQLsystem.php"
            if (isset($_GET['token'])){$token = $_GET['token']};
            if (isset($_GET['from'])){$from = $_GET['from']};
            if (isset($_GET['til'])){$til = $_GET['til']};

            // check auth
        
            // create statement
            $stat = createSelectStatementData($fromdate, $tildate);
            $resultarray = runSelectStatement($stat);

            if ($resultarray['result']){
                // we gaan parsen
            } else { 
                // we doen niets. 
            }




            $resultaat = $resultarray['data']->fetch_all();
            foreach ($resultaat as $rij){ }




        ?>

    </body>

</html>