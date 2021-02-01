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
                    <li class="liFade"><a href="#">Webshop</a>
                        <ul>
                            <?php
                                // statement opmaken en uitvoeren
                                    $StatementGetArticleLists = "SELECT * FROM ArticleGroups";
                                    $StatementRunnedGetArticleLists = $DBconnect->query($StatementGetArticleLists);

                                // Nu gaan we de link vaststellen 
                                    $targetarticlelists = 'index.php?age=articlelist&ID=';
                                    if($StatementRunnedGetArticleLists->num_rows > 0) {  // Als er rijen zijn gevonden
                                        // gegevens gebruiken
                                        echo '<li><a href="index.php?page=articlelist">Alle Artikelen</a></li>';
                                        while ($row = $StatementRunnedGetArticleLists->fetch_assoc()){
                                            echo '<li><a href="' . $targetarticlelists . $row['ArticleGroupID'] . '">' . $row['GroupTitle'] . '</a></li>';
                                        }
                                    }
                            ?>
                        </ul> 
                    </li>
                    <li class="liFade"><a href="#">Tips en Tricks</a>
                        <ul>
                            <?php
                                // statement opmaken en uitvoeren
                                    $StatementGetTipTrickLists = "SELECT * FROM TipsTricksCategory";
                                    $StatementRunnedGetTipTrickLists = $DBconnect->query($StatementGetTipTrickLists);

                                // Nu gaan we de link vaststellen 
                                    $targetTipTrickLists = 'index.php?page=tipstrickslist&ID=';
                                    if($StatementRunnedGetTipTrickLists->num_rows > 0) {  // Als er rijen zijn gevonden
                                        // gegevens gebruiken
                                        echo '<li><a href="index.php?page=tipstrickslist">Alle tips en tricks</a></li>';
                                        while ($row = $StatementRunnedGetTipTrickLists->fetch_assoc()){
                                            echo '<li><a href="' . $targetTipTrickLists . $row['CategoryID'] . '">' . $row['CategoryTitle'] . '</a></li>';
                                        }
                                    }
                            ?>
                        </ul> 
                    </li>
                    <li class="liFade"><a href="#">Algemene Informatie</a>
                        <ul>
                            <li><a href="index.php?inc=y&page=statements&statement=cookie">Cookies</a></li>
                            <li><a href="index.php?inc=y&page=statements&statement=privacy_statement">Privacy</a></li>
                            <li><a href="index.php?inc=y&page=statements&statement=disclaimer">Disclaimer</a></li>
                            <li><a href="index.php?inc=y&page=statements&statement=algemene_voorwaarden">Algemene Voorwaarden</a></li>
                            <li><a href="index.php?inc=y&page=AboutUs">Over Ons</a></li>
                            <li><a href="index.php?inc=y&formtype=content&page=forms&form=contactformulier">Contact</a></li>
                        </ul>
                    </li>
                        <li><a id="translate" href="#">Translate</a></li>
                    </ul>
                    <ul class="login">
                    <?php
                    if (!$_SESSION['loggedin'] == 1){
                        echo'   
                    <li><a href="#">Gebruikers</a>
                        <ul>
                            <li><a href="index.php?inc=y&page=auth&auth=login">Inloggen</a></li>
                            <li><a href="index.php?inc=y&page=auth&auth=SignUp">Registreren</a></li>
                        </ul>
                        </li>
                        ';} else { echo '
                            <li><a href="#">Gebruikers</a>
                            <ul>
                            <li><a href="index.php?inc=y&page=auth&auth=LogOut">Uitloggen</a></li>
                            </ul>
                            </li>
                        ';}?>
                    <?php
                    if ($_SESSION['loggedin'] == 1 && $_SESSION['IsAdmin'] == 1){
                        echo '   
                    <li><a href="#">Admin Pages</a>
                        <ul>
                            <li><a href="index.php?inc=y&page=admin&admin=FormOverview">Forms & Views</a></li>
                            <li><a href="phpmyadmin">DB Beheer</a></li>
                        </ul>
                        </li>
                        ';} 
                        ?>
                </ul>
            </nav>
