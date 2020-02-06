<?php
$URL = "https://it4all.rhmhendriks.nl?page=auth&auth=RenewActivation&token=" . $token ;
$VerMail = '<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IT4ALL - Verify your email address</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <p>Beste ' . $FirstName . " " . $LastName. ', <br><br>
    <p> Onlangs heeft u geprobeerd in te loggen op onze website. Uw account is echter nog niet geactiveerd! <br> Uit veiligheidoverwegingen kunt u daarom nog niet inloggen, wij willen u met deze mail vragen om uw account te activeren alvorens u inlogd. <br><br> U heeft na registratie op de site een mail ontvangen met activatieinstructies (staat mogelijk in uw SPAM map!), heeft u deze niet meer of werkt de code niet meer? Dan kunt u de mail opniew laten versturen via de onderstaande knop.</p><br>
    <br><br>
    <h1>Nieuwe activatiecode aanvragen</h1><br>
    <br>

        <!--VML button-->
        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
        <tr>
            <td>
            <div>
                <!--[if mso]>
                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="' . $URL . '" style="height:40px;v-text-anchor:middle;width:300px;" arcsize="5%" strokecolor="#ffaa00" fillcolor="#ffaa00;width: 130;">
                    <w:anchorlock/>
                    <center style="color:#ffffff;font-family:Helvetica, sans-serif;font-size:18px; font-weight: 600;"> Nieuwe Activatie Instructies </center>
                </v:roundrect>
        
                <![endif]-->
                <a href="' . $URL . '" style="display: inline-block; mso-hide:all; background-color: #ffaa00; color: #FFFFFF; border:1px solid #ffaa00; border-radius: 6px; line-height: 220%; width: 300px; font-family: Helvetica, sans-serif; font-size:14px; font-weight:600; text-align: center; text-decoration: none; -webkit-text-size-adjust:none;  " target="_blank">Nieuwe Activatie Instructies</a>
                </a>
                </div>
            </td>
        </tr>
        </table> <br><br>
              
    <p style="color:LightGrey;"><i>Werkt de bovenstaande knop niet? Plak dan de volgende link in uw browser  <a href="https://it4all.rhmhendriks.nl?page=auth&auth=RenewActivation&token=' . $token . '">https://it4all.rhmhendriks.nl?page=auth&auth=RenewActivation&token=' . $token . '</a> 


</body>
</html>
';
?>