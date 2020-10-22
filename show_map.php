<?php
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
} 
$xx=$var1;
$yy=$var2;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Distrack</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
	<script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
  <script>
/* OSM & OL example code provided by https://mediarealm.com.au/ */


var map;
var mapLat=<?php echo $xx?>;
var mapLng=<?php echo $yy?>;
var mapDefaultZoom = 19;


function initialize_map() {
map = new ol.Map({
target: "map",
layers: [
new ol.layer.Tile({
source: new ol.source.OSM({
url: "http://a.tile.openstreetmap.org/{z}/{x}/{y}.png"
})
})
],
view: new ol.View({
center: ol.proj.fromLonLat([mapLng, mapLat]),
zoom: mapDefaultZoom
})
});
}

function add_map_point(lat, lng) {
var vectorLayer = new ol.layer.Vector({
source:new ol.source.Vector({
features: [new ol.Feature({
geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lng), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
})]
}),
style: new ol.style.Style({
name : "Test",
image: new ol.style.Icon({
anchor: [0.8, 0.8],

anchorXUnits: "fraction",
anchorYUnits: "fraction",
src: "http://190.12.73.86/ddaryza/icons/ent.png"
})
})
});
map.addLayer(vectorLayer);
}
  </script>
</head>
<body onload="initialize_map(); add_map_point(<?php echo $xx ?>, <?php echo $yy ?>);">
  <div id="map" style="width: 100vw; height: 100vh;"></div>
</body>
</html>