<?php
session_start();
include "filtro.php";
      if(isset($_COOKIE['z1']))
  {
  //************************************************************************
   if($_COOKIE['z1']==''){
     setcookie("x1","-12.141839883823389", time() + 3600);
              setcookie("y1","-77.01772212982178", time() + 3600);
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
<!---------------------------------------------------------------------->
 <style type="text/css">
 <!--
 .estilo1 {font-size:11px;color:yellow}
 .estilo2 {font-size:11px;color:white;}
 .estilo3 {font-size:11px;color:white;font-weight:bold;}
 th {
 background-color:#CC0000;
 text-align:center;
 }
 strong {font-weight:bold;}
 -->
 </style>
<!---------------------------------------------------------------------->
<!--------------------------------------------------------------->
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
  <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAHfg5t0Iq2bsXVWCiRotSwBSm55dQmkfFIILUxMK4zyp2khGLPBSOR9X7q2snaG1fyu3vo1wiz3m6wA" type="text/javascript"></script>
    <script type="text/javascript" src="pdmarker.js"></script>
    <script type="text/javascript" src="heading.js"></script>
  <script type="text/javascript">
       //<![CDATA[
          var map;
//alert(color_icon(81));
          var mypoint;
          var mymarker;
          var MyZoomPoint;
            function load()
            {
               if (GBrowserIsCompatible())
                 {
                  var map = new GMap2(document.getElementById("map"));
  map.addControl(new GLargeMapControl());
       //map.addControl(new GSmallMapControl());
       //map.addControl(new GSmallZoomControl());
       map.addControl(new GScaleControl());
       map.addControl(new GMapTypeControl());
       //map.addControl(new GHierarchicalMapTypeControl());
       map.addControl(new GOverviewMapControl());
         if((isNaN(leerCookie("x1")==true) || isNaN(leerCookie("y1"))==true) && isNaN(leerCookie("z1"))==true) {
     jaime='-12.141839883823389';
     maribel='-77.01772212982178';
     //alert(leerCookie("z1"));
     texto="TrackLog.<br/>Dir: Av. Republica de Panama 308<br/>Urb: Balta<br/>Dis: Barranco<br/>Tlf: ---<br/>Tlf: ----";
    }else{
    jaime=leerCookie("x1");
    maribel=leerCookie("y1");
    texto="Placa: "+ leerCookie("z1")+"<br/>Chofer: "+leerCookie("dri");
    }
//alert(leerCookie("x1"));
                   MapCentrePoint = new map.getCenter();
                   MapZoomLevel   = new map.getZoom();
                  mypoint = new GLatLng(jaime,maribel);
                map.setCenter(mypoint, 1,G_HYBRID_MAP);                  GEvent.addListener(map, "click", function(overlay,point) {;
                  document.title = "Mouse_Click" + point;
                  });
                    mypoint = new GLatLng(jaime,maribel);
                    var icon = new GIcon();
                    //icon.image = "1.jpg";
                    icon.image = 'iconos/'+'Car'+heading_to_angle_index(leerCookie("ico"))+'-'+color_icon(leerCookie('speed'))+'.png';

                    icon.iconSize = new GSize(32,32);
                    icon.shadowSize = new GSize(22, 20);
                    icon.iconAnchor = new GPoint(6, 20);
                    icon.infoWindowAnchor = new GPoint(1, 1);
                    mymarker = new PdMarker(mypoint,icon);
                    mymarker.setId(648);
                    map.addOverlay(mymarker);
     //------------------------
                    mymarker.setTooltip(texto);
                    mymarker.showTooltip();
                     Zoompoint = new GLatLng(jaime,maribel);
                     map.setCenter(Zoompoint, 17);
                     //map.zoomToMarkers();
                   }
              }
              //]]>
       </script>
<!--------------------------------------------------------------->
<title>Reporte de Estado de Veh&iacute;culos y Localizaci&oacute;n.</title>
</head>
 <body onload="load()" onunload="GUnload()" bgcolor="#A8AAAE">
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

                   var map = new GMap2(document.getElementById("map"));
                   map.addControl(new GLargeMapControl());
                   map.addControl(new GMapTypeControl());

                    MapCentrePoint = new map.getCenter();
                    MapZoomLevel   = new map.getZoom();
                    mypoint = new GLatLng(mm,nn);
                   map.setCenter(mypoint, 1,G_HYBRID_MAP);                  GEvent.addListener(map, "click", function(overlay,point) {;
                   document.title ='Localizacion de Vehiculos';
                   });
                     var icon = new GIcon();
                     icon.image = 'iconos/'+'Car'+heading_to_angle_index(leerCookie("ico"))+'-'+color_icon(leerCookie('speed'))+'.png';

                     icon.iconSize = new GSize(32, 32);
                     icon.shadowSize = new GSize(22, 20);
                     icon.iconAnchor = new GPoint(6, 20);
                     icon.infoWindowAnchor = new GPoint(1, 1);
                     mymarker = new PdMarker(mypoint,icon);
                     mymarker.setId(648);
                     map.addOverlay(mymarker);
      mymarker.setTooltip("Placa: "+aa+"<br/>Driver: "+bb);
                     mymarker.showTooltip();

                     Zoompoint = new GLatLng(mm,nn);
                      map.setCenter(Zoompoint, 17);
 }
window.scrollTo(0,0)

</script>
  </html>
