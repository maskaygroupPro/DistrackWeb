<?php
session_start();
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
} 

header("Content-type: application/vnd.ms-excel"); //para sugerir abrir con excel
header("Content-Disposition: attachment; filename=repartodiario.xls");

require "include/conexion.php";

$local = $_POST['tipo'];
$hastaAux = $_POST['hasta'];
$desdeAux = $_POST['desde'];



$tabla="<table width=800 border=1 align=center cellpadding=1 cellspacing=1>";
$tabla.="<tr><td colspan=13 align=center><font color=Navy><u><b>Despachos Programados</b></u></font></td></tr>";
$tabla.="<tr>";
$tabla.="<td bgcolor=blue><b><font color=white>Ord</b></td>";//1
$tabla.="<td bgcolor=blue><b><font color=white>Agente</b></td>";//4
$tabla.="<td bgcolor=blue><b><font color=white>Nombre</b></td>";//6
$tabla.="<td bgcolor=blue><b><font color=white>Tipo de Reparto</b></td>";//18
//zona
$tabla.="<td bgcolor=blue><b><font color=white>Distrito</b></td>";//9
$tabla.="<td bgcolor=blue><b><font color=white>Hora</b></td>";//12
$tabla.="<td bgcolor=blue><b><font color=white>Estado</b></td>";//10
$tabla.="<td bgcolor=blue><b><font color=white>Placa</b></td>";//2
//$tabla.="<td bgcolor=blue><b><font color=white>Ord.Compra</b></td>";//3
$tabla.="<td bgcolor=blue><b><font color=white>N° guia</b></td>";//5
//$tabla.="<td bgcolor=blue><b><font color=white>Sucursal</b></td>";//7
//$tabla.="<td bgcolor=blue><b><font color=white>Cliente</b></td>";//8
//$tabla.="<td bgcolor=blue><b><font color=white>Horario</b></td>";//11
//$tabla.="<td bgcolor=blue><b><font color=white>Peso</b></td>";//13
$tabla.="<td bgcolor=blue><b><font color=white>Direccion</b></td>";//14
//$tabla.="<td bgcolor=blue><b><font color=white> </b></td>";//15
$tabla.="<td bgcolor=blue><b><font color=white>Consumibles</b></td>";//16
$tabla.="<td bgcolor=blue><b><font color=white>Logisticos</b></td>";//17
$tabla.="<td bgcolor=blue><b><font color=white>Instantaneas</b></td>";//18


$tabla.="<td bgcolor=blue></td>";//15

$tabla.="</tr>";
//******************************************
$and_historico="";

#$hastaF = $_GET["hasta"];


	echo "<script>console.log('Debug Objects: " . "DONDE ESTOY?" . "' );</script>";
	$query="call intralot.ObtenerReporteMateriales('2020-10-14','2020-10-14')";
    

$result=mysql_query($query) or die(mysql_error());  //die muestra el error y sale

$NO=0;

	while($row = mysql_fetch_array($result)) {  
		$NO++;
			$NO++;
			$TERMINAL   = $row[0];
			$FECHAENTRE = $row[1];
			$PLACA   	= $row[2];
			$TIPO	    = ucwords($row[3]);
			$CODIGO		= $row[4];

			$DESCRIPCIO	= ucwords($row[5]);
			$CANTIDAD	= $row[6];
			$CASO		= $row[7];
			$JUEGO		= $row[8];
			$LIBRO		= $row[9];
			$ORDEN		= $row[10];
			
			


		$tabla.="<tr>";
		$tabla.="<td>".$TERMINAL."</td>";//1
		$tabla.="<td>".$FECHAENTRE."</td>";//4
		$tabla.="<td>".$PLACA."</td>";//6
		$tabla.="<td>".$TIPO."</td>";//20

		$tabla.="<td>".$CODIGO."</td>";//9
		$tabla.="<td>".$DESCRIPCIO."</td>";//12
		$tabla.="<td>".$CANTIDAD."</td>";//10
		$tabla.="<td>".$CASO."</td>";//2
		$tabla.="<td>".$JUEGO."</td>";//5
		$tabla.="<td>".$LIBRO."</td>";//14
		$tabla.="<td>".$ORDEN."</td>";//17
		
		$tabla.="</tr>";//16
		
	}


$tabla.="</table>";

echo $tabla;
?>