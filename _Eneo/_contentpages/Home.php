<div id="homenotification">
    <h1>Welcome to the Eneo website</h1>
    <h2>announcements </h2>
</div>

<?php
require "_Scripting/map/mapHead.php";
echo '<div id="homemap">';
echo '<div id="map"></div>';
echo '</div>';

echo '<div id="homegraph">';
echo '</div>';
require "_Scripting/map/script.php";
?>