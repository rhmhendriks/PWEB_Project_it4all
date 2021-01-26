<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Document</title>
    </head>
<html>
    <!--<html lang="en">-->
    <body>
        <!--?token=rhgy8gfyeaihgfiuyeragyuiherauyigfhuh&from=23022021&til=25022021-->
        <?php
        

            require "../api/SQLsystem.php";
            if (isset($_GET['token'])){$token = $_GET['token'];}
            if (isset($_GET['from'])){$from = $_GET['from'];}
            if (isset($_GET['til'])){$til = $_GET['til'];}

            $from = date('Y-m-d', strtotime($from));
            $til = date('Y-m-d', strtotime($til));

            
            // check auth
        
            // create statement
            $stat = createSelectStatementData($from, $til); 
            echo $from . "<br>";
            echo $til . "<br>";
            echo $stat . "<br>";

            $resultarray = runSelectStatement($stat); // <<<<<

            echo $resultarray["debug"] . "<br>";

            //if ($resultarray['result']){
                // we will parse
                // parsing to .json
                print_r($resultarray['data']);
                $count = 0;
                while($row = $resultarray['data']->fetch_assoc()) {
                    var_dump($row);
                    $count++;
                    if ($count >= 1){
                        break;
                    }

                }

                while($row = $resultarray['data']->fetch_array(MYSQLI_ASSOC)) {
                    $myArray[] = $row;
                }
                $json = json_encode($myArray);

                file_put_contents('test.json', $json);
                //immediate_redirect_to('test.json');

                $xml = new SimpleXMLElement('<xml>');

                for ($i = 1; $i <= 8; ++$i) {
                    $track = $xml->addChild('track');
                    $track->addChild('path', "song$i.mp3");
                    $track->addChild('title', "Track $i - Track Title");
                }

                Header('Content-type: text/xml');
                print($xml);
                //print($xml->asXML());

                //json_encode($resultarray);
                // parsing to .xml
                /*
                $xml = new XMLWriter();
                $xml->openUri("php://output");
                $xml->setIndent(true);

                $xml->startElement('token'); // Creating the start element tag

                $xml->endElement(); // End the current element

                while ($row = mysql_fetch_assoc($resultaat)) {
                    // Write to XML
                }
            } else { 
                // we do nothing
            }*/
        //}



            /*$resultaat = $resultarray['data']->fetch_all();
            foreach ($resultaat as $rij){ }*/
        ?>
    </body>
</html>