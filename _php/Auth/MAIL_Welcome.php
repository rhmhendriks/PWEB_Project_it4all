<?php

$WelMail = '<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IT4ALL - Welkom op onze site!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        -webkit-transition-duration: 0.4s; /* Safari */
        transition-duration: 0.4s;
        cursor: pointer;
        }

        .button {
        background-color: white; 
        color: black; 
        border: 2px solid #395381;
        }

        .button:hover {
        background-color: #395381;
        color: white;
        }
    </style>
</head>
<body>
    <p>Beste ' . $FirstName . " " . $LastName. ', <br><br>
    <p>Onlangs heeft u uw account op onze website geactiveerd! Bedankt! <br> Met deze mail bevestigen wij je registratie, je kun tnu inloggen op onze site en bestellingen plaatsten of het besloten tip en trick collectie inzien!</p><br>
    <br><br>
    <p> Met vriendelijke groet, <br><br> IT4ALL webmaster
</body>
</html>
'
?>