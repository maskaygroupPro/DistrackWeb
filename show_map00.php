<?php
session_start();
$xx=$var1;
$yy=$var2;
$pla=$var3;
echo "<script language='javascript'>\n";
echo "var xx='$xx';";
echo "var yy='$yy';";
echo "var pla='$pla';";
echo "</script>\n";


?>
<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' />
<style type='text/css'>
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px }
  #map_canvas { height: 100% }

   .labels {
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: 40px;     
     border: 2px solid black;
     white-space: nowrap;
   }
</style>

<script src="markerwithlabel.js" type="text/javascript"></script>

<script type='text/javascript'>
     var latLng = new google.maps.LatLng(xx, yy);
     var homeLatLng = new google.maps.LatLng(xx, yy);

     var map = new google.maps.Map(document.getElementById('map_canvas'), {
       zoom: 12,
       center: latLng,
       mapTypeId: google.maps.MapTypeId.ROADMAP
     });

     var marker1 = new MarkerWithLabel({
       position: homeLatLng,
       draggable: true,
       raiseOnDrag: true,
       map: map,
       labelContent: pla,
       labelAnchor: new google.maps.Point(22, 0),
       labelClass: "labels", // the CSS class for the label
       labelStyle: {opacity: 0.75}
     });

     var iw1 = new google.maps.InfoWindow({
       content: "Home For Sale"
     });
     google.maps.event.addListener(marker1, "click", function (e) { iw1.open(map, this); });

</script>


</head>

<body onload="initMap()">
 <div id="map_canvas" style="height: 400px; width: 100%;"></div>
 <div id="log"></div>
</body>
</html>
