<?php
session_start();
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
} 
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
</style>
<script src="markerwithlabel.js" type="text/javascript"></script>
<style type="text/css">
    div.markerTooltip, div.markerDetail
    {
     color: black;
     font-size: 0.7em;
     font-weight: bold;
     background-color: yellow ;
     white-space: nowrap;
     margin: 0;
     padding: 1px 2px;
     border: 1px solid black;
    }
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
<script type='text/javascript'
    src='http://maps.google.com/maps/api/js?sensor=true'>
</script>
<script type='text/javascript'>
  function initialize() {
    var mylatlng = new google.maps.LatLng(xx,yy);
    var myOptions = {
      zoom: 15,
      center: mylatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
    var image = 'icons/XTruck.gif';
    var mylatlng = new google.maps.LatLng(xx,yy);
    var beachMarker = new google.maps.Marker({
    position: mylatlng,
    map: map,
    icon: image
    });
  }
</script>

<script type="text/javascript">
	//MENSAJE DE DERECHOS RESERVADOS
	var message="Derechos Reservados©";
	///////////////////////////////////
	function clickIE4(){
		if (event.button==2){
		alert(message);
		return false;
		}
	}

	function clickNS4(e){
		if (document.layers||document.getElementById&&!document.all){
			if (e.which==2||e.which==3){
				alert(message);
				return false;
			}
		}
	}

	if (document.layers){
	document.captureEvents(Event.MOUSEDOWN);
	document.onmousedown=clickNS4;
	}
	else if (document.all&&!document.getElementById){
	document.onmousedown=clickIE4;
	}

	document.oncontextmenu=new Function("alert(message);return false")

       //<![CDATA[
          var map;
          var mypoint;
          var mymarker;
          var MyZoomPoint;

            function load()
            {
               if (GBrowserIsCompatible())
                 {
                  var map = new GMap2(document.getElementById("map"));
				var customUI = map.getDefaultUI();;
      		map.setUI(customUI);
			//map.addControl(new GOverviewMapControl());
                   MapCentrePoint = new map.getCenter();
                   MapZoomLevel   = new map.getZoom();
                  mypoint = new GLatLng(parseFloat(xx),parseFloat(yy));
                map.setCenter(mypoint, 1,G_NORMAL_MAP);                  GEvent.addListener(map, "click", function(overlay,point) {;
                  document.title = "Mouse_Click" + point;
                  });
                    mypoint = new GLatLng(xx,yy);
                    var icon = new GIcon();
                    icon.image = "icons/XTruck.gif";
                    icon.iconSize = new GSize(32,32);
                    icon.shadowSize = new GSize(22, 20);
                    icon.iconAnchor = new GPoint(6, 20);
                    icon.infoWindowAnchor = new GPoint(1, 1);
                    //------------------------
                     Zoompoint = new GLatLng(parseFloat(xx),parseFloat(yy));
                     map.setCenter(Zoompoint, 16);

                   var mymarker = new MarkerWithLabel({
                    position: mylatlng;
                    draggable: true;
                    raiseOnDrag: true;
                    map: map;
                    labelContent: pla;
                    labelAnchor: new google.maps.Point(22, 0);
                    labelClass: "labels"; // the CSS class for the label
                    labelStyle: {opacity: 0.75}
     });

                   }
              }
      </script>

</head>
<body onload='initialize()' > 
  <div id='map_canvas' style='width:100%; height:100%'></div>
</body>
</html>
