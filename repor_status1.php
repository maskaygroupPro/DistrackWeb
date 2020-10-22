<?php
session_start();
include "filtro.php";
      if(isset($_COOKIE['z1']))
  {
  //************************************************************************
   if($_COOKIE['z1']==''){
     setcookie("x1","-12.13890443823389", time() + 3600);
              setcookie("y1","-77.0175842982178", time() + 3600);
              setcookie("z1","JAS", time() + 3600);
              setcookie("dri","JAS", time() + 3600);
              setcookie("ico","E", time() + 3600);
              setcookie("speed","0", time() + 3600);
  }
    else{
   require "include/conexion.php";
  $que ="select Current_X,Current_Y,current_heading_short,Current_Speed_Met_N from gpslog.livedata where VehicleReg='".$_COOKIE['z1']."'";
  //echo $_COOKIE['z1'];
  $res=mysql_query($que) or die("Sesion Expirada");  //die muestra el error y sale
  $gri=mysql_fetch_array($res);
  $lat=$gri[0];
  $lon=$gri[1];
  $hea=$gri[2];
  $spe=$gri[3];
  setcookie("x1",$lat, time() + 3600);
   setcookie("y1",$lon, time() + 3600);
   setcookie("ico",$hea, time() + 3600);
   setcookie("speed",$spe, time() + 3600);
   //setcookie("visitas", "1", time() + 10800);
 }
    }
 ?>
<html><head>
<meta http-equiv="refresh" content="300">
 <style type="text/css">
 </style>
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
    .estilotextarea {width:400px;height:100px;border: 2px solid #990000;}
 .estilotextarea2 {width:1012px;height:80px;border: 1px dotted #000099;}
 .estilotextarea3 {font-family: Garamond,verdana;font-size: 18pt;font-weight: bold;letter-spacing: 5px;}
 .estilotextarea4 {width:100%;height:20px;font-size:10px;background-color: transparent;border: 0px solid #000000;scrollbar-arrow-color: #000066;scrollbar-base-color: #000033;scrollbar-dark-shadow-color: #336699;scrollbar-track-color: #666633;scrollbar-fac
e-color: #cc9933;scrollbar-shadow-color: #DDDDDD;scrollbar-highlight-color: #CCCCCC;}
  </style>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.12&sensor=true&libraries=visualization"></script>
  <script type="text/javascript" src="heading.js"></script>
  <script type="text/javascript">
var map;
function attachSecretMessage(marker, num, texto) {
  var infowindow = new google.maps.InfoWindow({
    content: '<div style="text-align: center; font-size:14px;"><center><b>'+texto+'</b></center></div>'
  });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(marker.get('map'), marker);
  });
}
function load(){
  var mapOptions = {zoom: 6, center: new google.maps.LatLng(-12.1389044, -77.017584298), mapTypeId: google.maps.MapTypeId.ROADMAP};

  map = new google.maps.Map(document.getElementById('map'),mapOptions);

  if((isNaN(leerCookie("x1")==true) || isNaN(leerCookie("y1"))==true) && isNaN(leerCookie("z1"))==true) {
     mlati='-12.141839883823389';
     mlong='-77.01772212982178';
     //alert(leerCookie("z1"));
     texto="TrackLog.<br/>Dir: Av.Republica de Panama 308<br/>Urb:Balta<br/>Distrito: Barranco<br/>Tlf: ---<br/>Tlf: ----";บบ     
    }else{
    mlati=leerCookie("x1");
    mlong=leerCookie("y1");
    texto="Placa: "+ leerCookie("z1")+"<br/>Chofer: "+leerCookie("dri");
    }
    map.setCenter(new google.maps.LatLng(mlati,mlong));

	var image = 'iconos/'+'Car'+heading_to_angle_index(leerCookie("ico"))+'-'+color_icon(leerCookie('speed'))+'.png';

	  var marker = new google.maps.Marker({
			position: new google.maps.LatLng(mlati,mlong),
			map: map,
			icon: image
		});
		marker.setTitle((1).toString());
		attachSecretMessage(marker, 0, texto);  		
	}
google.maps.event.addDomListener(window, 'load', load);
       </script>
<!--------------------------------------------------------------->
<title>Reporte de Estado de Veh&iacute;culos y Localizaci&oacute;n.</title>
</head>
 <body bgcolor="#A8AAAE">
<div id="map" style="width:100%; height: 70%"></div>
<!--</a><p align=center ><font size =4><b><u>Haz doble click en una celda.</u></b></font></p> -->
 <form name="frm1">
<table width="100%"  border="1" align="left" cellpadding="1" cellspacing="0" id="tabla" >
 <tr bgcolor="#000106" class="estilo3">
<!--
<td><b><font color="white">ID</b></td>-->
  <td>N&ordm;</td>
  <td>Placa</td>
  <td>Chofer</td>
  <td>Grupo</td>
  <!--
  <td width="30">Cnx</td> -->
  <td>Fecha</td>
  <td>Hora</td>
  <td>Calle</td>
  <td>Urbanizaci&oacute;n</td>
  <td>Ciudad</td>
  <td>Evento</td>
  <td>Evento F&iacute;sico</td>
  <td>Veloc.</td>
  <td><b>Direcci&oacute;n</td>
  <td style="display:none">Latitud</td>
  <td style="display:none">Longitud</td>
 </tr>
<?php
 require "include/conexion.php";
 $query ="select l.VehicleID,l.VehicleReg,l.Driver,l.VehicleGroup,s.FullName,l.Connected,l.Current_X,l.Current_Y,l.DateNow,l.TimeNow,l.Current_Street,l.Current_Town,l.Current_County,l.Current_Event,l.IO_event,l.Current_Speed_Met_D,l.Current_Heading_Short
from netusers n,system_users s,livedata l where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and s.ID=" .$_SESSION['ID']." order by 6 desc,2";
 //echo $query;
 $result=mysql_query($query) or die("Sesion Expirada");  //die muestra el error y sale
 $contador=0;
?>
<?php while($row = mysql_fetch_array($result)) {
   if($row[5]=='0')
   {
   ?>
   <tr bgcolor="DarkRed" style="font-color:yellow" onmouseover="this.style.backgroundColor='#F2D5A2';this.style.cursor='hand';this.style.color='black';" onmouseout="this.style.backgroundColor='DarkRed';this.style.color='yellow';" class="estilo1">
   <!--
    <tr bgcolor="#EEEEE2" onMouseOver="this.style.backgroundColor='#F2D5A2';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#EEEEE2'" class="estilo1">
    -->
    <?php
    }else {
     //en estos casos es necesario pasar por alto esta advertencia
    ?>
    <tr bgcolor="green" style="font-color:white" onmouseover="this.style.backgroundColor='#F2D5A2';this.style.cursor='hand';this.style.color='black';" onmouseout="this.style.backgroundColor='green';this.style.color='white';" class="estilo2" >
    <?php
    }
    ?>
  <td><?php $contador = $contador + 1;
  echo $contador; ?></td>
 <!--
  <td><?php /* echo $row[0] */?></td>  -->
  <td><?php echo $row[1] ?></td>
  <td><?php echo HTML_filtro(ucwords(strtolower($row[2]))) ?></td>
  <td><?php echo HTML_filtro($row[3]) ?></td>
  <td><?php echo HTML_filtro($row[8]) ?></td>
  <td><?php echo HTML_filtro($row[9]) ?></td>
  <td><?php echo HTML_filtro($row[10]) ?></td>
  <td><?php echo HTML_filtro($row[11]) ?></td>
  <td><?php echo HTML_filtro($row[12]) ?></td>
  <td><?php echo HTML_filtro($row[13]) ?></td>
  <td><?php echo HTML_filtro($row[14]) ?></td>
  <td><?php echo HTML_filtro($row[15]) ?></td>
  <td><?php echo HTML_filtro($row[16]) ?></td>
  <td style="display:none"><?php echo HTML_filtro($row[6]) ?></td>
  <td style="display:none"><?php echo HTML_filtro($row[7]) ?></td>
 </tr>
<?php } ?>
</table>
 </form>
  </body>
<script type="text/javascript">
          var map;
          var mypoint;
          var mymarker;
          var MyZoomPoint;
 document.getElementById("tabla").ondblclick=function(e){
     if(!e)e=window.event;
     if(!e.target) e.target=e.srcElement;
     var TR=e.target;
     while( TR.nodeType==1 && TR.tagName.toUpperCase()!="TR" )
         TR=TR.parentNode;
     var celdas=TR.getElementsByTagName("TD");
     if( celdas.length!=0 )
         aa=celdas[1].innerHTML;
         bb=celdas[2].innerHTML;
         cc=celdas[3].innerHTML;
         dd=celdas[4].innerHTML;
         ee=celdas[5].innerHTML;
         ff=celdas[6].innerHTML;
         gg=celdas[7].innerHTML;
         hh=celdas[8].innerHTML;
         ii=celdas[9].innerHTML;
         jj=celdas[10].innerHTML;
          var kk = new String();
          kk=celdas[11].innerHTML;
          kk = kk.replace(/ Kph/g, "");
         ll=celdas[12].innerHTML;
         mm=celdas[13].innerHTML;
         nn=celdas[14].innerHTML;
         document.cookie="x1 = " + mm;
         document.cookie="y1 = " + nn;
         document.cookie="z1 = " + aa;
         document.cookie="dri = " + bb;
         document.cookie="ico = " + ll;
         document.cookie="speed = " + kk;

		map.setCenter(new google.maps.LatLng(mm,nn));
		map.setZoom(17);

	  var image = 'iconos/'+'Car'+heading_to_angle_index(leerCookie("ico"))+'-'+color_icon(leerCookie('speed'))+'.png';
					
	  var marker = new google.maps.Marker({
			position: new google.maps.LatLng(mm,nn),
			map: map,
			icon: image
		});	
		marker.setTitle((1).toString());
		attachSecretMessage(marker, 0, "Placa: "+ aa+"<br/>Driver: "+bb);
 }
window.scrollTo(0,0)
</script>
  </html>