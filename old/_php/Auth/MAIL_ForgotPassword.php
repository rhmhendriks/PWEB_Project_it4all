<?php

$URL = "https://it4all.rhmhendriks.nl?page=auth&auth=Activate&token=" . $token;
$VerMail = '<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IT4ALL - Verify your email address</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <p>Beste ' . $FirstName . " " . $LastName. ', <br><br>
    <p>Enkele ogenblikken geleden heeft u aangegeven uw wachtwoord te zijn vergeten. Uit veiligheidsoverwegingen hebben we daarom uw account geblokkeerd tot u deze opnieuw activeerd met een nieuw wachtwoord, dit kunt u doen door de stappen in deze mail te volgen.</p><br>
    <h1>Wachtwoord niet vergeten of weer gevonden?</h1><br>
    <p>Als u uw wachtwoord niet bent vergeten kunt u de stappen in deze mail gewoon volgen om weer toegang te krijgen tot het account, vervolgens reageerd u op deze mail zodat wij kunnen onderzoeken wat er is gebeurd. <br><br> Heeft u uw wachtwoord weer gevonden? Helaas, JE kunt deze niet langer gebruiken. Volg de stappen in deze mail. </p>
    <p>Uw unieke activatiecode is <b>' . $ActivationCode . '</b>, u heeft deze nodig om een wachtwoord te kunnen aanmaken. </p><br><br><br>
    <!--VML button-->
    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
    <tr>
        <td>
        <div>
            <!--[if mso]>
            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="' . $URL . '" style="height:40px;v-text-anchor:middle;width:300px;" arcsize="5%" strokecolor="#ffaa00" fillcolor="#ffaa00;width: 130;">
                <w:anchorlock/>
                <center style="color:#ffffff;font-family:Helvetica, sans-serif;font-size:18px; font-weight: 600;"> Account Activeren </center>
            </v:roundrect>
    
            <![endif]-->
            <a href="' . $URL . '" style="display: inline-block; mso-hide:all; background-color: #ffaa00; color: #FFFFFF; border:1px solid #ffaa00; border-radius: 6px; line-height: 220%; width: 300px; font-family: Helvetica, sans-serif; font-size:14px; font-weight:600; text-align: center; text-decoration: none; -webkit-text-size-adjust:none;  " target="_blank">Account Activeren</a>
            </a>
            </div>
        </td>
    </tr>
    </table> <br><br><br><br>
    <p style="color:LightGrey;"><i>Werkt de bovenstaande knop niet? Plak dan de volgende link in uw browser  <a href="https://it4all.rhmhendriks.nl?page=auth&auth=Activate&token=' . $token . '">https://it4all.rhmhendriks.nl?page=auth&auth=Activate&token=' . $token . '</a> 


</body>
</html>
'
?>