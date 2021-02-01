<?php
 if (!$_SESSION['loggedin'] == 1|| !$_SESSION['IsAdmin'] == 1){
    header("location:index.php?page=auth&auth=AdminNoAccess");
} else {
	echo '
	<h1 class="formovertitle">Formulieren en overzichten</h1>
    <div id="eneoadminlist">
        <div id="formslist">
            <h2>Forms</h2>
            <a href="https://it4all.rhmhendriks.nl/index.php?inc=y">Whitelist an IP address</a>
            <a href="https://it4all.rhmhendriks.nl/index.php?inc=y">Check if an IP address is in use</a>
            <a href="https://it4all.rhmhendriks.nl/index.php?inc=y">Retrieve the API URL</a>
            </div>
        <div id="tablelist">
            <h2>Tables</h2>
            <a href="https://it4all.rhmhendriks.nl/index.php?inc=y">Table</a>
        </div>
    </div>';
}
?>