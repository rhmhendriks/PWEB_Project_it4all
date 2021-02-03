<!DOCTYPE html>
<html>
<head>
    <title>Eneo Home</title>
</head>
<body>
    <div id="homenotification">
    <h1>Welcome to the Eneo website</h1>
    <h2>announcements </h2>
    </div>

    <?php
        echo '<div id="homemap">';
        include "_Scripting/map/map.php";
        echo '</div>';

        echo '<div id="homegraph">';
        echo '</div>';
    ?>

</body>
</html>