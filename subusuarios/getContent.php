<?php
require "include/conexion.php";
session_start();
$idu=$_SESSION['ID'];
if (empty($idu)) {
	header("Location: index.html");
}

$ind=$_GET['var0'];
$cmps="placa, documento, cliente, codproducto, producto, distcliente, dircliente, fechaprog, horentrega, observacion, estado, motivo, latitud, longitud, detalle, fot_foto";
$cond="indice='".$ind."'";
$tabl="intralot.pedidos";
$query="select ".$cmps." from ".$tabl." where ".$cond." limit 1;";
$result=mysql_query($query);
$row=mysql_fetch_assoc($result);
$pla=$row['placa'];
$doc=$row['documento'];
$des=$row['cliente'];
$dni=$row['codproducto'];
$cli=$row['producto'];
$dis=$row['distcliente'];
$dir=$row['dircliente'];
$fec=$row['fechaprog'];
$hor=$row['horentrega'];
$obs=$row['observacion'];
$est=$row['estado'];
$mot=$row['motivo'];
$det=$row['detalle'];
$det=$row['fot_foto'];
$xx=$row['latitud'];
$yy=$row['longitud'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Distrack</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

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
	<div class="container">
		<div class="row">
			<div class="col-md-6"><h1>Detalles de Pedido Nro.<?php echo $doc;?></h1></div>
			<div class="col-md-6" align="right"><img src="../images/logo.png" width="15%"></div>
			
		</div>
		<div class="row">
  		<div class="col-md-6" id="map" style="width: 40vw; height: 85vh;"></div>
	  		<div class="col-md-6">
	  			<div class="row">
	  				<div class="col-md-3">Destinatario</div>
	  				<div class="col-md-9 bg-light"><p><?php echo $des;?></p></div>
	  			</div>
	  			<div class="row">
	  				<div class="col-md-3">Direccion</div>
	  				<div class="col-md-9 bg-light"><p><?php echo $dir;?></p></div>
	  			</div>
	  			<div class="row">
	  				<div class="col-md-3">Distrito</div>
	  				<div class="col-md-9 bg-light"><p><?php echo $dis;?></p></div>
	  			</div>
	  			<div class="row">
	  				<div class="col-md-3">Estado</div>
	  				<div class="col-md-9 bg-light"><p><?php echo $est." - ".$mot;?></p></div>
	  			</div>
	  			<div class="row">
	  				<div class="col-md-3">Hora</div>
	  				<div class="col-md-9 bg-light"><p><?php echo $fec." ".$hor;?></p></div>
	  			</div>
	  			<div class="row">
	  				<div class="col-md-3">Observaciones</div>
	  				<div class="col-md-9 bg-light"><p><?php echo $obs;?></p></div>
	  			</div>
	  			<div class="row">
	  				<div class="col-md-3">Imagenes</div>
	  				<div class="col-md-9" align="left">
	  				<?php
	  					$rfot=mysql_query("select ruta from appdistrack.reg_fotos where documento='".$doc."';");
	  					while ($afot=mysql_fetch_row($rfot)){
	  						echo "<img src='http://tracklogservice.com:3010/".$afot[0]."'>";
	  					}

	  				?>
	  				</div>
	  			</div>
	  			<br>
	  			<a href="consulta.php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Retornar...</a>
	  		</div>

  		</div>
  	</div>  	
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>