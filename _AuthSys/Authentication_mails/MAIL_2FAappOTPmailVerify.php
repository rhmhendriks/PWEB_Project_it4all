<?php

$OTPMail = '<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IT4ALL - Verify your email address</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <p>Beste ' . $FirstName . " " . $LastName. ', <br><br>
    <p>Zojuist is het installatieprocess voor "tweevoudige verificatie" gestart. Hiermee voegt u een extra beveiligingslaag toe aan uw account. In deze mail vind een eenmalig wachtwoord welke u nodig heeft om verder te gaan.</p><br>
    <h1>Uw eenmalige identificatiecode</h1><br>
    <p>Uw unieke identificatiecode is <b>' . $identificationcode . '</b>, deze vult u in op het andere scherm. </p><br><br><br>
    <!--VML button-->
    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;"><br><br>
    <p>Met vriendelijke groet,<br>
    IT4all</p>

</body>
</html>
'
?>