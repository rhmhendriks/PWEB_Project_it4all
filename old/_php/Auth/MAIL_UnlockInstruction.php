<?php
$URL = 'https://it4all.rhmhendriks.nl?page=auth&auth=Unlock&token=' . $token;
$VerMail = '<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IT4ALL - Verify your email address</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body>
    <p>Beste ' . $FirstName . " " . $LastName. ', <br><br>
    <p>U ontvangt deze mail omdat we onlangs meerdere foutieve inlogverzoeken hebben ontvangen voor uw account. Uit veiligheidoverwegingen hebben we het account daarom tijdelijk geblokkeerd. <br><br> U hoeft zich geen zorgen te maken uw gegevens zijn volkomen veilig er is namelijk geen toegang tot het account verkregen. U kunt de instructie hieronder volgen om uw account te herstellen en een nieuw wachtwoord aan te maken. </p><br>
    <h1>Uw account Herstellen</h1><br>
    <br>
    <p>Om u account te herstellen bent u alleen de onderstaande ontgrendelcode en de knop uit deze mail nodig. Wanneer u klikt op "Account Herstellen" wordt u doorgestuurd naar onze website, hier kunt u vervolgens de ontgrendelcode invoeren en een nieuw wachtwoord aanmaken! </p><br>
    <p>Uw unieke ontgrendelcode is <b>' . $UnlockCode . '</b>, u heeft deze nodig om een wachtwoord te kunnen aanmaken. </p><br><br><br>
    <!--VML button-->
        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
        <tr>
            <td>
            <div>
                <!--[if mso]>
                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="' . $URL . '" style="height:40px;v-text-anchor:middle;width:300px;" arcsize="5%" strokecolor="#ffaa00" fillcolor="#ffaa00;width: 130;">
                    <w:anchorlock/>
                    <center style="color:#ffffff;font-family:Helvetica, sans-serif;font-size:18px; font-weight: 600;"> Account Herstellen </center>
                </v:roundrect>
        
                <![endif]-->
                <a href="' . $URL . '" style="display: inline-block; mso-hide:all; background-color: #ffaa00; color: #FFFFFF; border:1px solid #ffaa00; border-radius: 6px; line-height: 220%; width: 300px; font-family: Helvetica, sans-serif; font-size:14px; font-weight:600; text-align: center; text-decoration: none; -webkit-text-size-adjust:none;  " target="_blank">Account Herstellen</a>
                </a>
                </div>
            </td>
        </tr>
        </table> <br><br><br><br>
    <p style="color:LightGrey;"><i>Werkt de bovenstaande knop niet? Plak dan de volgende link in uw browser  <a href="https://it4all.rhmhendriks.nl?page=auth&auth=Unlock&token=' . $token . '">https://it4all.rhmhendriks.nl?page=auth&auth=Unlock&token=' . $token . '</a> 


</body>
</html>
'
?>