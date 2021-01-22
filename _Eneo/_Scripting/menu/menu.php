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
                    <li class="liFade"><a href="#">Don't know</a>
                        <ul>
                            <li><a href="#1">1</a></li>
                            <li><a href="#2">2</a></li>
                            <li><a href="#3">3</a></li>
                        </ul> 
                    </li>
                    <li class="liFade"><a href="#">No idea</a>
                        <ul>
                        <li><a href="#1">1</a></li>
                        <li><a href="#2">2</a></li>
                        <li><a href="#3">3</a></li>
                        </ul> 
                    </li>
                    <li class="liFade"><a href="#">No clue</a>
                        <ul>
                        <li><a href="#1">1</a></li>
                        <li><a href="#2">2</a></li>
                        <li><a href="#3">3</a></li>
                        </ul>
                    </li>
                    <li class="liFade"><a href="#Oh no">Contact</a></li>
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
                            <li><a href="phpmyadmin">DB Beheer</a></li>
                        </ul>
                        </li>
                        ';} 
                        ?>
                </ul>
            </nav>