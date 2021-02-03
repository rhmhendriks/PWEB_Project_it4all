<?php
    #########################################################################
    #####                                                               #####
    ##### THIS IS THE FUNCTION LIBARY OF THE ENTIRE PROJECT             #####
    #####                                                               #####
    ##### In this file we created all our custom functions this         #####
    ##### functions can be used in all html/php files in this project   #####
    #####                                                               #####
    ##### Please update all lines starting with "//" carefully!         #####
    #####                                                               #####
    #########################################################################

    ## This file is created on 12/10/2019 at 1:25 PM
    ## This file is created by Ronald HM Hendriks

    // Last updated on 12/10/2019 at 09:04 AM
    // Last edited by Ronald HM Hendriks

    ## What did you edit and why?
    //////////////////////////////////////////////////////////////////////////
    // The file created for all coming configuration parameters.            //
    // The files is still in development mode and is NOT ready to use       //
    //                                                                      //
    //                                                                      //
    //                                                                      //
    //                                                                      //
    //////////////////////////////////////////////////////////////////////////

        ### Hello World ###
            // test function
                function BigHello(){
                    $return = "<h1>Hello World!</h1>";
                    return($return);
                }

        ### Welcome on the site ###
                function WelcomeUser(){
                    /* This sets the $time variable to the current hour in the 24 hour clock format */
                    $time = date("H");
                    /* Set the $timezone variable to become the current timezone */
                    $timezone = date("e");
                    /* If the time is less than 1200 hours, show good morning */
                    if ($time < "12") {
                        $return = "Goedenmorgen" . " " . $_SESSION['FirstName'] . " " . $_SESSION['LastName'] . "!";
                    } else
                    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
                    if ($time >= "12" && $time < "17") {
                        $return = "Goedemiddag" . " " . $_SESSION['FirstName'] . " " . $_SESSION['LastName'] . "!";
                    } else
                    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                    if ($time >= "17" && $time < "23") {
                        $return = "Goedenavond" . " " . $_SESSION['FirstName'] . " " . $_SESSION['LastName'] . "!";
                    } else
                    /* Finally, show good night if the time is greater than or equal to 1900 hours */
                    if ($time >= "23") {
                        $return = "Goedenacht" . " " . $_SESSION['FirstName'] . " " . $_SESSION['LastName'] . "!";
                    }

                    return $return;
                }
        
        ### Imidiate Redirect ###
            function immediate_redirect_to($redirectlocation){
                header("location: {$redirectlocation}");
                exit;	
            }
        
        ### Check Value ###
            //////////////////////////////////////////////////////////////////
            // Check Value Function                                         //
            //--------------------------------------------------------------//
            // This function is checking a value for code and/or sql        //
            // injection. This function is mainly used to check form fields //
            //                                                              //
            //--------------------------------------------------------------//
            ## Function created on 21/10/2019                               ##
            ## Created by Ronald HM Hendriks                                ##
            // last updated 21/10/2019 5:22PM by Ronald HM Hendriks         //
            //////////////////////////////////////////////////////////////////
                function CheckValue($Value, $dbmysql = false){
                    $Connection = MySqlDo_Connector('Connect');
                    $DBconnect = $Connection['connection'];
                    $SecureValue = mysqli_real_escape_string($DBconnect, $Value);
                    $SecureValue = htmlspecialchars($Value);

                    if ($dbmysql){
                        $SecureValue = addslashes($Value);
                    }

                    return $SecureValue;
                }



        ### ShowError ###
            //////////////////////////////////////////////////////////////////
            // Show Error Function                                          //
            //--------------------------------------------------------------//
            // This function is used to show errors on the website          //
            //                                                              //          
            // Function Sytax example:                                      //
            //      ShowError(InvalidPage*, $ArticleID**)                   //
            //                                                              //
            //  * This is the error you wanna show                          //
            //  ** What Variables soe you wanna show in the error message?  //
            //                                                              //
            //--------------------------------------------------------------//
            ## Function created on 02/10/2019                               ##
            ## Created by Ronald HM Hendriks                                ##
            // last updated 12/10/2019 10:16PM by Ronald HM Hendriks        //
            //////////////////////////////////////////////////////////////////
                /**function ShowError($WitchError, $var1, $var2, $var3){
                    switch($WitchError) {
                        case InvalidPageID :
                            $message =      nl2br("<div id='ERROR'>" /n);
                            $message .=         nl2br("<H1> 404 NOT FOUND / 404 PAGINA NIET GEVONDEN </H1> /n");
                            $message .=         "<br>";
                            $message .=         nl2br("<p> /n");
                            $message .=             nl2br("Unfortionatly the requested page cannot be found. Please check the URL. /n"); 
                            $message .=             "<br>" ;
                            $message .=             nl2br("Helaas kunnen we de gevraagde pagina niet vinden. Controleer de URL. /n");
                            $message .=             "<br>";
                            $message .=             "<img src=&quot;_images/404.png&quot; alt=&quot;404 NOT FOUND&quot; height=&quot;400&quot; width=&quot;400&quot;>";
                            $message .=      nl2br("</p> /n </div>");
                            return($message);
                    }
                }*/


        ### MySqlDo_DropDown ###
            //////////////////////////////////////////////////////////////////
            // MySqlDo_DropDown Function                                    //
            //--------------------------------------------------------------//
            // This function is used to show database option in a dropdown  //
            // input field                                                  // 
            //                                                              //         
            // Function Sytax example:                                      //
            //      MySqlDo_DropDown($Values, $tablename, $DisplayName)     //
            //                                                              //
            //                                                              //
            //                                                              //
            //                                                              //
            //--------------------------------------------------------------//
            ## Function created on 21/10/2019                               ##
            ## Created by Ronald HM Hendriks                                ##
            // last updated 21/10/2019 3:41PM by Ronald HM Hendriks         //
            //////////////////////////////////////////////////////////////////                
                function MySqlDo_DropDown($Values, $tablename, $DisplayName){
                        // connectie maken met de database
                        $Connection = MySqlDo_Connector('Connect');
                        $DBconnect = $Connection['connection'];
                        $returndebug = $Connection['debug'];
                        
                        // statement maken
                        $statement = "SELECT `$Values` FROM `$tablename`";
                        $statementrunned = $DBconnect->query($statement);
                        if ($statementrunned->num_rows >0) { // Hier wordt het statement uitgevoerd en checken we of hij is geslaagd. 
                            $return = "<select name=" . $DisplayName . ">";
                            $returndebug .= "The statement did tun sucesfull!" . "<br />"; // Success geprint naar scherm
                            while ($row = $statementrunned->fetch_assoc()){
                                $option = $row["$Values"];
                                $return .= "<option value=" . "'$option'". ">" . "$option" . "</option>" . "<br />";
                            }
                            $return .= "</select>";
                            $resultfunction = true;
                        } else {
                            $returndebug .= "Oops! that did no go as we planned! The stament " . $statement . "Failed! The Information below is generated for the system administrator:" . "<br>" . $DBconnect->error . "<br /"; // Fout geprint naar scherm in Debug Style
                            $resultfunction = false;
                        }
                        
                    return array('optionfield'=>"$return", 'result'=>"$resultfunction", 'debug'=>"$returndebug");

                    }

        ### MySqlDo_Overview ###
            //////////////////////////////////////////////////////////////////
            // MySqlDo_DropDown Function                                    //
            //--------------------------------------------------------------//
            // This function is used create a overview of an entire         //
            // table in the database. The output of the function contains   // 
            // debug information, the table itself and a result boolean     //         
            //                                                              //
            //                                                              //
            //     Function Sytax example:                                  //
            //        MySqlDo_DropDown($table, $columns)                    //
            //                                                              //
            //                                                              //
            //--------------------------------------------------------------//
            ## Function created on 23/10/2019                               ##
            ## Created by Ronald HM Hendriks                                ##
            // last updated 24/10/2019 1:50PM by Ronald HM Hendriks         //
            ////////////////////////////////////////////////////////////////// 

                function MySqlDo_Overview($table=null, $columns, $idColumn, $other=null){
                    // We gaan eerst een verbinding maken met de database
                    $Connection = MySqlDo_Connector('Connect');
                    $DBconnect = $Connection['connection'];
                    $returndebug = $Connection['debug'] . "<br>";
            
                    // We gaan als eerste het statement opmaken
                    if ($other == "AdminForm") {
						$statement = "SELECT Customers.*, Users.EMail, Users.Number_Login_Attempts, Users.Verified, Users.PrivacyAcknoledge FROM Users JOIN Customers ON Users.CustomerID=Customers.ClientNumber";
					} else {
						$statement = "SELECT  * FROM {$table}";
					}
					
                    $statementrunned = $DBconnect->query($statement);
            
                    if ($statementrunned->num_rows > 0) {
                        $returntable = '<div id="tableOverflow">';
                        $returntable .= '<table class="OverviewTable">' . '<br>' . '<tr>';
                        foreach ($columns as $key => $Value){
                            $returntable .= "<th>{$Value}</th>";
                        }
                        $returntable .= "<th><b>" . "Database Acties" . "</th></b>";
                        $returntable .=  "</tr>" . "<br>";
                        $resultaat = $statementrunned->fetch_all(); // We halen de rijen op

                        foreach ($resultaat as $rij){
                            $returntable .= '<tr>';
                            foreach ($rij as $value){
                                if (strlen($value) > 155){
                                    $value = substr($value, 0, 155) . "...";
                                }
                                $returntable .= '<td>' . $value . '</td>';   
                            }
                            $ID = $rij["$idColumn"];
                            $returntable .= '<td height:25px;>';
                            $returntable .= '<a href="index.php?page=auth&auth=AdminNoAccess"><img border="0" alt="edit" src="../_images/edit.png"></a><a href="_php/CRUD/del.php?table=' . $table . '&ID=' . $ID . '"><img border="0" alt="edit" src="../_images/delete.png"></a>';
                            $returntable .= '</td></tr>';
                        }
                        $returntable .= "</table>" . "<br>";
                        $returntable .= '</div>';
                        $resultfunction = true;
                    } else {
                        $returndebug .= "Oops! that did no go as we planned! The stament " . $statement . "Failed! The Information below is generated for the system administrator:" . "<br>" . $DBconnect->error . "<br /"; // Fout geprint naar scherm in Debug Style
                        $resultfunction = false;
                    } 
                    return  array('debug'=>$resultfunction, 'table'=>$returntable, 'result'=>$returndebug);
                }

        ### MySqlDo_Connector ###
            //////////////////////////////////////////////////////////////////
            // MySqlDo_Connector Function                                   //
            //--------------------------------------------------------------//
            // This function is used to open or close database connections  //
            //                                                              //
            //     Function Sytax example:                                  //
            //        MySqlDo_DropDown($action, $Connection (only close))   //
            //                                                              //
            //                                                              //
            //--------------------------------------------------------------//
            ## Function created on 20/10/2019                               ##
            ## Created by Ronald HM Hendriks                                ##
            // last updated 24/10/2019 1:52PM by Ronald HM Hendriks         //
            ////////////////////////////////////////////////////////////////// 
                function MySqlDo_Connector($action, $Connection = NULL){
                    $returnconnection = "";
                    if ($action == 'Connect'){
                        $Connection = @new mysqli(ServerName, DBSigninName, DBKey, DBname);
                        if ($Connection->connect_error) { // Er wordt gecontroleerd op fouten bij de databaseverbinding
                            $returndebug = die("Oops! The databse connection failed!, The infotmation below is generated for the site administrator. " . "<br />" . $Connection->connect_error) . "<br />";
                            $resultfunction = false;
                            } else {
                            $returndebug = "Yeah! The connection is active! Now we can do some SQL statement!" . "<br />"; // Nu wordt er weergegeven dat de database connectie geslaagd is
                            $resultfunction = true;
                            $returnconnection = $Connection;
                    }
                    } elseif ($action == 'Disconnect') {
                        $Connection->close();
                             $resultfunction = true;
                             $returndebug = "The Database connection has been closed. <br>";
                             $resultconnection = "closed";
                    }
                    return $Information = array("debug"=>"$returndebug", "result"=>$resultfunction, "connection"=>$returnconnection);
                }
                
        ### MySqlDo_Add ###
            //////////////////////////////////////////////////////////////////
            // MySqlDo_Add Function                                         //
            //--------------------------------------------------------------//
            // This function is used add data to an database table          //
            // This function is only used in combination with MySqlDo()     //
            //                                                              //
            //     Function Sytax example:                                  //
            //        MySqlDo_DropDown($action, $Connection (only close))   //
            //                                                              //
            //                                                              //
            //--------------------------------------------------------------//
            ## Function created on 20/10/2019                               ##
            ## Created by Ronald HM Hendriks                                ##
            // last updated 24/10/2019 1:54PM by Ronald HM Hendriks         //
            //////////////////////////////////////////////////////////////////
                    function MySqlDo_Add($table, $columns, $values){
                        $returndebug = "";
                        $return = "";
                        $last_id = 010101010101;
                        // Laten we het commando opmaken
                            $statementadd = "INSERT INTO " . $table . "($columns)" . ' VALUES ' . "(" . $values . ")" . ";";
                            $ConnectionArray = MySqlDo_Connector('Connect');
                            if ($ConnectionArray['result']){
                                    $returndebug = $ConnectionArray['debug'];
                                    $DBconnect = $ConnectionArray['connection'];
                                    if ($DBconnect->query($statementadd) === TRUE) { // Hier wordt het statement uitgevoerd en checken we of hij is geslaagd. 
                                        $last_id = $DBconnect->insert_id; // Hier wordt het ID van het toegevoegde record opgehaald
                                        $returndebug .= "New record created successfully. Last inserted ID is: " . $last_id . "<br />"; // Success geprint naar scherm
                                        $resultfunction = true;
                                    } else {
                                        $returndebug .= "Oops! that did no go as we planned! The stament: <b>" . $statementadd . "</b> Failed! The Information below is generated for the system administrator:" . "<br>" . "<b>" . $DBconnect->error . "</b>" . "<br /"; // Fout geprint naar scherm in Debug Style
                                        $resultfunction = false;
                                    }
                                } else {
                                    $returndebug = $ConnectionArray['Debug'];
                                    $resultfunction = false;
                                }
                        $disconnector = MySqlDo_Connector("Disconnect", $DBconnect);
                        $returndebug .= $disconnector['debug'];
                        return array('result'=>$resultfunction, 'debug'=>$returndebug, 'ID'=>$last_id);
                    }
         
        ### MySqlDo_Delete ###
            //////////////////////////////////////////////////////////////////
            // MySqlDo_Delete Function                                      //
            //--------------------------------------------------------------//
            // This function is used add data to an database table          //
            // This function is only used in combination with MySqlDo()     //
            //                                                              //
            //     Function Sytax example:                                  //
            //        MySqlDo_DropDown($action, $Connection (only close))   //
            //                                                              //
            //                                                              //
            //--------------------------------------------------------------//
            ## Function created on 20/10/2019                               ##
            ## Created by Ronald HM Hendriks                                ##
            // last updated 30/01/2021 9:49AM by Ronald HM Hendriks         //
            //////////////////////////////////////////////////////////////////
                    function MySqlDo_Delete($table, $idColumn, $ID){
                        $statementdel = "DELETE FROM " . $table . "WHERE " . $idColumn . " = " . $ID . ";";
                        $Connection = MySqlDo_Connector('Connect');
                        if ($Connection['result']){
                            $returndebug = $Connection['debug'];
                            $DBconnect = $Connection['connection'];
                            // Nu voeren we het commando uit
                            if ($DBconnect->query($statementdel) === TRUE) { // Hier wordt het statement uitgevoerd en checken we of hij is geslaagd. 
                                $returndebug .= "The record with ID $ID has been deleted!: <br />"; // Success geprint naar scherm
                                $return = true;
                            } else {
                                $returndebug .= "Oops! that did no go as we planned! The stament <b>" . $statementdel . "</b>Failed! The Information below is generated for the system administrator:" . "<br>" . $DBconnect->error . "<br /"; // Fout geprint naar scherm
                                $return = false;
                            }
                        } else {
                            $returndebug = $Connection['debug'];
                            $return = false;
                        }
                        return array('debug'=>$returndebug, 'result'=>$return);
                    }
        
        ### MySqlDo ###
            /**
             * ! THIS METHOD NEEDS TO BE REFACTORED IF THERE IS TIME!
             */
            //////////////////////////////////////////////////////////////////
            // MySqlDo_Delete Function                                      //
            //--------------------------------------------------------------//
            // This function is used add data to an database table          //
            // This function is only used in combination with MySqlDo()     //
            //                                                              //
            //     Function Sytax example:                                  //
            //        MySqlDo_DropDown($action, $Connection (only close))   //
            //                                                              //
            //                                                              //
            //--------------------------------------------------------------//
            ## Function created on 20/10/2019                               ##
            ## Created by Ronald HM Hendriks                                ##
            // last updated 30/01/2021 09:49AM by Ronald HM Hendriks        //
            //////////////////////////////////////////////////////////////////
                    function MySqlDo($ToDo, $OnWhat, $var1 = NULL, $var2 = NULL, $var3 = NULL, $var4 = NULL, $var5 = NULL, $var6 = NULL, $var7 = NULL, $var8 = NULL, $var9 = NULL, $var10 = NULL, $var11 = NULL, $var12 = NULL, $var13 = NULL, $var14 = NULL, $var15 = NULL){
                        // Nu gaat de functie beginnen met aantal controles. 
                        // Er wordt naar de hand van if statements getest welke tabel er is meegegeven bij de aanroep van de funties. (herken de loops aan *)
                            if ($OnWhat == "Article"){ //*
                                $table = "Articles"; // We specificeren de exacte tabelnaam h
                                $idColumn = 'ArticleID'; // We specifieren het herkenbare ID-kolom (de primaire sleutel)

                                // Hieronder wordt er aan de hand van een switch gekeken wat de funtie moet gaan doen de switches herken je aan **
                                switch($ToDo){ //**
                                    case "Add":
                                        $columns = "`ArticleID`, `ArticleTitle`, `ArticleDescription`, `ArticleGroup`, `NumberInStock`, `StockPrice`, `SellingPrice`"; // De kolommem specificeren ten behoeve van het uit te voeren statement in mysqldo_add
                                        $content = "NULL, '$var1', '$var2', '$var3', '$var4', '$var5', '$var6'"; // De toe te voegen waarden worden aangegeven ten behoeve van het uit te voeren statement in mysqldo_add
                                        $AddArray = MySqlDo_Add($table, $columns, $content); // Hier wordt de array gecreeerd door de functie mysql_add opghaald. Tevens wordt hiermee geprobeerd om de gegevens aan de database toe te voegen.
                                        $ActionLog = $AddArray['debug']; // Nu wordt de debug informatie afkomstig uit de funtie mysqldo_add weggeschreven naar de actionlog
                                        $AddedID = $AddArray['ID']; // Het ID van het toegevoegde record word gespecificeerd
                                        $resultfunction = $AddArray['result']; // De result boolean wordt gevuld met het resultaat van de funtie mysqldo_add
                                        break;
                                    case "Delete":
                                        $ID = $var1;
                                        $DelArray = MySqlDo_Delete($table, $idColumn, $ID);
                                        $ActionLog = $DelArray['debug'];
                                        $AddedID = $ID;
                                        $resultfunction = $DelArray['result'];
                                        break;
                                    case "Overview":
                                        // we gaan de kolomnamen maken
                                        $columns = ["ArticleID", "ArticleTitle", "ArticleDescription", "ArticleGroup", "NumberInStock", "StockPrice", "SellingPrice"];
                                        $ResultOverview = MySqlDo_Overview($table, $columns, $idColumn);
                                        $ActionLog = $ResultOverview['debug'];
                                        $AddedID = $ResultOverview['table'];
                                        $resultfunction = $ResultOverview['result'];
                                        break;
                                }

                                } elseif ($OnWhat == "Customer"){ //*
                                    $table = 'Customers'; // We specificeren de exacte tabelnaam
                                    $idColumn = 'ClientNumber'; // We specifieren het herkenbare ID-kolom (de primaire sleutel)

                                    switch($ToDo){ //**
                                        case "Add":
                                            $columns = '`ClientNumber`, `FirstName`, `LastName`, `DateofBirth`, `Gender`, `Address`, `PostalCode`, `City`, `Country`, `BIC`, `IBAN`'; // De kolommem specificeren ten behoeve van het uit te voeren statement uit mysqldo_add
                                            $content = "NULL, '$var1', '$var2', '$var3', '$var4', '$var5', '$var6', '$var7', '$var8', '$var9','$var10'"; // De toe te voegen waarden worden aangegeven ten behoeve van het uit te voeren statement in mysqldo_add
                                            $AddArray = MySqlDo_Add($table, $columns, $content); // Hier wordt de array gecreeerd door de functie mysql_add opghaald. Tevens wordt hiermee geprobeerd om de gegevens aan de database toe te voegen.
                                            $ActionLog = $AddArray['debug']; // Nu wordt de debug informatie afkomstig uit de funtie mysqldo_add weggeschreven naar de actionlog
                                            $AddedID = $AddArray['ID']; // Het ID van het toegevoegde record word gespecificeerd
                                            $resultfunction = $AddArray['result'];
                                            break;
                                        case "Delete":
                                            $ID = $var1;
                                            $DelArray = MySqlDo_Delete($table, $idColumn, $ID);
                                            $ActionLog = $DelArray['debug'];
                                            $AddedID = $ID;
                                            $resultfunction = $DelArray['result'];
                                            break;
                                        case "Overview":
                                            // we gaan de kolomnamen maken
                                            $columns = ["ClientNumber", "FirstName", "LastName", "DateofBirth", "Gender", "Address", "PostalCode", "City", "Country", "BIC", "IBAN"];
                                            $ResultOverview = MySqlDo_Overview($table, $columns, $idColumn);
                                            $ActionLog = $ResultOverview['debug'];
                                            $AddedID = $ResultOverview['table'];
                                            $resultfunction = $ResultOverview['result'];
                                            break;
                                    }

                                } elseif($OnWhat == "ArticleGroup"){ //*
                                    $table = 'ArticleGroups'; // We specificeren de exacte tabelnaam
                                    $idColumn = 'ArticleGroupID'; // We specifieren het herkenbare ID-kolom (de primaire sleutel)

                                    switch($ToDo){//**
                                        case "Add":
                                            $columns = '`ArticleGroupID`, `GroupTitle`'; // De kolommem specificeren ten behoeve van het uit te voeren statement uit mysqldo_add
                                            $content = "NULL, '$var1'";
                                            $AddArray = MySqlDo_Add($table, $columns, $content); // Hier wordt de array gecreeerd door de functie mysql_add opghaald. Tevens wordt hiermee geprobeerd om de gegevens aan de database toe te voegen.
                                            $ActionLog = $AddArray['debug']; // Nu wordt de debug informatie afkomstig uit de funtie mysqldo_add weggeschreven naar de actionlog
                                            $AddedID = $AddArray['ID']; // Het ID van het toegevoegde record word gespecificeerd
                                            $resultfunction = $AddArray['result']; // De result boolean wordt gevuld met het resultaat van de funtie mysqldo_add
                                            break;
                                        case "Delete":
                                            $ID = $var1;
                                            $DelArray = MySqlDo_Delete($table, $idColumn, $ID);
                                            $ActionLog = $DelArray['debug'];
                                            $AddedID = $ID;
                                            $resultfunction = $DelArray['result'];
                                            break;
                                        case "Overview":
                                            // we gaan de kolomnamen maken
                                            $columns = ["ArticleGroupID", "GroupTitle"];
                                            $ResultOverview = MySqlDo_Overview($table, $columns, $idColumn);
                                            $ActionLog = $ResultOverview['debug'];
                                            $AddedID = $ResultOverview['table'];
                                            $resultfunction = $ResultOverview['result'];
                                            break;
                                    }

                                } elseif ($OnWhat == "Author"){ //*
                                    $table = 'Authors'; // We specificeren de exacte tabelnaam
                                    $idColumn = 'AuthorID'; // We specifieren het herkenbare ID-kolom (de primaire sleutel)

                                    switch($ToDo){ //**
                                        case "Add":
                                            $columns = '`AuthorID`, `FirstName`, `LastName`, `LoginID`'; // De kolommem specificeren ten behoeve van het uit te voeren statement uit mysqldo_add
                                            $content = "NULL, '$var1', '$var2', '$var3'"; // De toe te voegen waarden worden aangegeven ten behoeve van het uit te voeren statement in mysqldo_add
                                            $AddArray = MySqlDo_Add($table, $columns, $content); // Hier wordt de array gecreeerd door de functie mysql_add opghaald. Tevens wordt hiermee geprobeerd om de gegevens aan de database toe te voegen.
                                            $ActionLog = $AddArray['debug']; // Nu wordt de debug informatie afkomstig uit de funtie mysqldo_add weggeschreven naar de actionlog
                                            $AddedID = $AddArray['ID']; // Het ID van het toegevoegde record word gespecificeerd
                                            $resultfunction = $AddArray['result']; // De result boolean wordt gevuld met het resultaat van de funtie mysqldo_add
                                            break;
                                        case "Delete":
                                            $ID = $var1;
                                            $DelArray = MySqlDo_Delete($table, $idColumn, $ID);
                                            $ActionLog = $DelArray['debug'];
                                            $AddedID = $ID;
                                            $resultfunction = $DelArray['result'];
                                            break;
                                        case "Overview":
                                            // we gaan de kolomnamen maken
                                            $columns = ["AuthorID", "FirstName", "LastName", "LoginID"];
                                            $ResultOverview = MySqlDo_Overview($table, $columns, $idColumn);
                                            $ActionLog = $ResultOverview['debug'];
                                            $AddedID = $ResultOverview['table'];
                                            $resultfunction = $ResultOverview['result'];
                                            break;
                                    } 

                                } elseif ($OnWhat == "Tip_Trick"){ //*
                                    $table = 'TipsandTricks'; // We specificeren de exacte tabelnaam
                                    $idColumn = 'PageID'; // We specifieren het herkenbare ID-kolom (de primaire sleutel)

                                    switch($ToDo){ //**
                                        case "Add":
                                            $columns = '`PageID`, `PageTitle`, `Date`, `AuthorID`, `CategoryID`, `Content`, `Sources`'; // De kolommem specificeren ten behoeve van het uit te voeren statement uit mysqldo_add
                                            $content = "NULL, '$var1', '$var2', '$var3', '$var4', '$var5', '$var6'"; // De toe te voegen waarden worden aangegeven ten behoeve van het uit te voeren statement in mysqldo_add
                                            $AddArray = MySqlDo_Add($table, $columns, $content); // Hier wordt de array gecreeerd door de functie mysql_add opghaald. Tevens wordt hiermee geprobeerd om de gegevens aan de database toe te voegen.
                                            $ActionLog = $AddArray['debug']; // Nu wordt de debug informatie afkomstig uit de funtie mysqldo_add weggeschreven naar de actionlog
                                            $AddedID = $AddArray['ID']; // Het ID van het toegevoegde record word gespecificeerd
                                            $resultfunction = $AddArray['result']; // De result boolean wordt gevuld met het resultaat van de funtie mysqldo_add
                                            break;
                                        case "Delete":
                                            $ID = $var1;
                                            $DelArray = MySqlDo_Delete($table, $idColumn, $ID);
                                            $ActionLog = $DelArray['debug'];
                                            $AddedID = $ID;
                                            $resultfunction = $DelArray['result'];
                                            break;
                                        case "Overview":
                                            // we gaan de kolomnamen maken
                                            $columns = ["PageID", "PageTitle", "Date", "AuthorID", "Images", "CategoryID", "Content", "Sources"];
                                            $ResultOverview = MySqlDo_Overview($table, $columns, $idColumn);
                                            $ActionLog = $ResultOverview['debug'];
                                            $AddedID = $ResultOverview['table'];
                                            $resultfunction = $ResultOverview['result'];
                                            break;
                                    }

                                } elseif ($OnWhat == "TipsGroup"){ //*
                                    $table = 'TipsTricksCategory'; // We specificeren de exacte tabelnaam
                                    $idColumn = 'CategoryID'; // We specifieren het herkenbare ID-kolom (de primaire sleutel)

                                    switch($ToDo){//**
                                        case "Add":
                                            $columns = '`CategoryID`, `CategoryTitle`'; // De kolommem specificeren ten behoeve van het uit te voeren statement uit mysqldo_add
                                            $content = "NULL, '$var1'"; // De toe te voegen waarden worden aangegeven ten behoeve van het uit te voeren statement in mysqldo_add
                                            $AddArray = MySqlDo_Add($table, $columns, $content); // Hier wordt de array gecreeerd door de functie mysql_add opghaald. Tevens wordt hiermee geprobeerd om de gegevens aan de database toe te voegen.
                                            $ActionLog = $AddArray['debug']; // Nu wordt de debug informatie afkomstig uit de funtie mysqldo_add weggeschreven naar de actionlog
                                            $AddedID = $AddArray['ID']; // Het ID van het toegevoegde record word gespecificeerd
                                            $resultfunction = $AddArray['result']; // De result boolean wordt gevuld met het resultaat van de funtie mysqldo_add
                                            break;
                                        case "Delete":
                                            $ID = $var1;
                                            $DelArray = MySqlDo_Delete($table, $idColumn, $ID);
                                            $ActionLog = $DelArray['debug'];
                                            $AddedID = $ID;
                                            $resultfunction = $DelArray['result']; 
                                            break;  
                                        case "Overview":
                                            // we gaan de kolomnamen maken
                                            $columns = ["CategoryID", "CategoryTitle"];
                                            $ResultOverview = MySqlDo_Overview($table, $columns, $idColumn);
                                            $ActionLog = $ResultOverview['debug'];
                                            $AddedID = $ResultOverview['table'];
                                            $resultfunction = $ResultOverview['result'];
                                            break;                 
                                    } 

                                } elseif ($OnWhat == "User"){ //*
                                    $table = 'Users'; // We specificeren de exacte tabelnaam
                                    $idColumn = 'EMail'; // We specifieren het herkenbare ID-kolom (de primaire sleutel)

                                    switch($ToDo){ //**
                                        case "Add":
                                            $columns = '`EMail`, `CustomerID`, `Password`, `IsAdmin`, `Number_Login_Attempts`, `Verified`, `Token`, `PrivacyAcknoledge`, `AccentColor`'; // De kolommem specificeren ten behoeve van het uit te voeren statement uit mysqldo_add
                                            $content = "'$var1', '$var2', '$var3', '$var4', '$var5', '$var6', '$var7', '$var8', '$var9'"; // De toe te voegen waarden worden aangegeven ten behoeve van het uit te voeren statement in mysqldo_add
                                            $AddArray = MySqlDo_Add($table, $columns, $content); // Hier wordt de array gecreeerd door de functie mysql_add opghaald. Tevens wordt hiermee geprobeerd om de gegevens aan de database toe te voegen.
                                            $ActionLog = $AddArray['debug']; // Nu wordt de debug informatie afkomstig uit de funtie mysqldo_add weggeschreven naar de actionlog
                                            $AddedID = $AddArray['ID']; // Het ID van het toegevoegde record word gespecificeerd
                                            $resultfunction = $AddArray['result']; // De result boolean wordt gevuld met het resultaat van de funtie mysqldo_add
                                            break;
                                        case "Delete":
                                            $ID = $var1;
                                            $DelArray = MySqlDo_Delete($table, $idColumn, $ID);
                                            $ActionLog = $DelArray['debug'];
                                            $AddedID = $ID;
                                            $resultfunction = $DelArray['result']; 
                                            break;  
                                        case "Overview":
                                            // we gaan de kolomnamen maken
                                            $columns = ["EMail", "CustomerID", "Password", "IsAdmin", "Number_Login_Attempts", "Verified", "Token", "PrivacyAcknoledge", "AccentColor"];
                                            $ResultOverview = MySqlDo_Overview($table, $columns, $idColumn);
                                            $ActionLog = $ResultOverview['debug'];
                                            $AddedID = $ResultOverview['table'];
                                            $resultfunction = $ResultOverview['result'];
                                            break;                  
                                    } 

                                } elseif ($OnWhat == "Media"){ //*
                                    $table = 'ImagesVideos'; // We specificeren de exacte tabelnaam
                                    $idColumn = 'FileID'; // We specifieren het herkenbare ID-kolom (de primaire sleutel)

                                    switch($ToDo){ //**
                                        case "Add":
                                            $columns = '`FileID`, `FileName`, `FileType`, `FileSize`, `FilePath`, `ArticleID`, `TipTrickID`'; // De kolommem specificeren ten behoeve van het uit te voeren statement uit mysqldo_add
                                            $content = "NULL, '$var1', '$var2', '$var3', '$var4', '$var5', '$var6'"; // De toe te voegen waarden worden aangegeven ten behoeve van het uit te voeren statement in mysqldo_add
                                            $AddArray = MySqlDo_Add($table, $columns, $content); // Hier wordt de array gecreeerd door de functie mysql_add opghaald. Tevens wordt hiermee geprobeerd om de gegevens aan de database toe te voegen.
                                            $ActionLog = $AddArray['debug']; // Nu wordt de debug informatie afkomstig uit de funtie mysqldo_add weggeschreven naar de actionlog
                                            $AddedID = $AddArray['ID']; // Het ID van het toegevoegde record word gespecificeerd
                                            $resultfunction = $AddArray['result']; // De result boolean wordt gevuld met het resultaat van de funtie mysqldo_add
                                            break;
                                        case "Delete":
                                            $ID = $var1;
                                            $DelArray = MySqlDo_Delete($table, $idColumn, $ID);
                                            $ActionLog = $DelArray['debug'];
                                            $AddedID = $ID;
                                            $resultfunction = $DelArray['result'];
                                            break; 
                                        case "Overview":
                                            // we gaan de kolomnamen maken
                                            $columns = ["FileID", "FileName", "FileType", "FileSize", "FilePath", "ArticleID", "TipTrickID"];
                                            $ResultOverview = MySqlDo_Overview($table, $columns, $idColumn);
                                            $ActionLog = $ResultOverview['debug'];
                                            $AddedID = $ResultOverview['table'];
                                            $resultfunction = $ResultOverview['result'];
                                            break;                    
                                    }

                                } elseif ($OnWhat == "Contactform"){ //*
                                    $table = 'ContactForm'; // We specificeren de exacte tabelnaam
                                    $idColumn = 'ApplyID'; // We specifieren het herkenbare ID-kolom (de primaire sleutel)
                                    switch($ToDo){ //**
                                        case "Add":
                                            $columns = '`ApplyID`, `Name`, `PhoneNumber`, `EMailAddress`, `Question`'; // De kolommem specificeren ten behoeve van het uit te voeren statement uit mysqldo_add
                                            $content = "NULL, '$var1', '$var2', '$var3', '$var4'"; // De toe te voegen waarden worden aangegeven ten behoeve van het uit te voeren statement in mysqldo_add
                                            $AddArray = MySqlDo_Add($table, $columns, $content); // Hier wordt de array gecreeerd door de functie mysql_add opghaald. Tevens wordt hiermee geprobeerd om de gegevens aan de database toe te voegen.
                                            $ActionLog = $AddArray['debug']; // Nu wordt de debug informatie afkomstig uit de funtie mysqldo_add weggeschreven naar de actionlog
                                            $AddedID = $AddArray['ID']; // Het ID van het toegevoegde record word gespecificeerd
                                            $resultfunction = $AddArray['result']; // De result boolean wordt gevuld met het resultaat van de funtie mysqldo_add
                                            break;
                                        case "Delete":
                                            $ID = $var1;
                                            $DelArray = MySqlDo_Delete($table, $idColumn, $ID);
                                            $ActionLog = $DelArray['debug'];
                                            $AddedID = $ID;
                                            $resultfunction = $DelArray['result'];
                                            break; 
                                        case "Overview":
                                            // we gaan de kolomnamen maken
                                            $columns = ["ApplyID", "Name", "PhoneNumber", "EMailAddress", "Question"];
                                            $ResultOverview = MySqlDo_Overview($table, $columns, $idColumn);
                                            $ActionLog = $ResultOverview['debug'];
                                            $AddedID = $ResultOverview['table'];
                                            $resultfunction = $ResultOverview['result'];
                                            break;                    
                                    }
                                } 
                                
/**
 * * FROM THIS POINT ON WE STARTED WORKING ON PROJECT 2.2
 * * SOME OF THE FUNTIONS ABOVE HAVE BEEN EDITED FOR THIS
 * * PROJECT. IN THE SAME FOLDER AS THIS FILE IS A LIST 
 * * WITH THE CHANGES THAT WE MADE THERE. 
 */
                                
                                
                                
                                elseif ($OnWhat == "AUTH2FAlinks"){ //*
                                    $table = 'AUTH2FAlinks'; // We specificeren de exacte tabelnaam
                                    $idColumn = 'sessionID'; // We specifieren het herkenbare ID-kolom (de primaire sleutel)
                                    $columns = '`sessionID`, `user`, `2FAapp`, `2FAmail`, `Pincode`, `PinAttempts`, `SecurityQuestionA`, `SecurityQuestionB`, `Token`, `GenerationDate`, `OTP`'; // De kolommem specificeren ten behoeve van het uit te voeren statement uit mysqldo_add

                                    switch($ToDo){ //**
                                        case "Add":
                                            $content = "NULL, '$var1', '$var2', '$var3', '$var4', '$var5', '$var6', '$var7', '$var8', '$var9', '$var10', '$var11'"; // De toe te voegen waarden worden aangegeven ten behoeve van het uit te voeren statement in mysqldo_add
                                            $AddArray = MySqlDo_Add($table, $columns, $content); // Hier wordt de array gecreeerd door de functie mysql_add opghaald. Tevens wordt hiermee geprobeerd om de gegevens aan de database toe te voegen.
                                            $ActionLog = $AddArray['debug']; // Nu wordt de debug informatie afkomstig uit de funtie mysqldo_add weggeschreven naar de actionlog
                                            $AddedID = $AddArray['ID']; // Het ID van het toegevoegde record word gespecificeerd
                                            $resultfunction = $AddArray['result']; // De result boolean wordt gevuld met het resultaat van de funtie mysqldo_add
                                            break;
                                        case "Delete":
                                            $ID = $var1;
                                            $DelArray = MySqlDo_Delete($table, $idColumn, $ID);
                                            $ActionLog = $DelArray['debug'];
                                            $AddedID = $ID;
                                            $resultfunction = $DelArray['result'];
                                            break; 
                                        case "Overview":
                                            // we gaan de kolomnamen maken
                                            $ResultOverview = MySqlDo_Overview($table, $columns, $idColumn);
                                            $ActionLog = $ResultOverview['debug'];
                                            $AddedID = $ResultOverview['table'];
                                            $resultfunction = $ResultOverview['result'];
                                            break;                    
                                    }
                                }
                        return array('debug'=>$ActionLog, 'result'=>$resultfunction, 'ID'=>$AddedID);
                    }

        
/*
        function sendMail($subject, $reciever, $message, $debug){

            require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
            require '/usr/share/php/libphp-phpmailer/class.smtp.php';
            
            $mail = new PHPMailer;
            $mail->setFrom('rhmhendriks@rhmhendriks.nl');
            $mail->addAddress($reciever);
            $mail->Subject = $subject;
            $mail->Body = file_get_contents("../$subject");
            $mail->IsSMTP();
            $mail->Host = 'mail.rhmhendriks.nl';
            $mail->SMTPAuth = true;
            $mail->Port = 25;

            //Set your existing gmail address as user name
            $mail->Username = "rhmhendriks@rhmhendriks.nl";

            //Set the password of your gmail address here
            $mail->Password = 'R0n@ld1999-1705';
            if(!$mail->send()) {
                $debug .= "Email is not sent.\n";
                $debug .= $subject . " " . $reciever;
                $debug .= 'Email error: ' . $mail->ErrorInfo . "\n";
            } else {
                
            }*/
            
            /*
            //Let's prepare the mail.
            $to         =       $reciever;
            $subject    =       $subject;
            $headers    =       "From: webmaster.it4all@rhmhendriks.nl\r\n";
            $headers    .=      "Reply-To: noreply@rhmhendriks.nl\r\n";
            $headers    .=      "MIME-Version: 1.0\r\n";
            $headers    .=      "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
            $messageToSend    =       "../_php/";
            $messageToSend    .=      $message; 

            require $messageToSend;

        // Let's send thme mail
            mail($to, $subject, $VerMail, $headers);
            $debug .= "An email was send to $to with $subject as subject.";*/
        //}

        function generateQRcode($token){
            $url = 'https://it4all.rhmhendriks.nl/index.php?inc=y&page=auth&auth=2FAapp&2FAapp=index&update=y&Token=' + "$token";
            $data = urlencode($url);
            return '<img src="https://api.qrserver.com/v1/create-qr-code/?data=' . $url . '&amp;size=150x150" alt="QR Secured" title="" />';
        }


        
?>