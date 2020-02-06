<?php
    session_destroy();
    if (isset($_GET['breach'])){
        echo '<h1>Verdachte Activiteit detecteerd!<br></h1>';
        echo '<p> Er zijn verdachte omstandigheden gedetecteerd in de gegevens die uw browser gebruikt om zich te identificieren. Uit veiligheidoverwegingen dient u opnieuw in te loggen.</p>';
    } else {
        echo '<h1>U bent nu uitgelogd!<br></h1>';
        echo '<p>We hebben u uitgelogd! U kunt dit venster nu sluiten</p>';
    }
?>