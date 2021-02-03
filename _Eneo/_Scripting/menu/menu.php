<?php
    /**
     * The index file displays the graph.
     * 
     * @author Jurre de Vries and Ronald H.M. Hendriks
     * @version 2.0
     */
            
    // We create the connection for the whole menu with the database
        $ConnectionArray = MySqlDo_Connector('Connect');
        if (!$ConnectionArray['result']){
            echo '<h1> Geen Database Connectie </h1><br><br>';
                if (DebugisOn){
                    echo '<p><b>' . $ConnectionArray['debug'] . '</b></p>';
                }
        }
        
        $DBconnect = $ConnectionArray['connection'];

?>

<?php
    $today = date('Y-m-d'); 
    $onemonthago = date('Y-m-d', strtotime("-1 months", strtotime($today)));
?>
        
        
        <nav>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
                <ul class="links">
                    <li class="liFade"><a href="index.php">Home</a></li>
                    <li class="liFade"><a href="#">Temperature</a>
                        <ul>
                            <li><a href="index.php?heatmap=y">Heatmap</a></li>
                            <li><a href="index.php?">Table</a></li>
                        </ul> 
                    </li>
                    <li class="liFade"><a href="#">Wind speed</a>
                        <ul>
                            <li><a href="index.php?">Graph</a></li>
                            <li><a href="index.php?">Table</a></li>
                        </ul> 
                    </li>
                    <li class="liFade"><a href="">Download data</a>
                        <ul>
                            <li><a href="https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=<?php echo $onemonthago; ?>&til=<?php echo $today; ?>&filetype=JSON&type=W&stations=649100-647000-646500-644000-644500-645000-645010" target="_blank">Wind speed .json</a></li>
                            <li><a href="https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=<?php echo $onemonthago; ?>&til=<?php echo $today; ?>&filetype=XML&type=W&stations=649100-647000-646500-644000-644500-645000-645010" target="_blank">Wind speed .xml</a></li>
                            <li><a href="https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=<?php echo $onemonthago; ?>&til=<?php echo $today; ?>&filetype=JSON&type=D&stations=649100-647000-646500-644000-644500-645000-645010" target="_blank">Wind direction .json</a></li>
                            <li><a href="https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=<?php echo $onemonthago; ?>&til=<?php echo $today; ?>&filetype=XML&type=D&stations=649100-647000-646500-644000-644500-645000-645010" target="_blank">Wind direction .xml</a></li>
                            <li><a href="https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=<?php echo $onemonthago; ?>&til=<?php echo $today; ?>&filetype=JSON&type=T&stations=649100-647000-646500-644000-644500-645000-645010" target="_blank">Temperature .json</a></li>
                            <li><a href="https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=<?php echo $onemonthago; ?>&til=<?php echo $today; ?>&filetype=XML&type=T&stations=649100-647000-646500-644000-644500-645000-645010" target="_blank">Temperature .xml</a></li>
                            <li><a href="https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=<?php echo $onemonthago; ?>&til=<?php echo $today; ?>&filetype=JSON&type=N&stations=649100-647000-646500-644000-644500-645000-645010" target="_blank">Rainfall .json</a></li>
                            <li><a href="https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=<?php echo $onemonthago; ?>&til=<?php echo $today; ?>&filetype=XML&type=N&stations=649100-647000-646500-644000-644500-645000-645010" target="_blank">Rainfall .xml</a></li>
                            <li><a href="https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=<?php echo $onemonthago; ?>&til=<?php echo $today; ?>&filetype=JSON&type=S&stations=649100-647000-646500-644000-644500-645000-645010" target="_blank">Snowfall .json</a></li>
                            <li><a href="https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=<?php echo $onemonthago; ?>&til=<?php echo $today; ?>&filetype=XML&type=S&stations=649100-647000-646500-644000-644500-645000-645010" target="_blank">Snowfall .xml</a></li>
                        </ul>
                    </li>
                    <li class="liFade"><a href="https://it4all.rhmhendriks.nl/index.php">IT4ALL</a></li>
                </ul>

                <ul class="login">
                    <?php
                    if (!$_SESSION['loggedin'] == 1){
                        echo'   
                        <li><a href="#">Users</a>
                            <ul>
                                <li><a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=auth&auth=login">Log in</a></li>
                            </ul>
                        </li>
                        ';} else { echo '
                            <li><a href="#">Users</a>
                                <ul>
                                    <li><a href="https://it4all.rhmhendriks.nl/index.php?inc=y&page=auth&auth=LogOut">Log out</a></li>
                                </ul>
                            </li>
                        ';}?>
                    <?php
                    if ($_SESSION['loggedin'] == 1 && $_SESSION['IsAdmin'] == 1){
                        //echo '   
                        //<li><a href="#">Admin Pages</a>
                         //   <ul>
                        //        <li><a href="index.php?page=admin&admin=FormOverview">Forms & Views</a></li>
                        //    </ul>
                     //   </li>
                    //    ';
                    } 
                        ?>
                </ul>
            </nav>