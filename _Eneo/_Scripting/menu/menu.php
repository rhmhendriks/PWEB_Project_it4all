<?php
    // we maken de connectie voor het hele menu met de database
        $ConnectionArray = MySqlDo_Connector('Connect');
        if (!$ConnectionArray['result']){
            echo '<h1> Geen Database Connectie </h1><br><br>';
                if (DebugisOn){
                    echo '<p><b>' . $ConnectionArray['debug'] . '</b></p>';
                }
        }
        
        $DBconnect = $ConnectionArray['connection'];

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
                            <li><a href="#Graph">Graph/map</a></li>
                            <li><a href="#Table">Table</a></li>
                            <li><a href="#Export">Export</a></li>
                        </ul> 
                    </li>
                    <li class="liFade"><a href="#">Wind speed</a>
                        <ul>
                            <li><a href="#Graph">Graph</a></li>
                            <li><a href="#Table">Table</a></li>
                            <li><a href="#Export">Export</a></li>
                        </ul> 
                    </li>
                        <li class="liFade"><a href="https://it4all.rhmhendriks.nl/index.php">IT4ALL</a></li>
                    </ul>
                    <ul class="login">
                    <?php
                    if (!$_SESSION['loggedin'] == 1){
                        echo'   
                        <li><a href="#">Gebruikers</a>
                            <ul>
                                <li><a href="index.php?page=auth&auth=login">Inloggen</a></li>
                                <li><a href="index.php?page=auth&auth=SignUp">Registreren</a></li>
                            </ul>
                        </li>
                        ';} else { echo '
                            <li><a href="#">Gebruikers</a>
                                <ul>
                                    <li><a href="index.php?page=auth&auth=LogOut">Uitloggen</a></li>
                                </ul>
                            </li>
                        ';}?>
                    <?php
                    if ($_SESSION['loggedin'] == 1 && $_SESSION['IsAdmin'] == 1){
                        echo '   
                        <li><a href="#">Admin Pages</a>
                            <ul>
                                <li><a href="index.php?page=admin&admin=FormOverview">Forms & Views</a></li>
                            </ul>
                        </li>
                        ';} 
                        ?>
                </ul>
            </nav>