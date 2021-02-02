<!DOCTYPE html>
<html>
<head>
<!--
    autheur: Luc Willemse
    source: mapbox.com
 -->
<meta charset="utf-8" />
<title>Weather map</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<script src="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.css" rel="stylesheet" />
<style>
	body { margin: 0; padding: 0; }
	#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
</head>
<body>
<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/_init/functionlibary.php";

$json = file_get_contents('https://it4all.rhmhendriks.nl/_API/index.php?token=JUR324HVJH2RGJH34J5J2VJHB43HJEJH23H42HGR3&from=02-01-2021&til=02-02-2021&filetype=JSON&type=T&stations=649100-647000-646500-644000-644500-645000-645010');

?>
<style>
.mapboxgl-popup {
max-width: 400px;
font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
}
</style>
<div id="map"></div>
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoibHVjd2lsbGVtc2UiLCJhIjoiY2traWJkMjBlMWxpejJ1bW5pMXNtOWVxbCJ9.uR4yEcfjqlXE9w4HV1UAHg';
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [12, 6.2],
zoom: 4.8
});

var size = 200;
 
// implementation of CustomLayerInterface to draw a pulsing dot icon on the map
// see https://docs.mapbox.com/mapbox-gl-js/api/#customlayerinterface for more info
var pulsingDot = {
width: size,
height: size,
data: new Uint8Array(size * size * 4),
 
// get rendering context for the map canvas when layer is added to the map
onAdd: function () {
var canvas = document.createElement('canvas');
canvas.width = this.width;
canvas.height = this.height;
this.context = canvas.getContext('2d');
},
 
// called once before every frame where the icon will be used
render: function () {
var duration = 1000;
var t = (performance.now() % duration) / duration;
 
var radius = (size / 2) * 0.3;
var outerRadius = (size / 2) * 0.7 * t + radius;
var context = this.context;
 
// draw outer circle
context.clearRect(0, 0, this.width, this.height);
context.beginPath();
context.arc(
this.width / 2,
this.height / 2,
outerRadius,
0,
Math.PI * 2
);
context.fillStyle = 'rgba(255, 200, 200,' + (1 - t) + ')';
context.fill();
 
// draw inner circle
context.beginPath();
context.arc(
this.width / 2,
this.height / 2,
radius,
0,
Math.PI * 2
);
context.fillStyle = 'rgba(255, 100, 100, 1)';
context.strokeStyle = 'white';
context.lineWidth = 2 + 4 * (1 - t);
context.fill();
context.stroke();
 
// update this image's data with data from the canvas
this.data = context.getImageData(
0,
0,
this.width,
this.height
).data;
 
// continuously repaint the map, resulting in the smooth animation of the dot
map.triggerRepaint();
 
// return `true` to let the map know that the image was updated
return true;
}
};
 
map.on('load', function () {
map.addSource('places', {
    'type': 'geojson',
'data': {
'type': 'FeatureCollection',
'features': [
{
'type': 'Feature',
'properties': {
'description' : <?php   echo "'<strong>Weather station</strong><p>Cameroon</p>";
                        echo '<p>' . calculator($jsonCameroon)[2] . '</p>' . "',"; ?>
//'description': '<strong>Weather station</strong><p>Cameroon</p>',
'icon': 'communications-tower'
},
'geometry': {
'type': 'Point',
'coordinates': [9.733, 4]
}
},
{
'type': 'Feature',
'properties': {
'description' : <?php   echo "'<strong>Weather station</strong><p>Cameroon</p>'";
                        echo "'" . '<p>' . calculator($jsonCameroon)[2] . '</p>' . "',"; ?>
'icon': 'communications-tower'

},
'geometry': {
'type': 'Point',
'coordinates': [15.033, 12.133]
}
},
{
'type': 'Feature',
'properties': {
'description' : <?php   echo "'<strong>Weather station</strong><p>Cameroon</p>'";
                        echo "'" . '<p>' . calculator($jsonCameroon)[2] . '</p>' . "',"; ?>
'icon': 'communications-tower'
},
'geometry': {
'type': 'Point',
'coordinates': [18.517, 4.4]
}
},
{
'type': 'Feature',
'properties': {
'description' : <?php   echo "'<strong>Weather station</strong><p>Cameroon</p>'";
                        echo "'" . '<p>' . calculator($jsonCameroon)[2] . '</p>' . "',"; ?>
'icon': 'communications-tower'
},
'geometry': {
'type': 'Point',
'coordinates': [11.9, -4.817]
}
},
{
'type': 'Feature',
'properties': {
'description' : <?php   echo "'<strong>Weather station</strong><p>Cameroon</p>'";
                        echo "'" . '<p>' . calculator($jsonCameroon)[2] . '</p>' . "',"; ?>
'icon': 'communications-tower'
},
'geometry': {
'type': 'Point',
'coordinates': [15.25, -4.25]
}
},
{
'type': 'Feature',
'properties': {
'description' : <?php   echo "'<strong>Weather station</strong><p>Cameroon</p>'";
                        echo "'" . '<p>' . calculator($jsonCameroon)[2] . '</p>' . "',"; ?>
'icon': 'communications-tower'
},
'geometry': {
'type': 'Point',
'coordinates': [9.417, 0.45]
}
},
{
'type': 'Feature',
'properties': {
'description' : <?php   echo "'<strong>Weather station</strong><p>Cameroon</p>'";
                        echo "'" . '<p>' . calculator($jsonCameroon)[2] . '</p>' . "',"; ?>
'icon': 'communications-tower'
},
'geometry': {
'type': 'Point',
'coordinates': [8.75, -0.7]
}
}
]
}
});
// Add a layer showing the places.
map.addLayer({
'id': 'places',
'type': 'symbol',
'source': 'places',
'layout': {
'icon-image': '{icon}-15',
'icon-allow-overlap': true,
'icon-size': 2
}
});

 
// When a click event occurs on a feature in the places layer, open a popup at the
// location of the feature, with description HTML from its properties.
map.on('click', 'places', function (e) {
var coordinates = e.features[0].geometry.coordinates.slice();
var description = e.features[0].properties.description;
 
// Ensure that if the map is zoomed out such that multiple
// copies of the feature are visible, the popup appears
// over the copy being pointed to.
while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
}
 
new mapboxgl.Popup()
.setLngLat(coordinates)
.setHTML(description)
.addTo(map);
});
 
// Change the cursor to a pointer when the mouse is over the places layer.
map.on('mouseenter', 'places', function () {
map.getCanvas().style.cursor = 'pointer';
});
 
// Change it back to a pointer when it leaves.
map.on('mouseleave', 'places', function () {
map.getCanvas().style.cursor = '';
});
});
map.addControl(new mapboxgl.NavigationControl());
</script>
 
</body>
</html>