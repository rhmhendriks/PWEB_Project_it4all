<?php
$URL = "https://it4all.rhmhendriks.nl?page=auth&auth=verify&token=" . $token;
$VerMail = '<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IT4ALL - Verify your email address</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <p>Beste ' . $FirstName . " " . $LastName. ', <br><br>
    <p>Onlangs heeft geprobeerd om uw account bij ons te activeren of in te loggen, maar dit is echter niet gelukt. Met deze mail sturen wij u een nieuwe activatiecode zodat u het nogmaals kunt proberen. <br> Lukt het ook met de nieuwe code niet? Reageer dan op deze mail, wij staan voor u klaar! <br><br> Het kan ook zijn dat u deze mail ontvangt omdat uw account nog niet was geactiveerd toen u probeerde in te loggen, ook in dit geval kunt u de stapenm hieronder volgen om het account te activeren.</p><br>
    <h1>Mail en Account activeren</h1><br>
    <p>Uw unieke activatiecode is <b>' . $ActivationCode . '</b>, u heeft deze nodig om een wachtwoord te kunnen aanmaken. </p><br><br><br>
    <!--VML button-->
        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
        <tr>
            <td>
            <div>
                <!--[if mso]>
                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="' . $URL . '" style="height:40px;v-text-anchor:middle;width:300px;" arcsize="5%" strokecolor="#ffaa00" fillcolor="#ffaa00;width: 130;">
                    <w:anchorlock/>
                    <center style="color:#ffffff;font-family:Helvetica, sans-serif;font-size:18px; font-weight: 600;"> E-Mail Verifieren </center>
                </v:roundrect>
        
                <![endif]-->
                <a href="' . $URL . '" style="display: inline-block; mso-hide:all; background-color: #ffaa00; color: #FFFFFF; border:1px solid #ffaa00; border-radius: 6px; line-height: 220%; width: 300px; font-family: Helvetica, sans-serif; font-size:14px; font-weight:600; text-align: center; text-decoration: none; -webkit-text-size-adjust:none;  " target="_blank">E-Mail Verifieren</a>
                </a>
                </div>
            </td>
        </tr>
        </table> <br><br><br><br>
    <p style="color:LightGrey;"><i>Werkt de bovenstaande knop niet? Plak dan de volgende link in uw browser  <a href="https://it4all.rhmhendriks.nl?page=auth&auth=verify&token=' . $token . '">https://it4all.rhmhendriks.nl?page=auth&auth=verify&token=' . $token . '</a> 


</body>
</html>
'
?>