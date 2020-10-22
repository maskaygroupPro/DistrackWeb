<?php
session_start();
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
}
$sesion=$_SESSION['ID'];
$desde="'$vdesde'";
$hasta="'$vhasta'";
header("Content-type: application/vnd.ms-excel"); //para sugerir abrir con excel
header("Content-Disposition: attachment; filename=repartohistorico.xls");
require "include/conexion.php";
$tabla="<table width=800 border=1 align=center cellpadding=1 cellspacing=1>";
$tabla.="<tr><td colspan=14 align=center><font color=Black><u><b>Reparto Histórico  ".$desde." - ".$hasta."</b></u></font></td></tr>";
$tabla.="<tr>";
$tabla.="<td bgcolor=blue><b><font color=white>No</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Pedido</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>ID</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>N° Guía</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Cliente</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Volumen</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Distrito</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Estado</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Fecha</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Bloque de atención</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>H.Entrega</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Tienda</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Placa</b></td>";
$tabla.="</tr>";
$and_historico="";
if ($local =='historico')
{
	$sesion=$_SESSION['ID'];
	$and_pedido="";
	if ( !empty($vpedido) ){
		$and_pedido=" and numpedido like '%$vpedido%' ";
	}
	$and_guia="";
	if ( !empty($vguia) ){
		$and_guia=" and documento like '%$vguia%' ";
	}
	$and_placa="";
	if ( !empty($vplaca) ){
		$and_placa=" and placa like '%$vplaca%' ";
	}
	$and_estado="'";
	if ( !empty($vestado) ){
		$and_estado="' and estado='$vestado' ";	
	}
	$and_distrito="";
	if ( !empty($vdistrito) ){
		$and_distrito=" and distcliente= '$vdistrito' ";	
	}
	$and_sucursal="";
	if ( !empty($vsucursal) ){
		$and_sucursal=" and cliente= '$vsucursal' ";	
	}
}
$and_saga="";
if ($local =='saga'){
	$and_saga=" and b.producto='Saga' ";
}
$and_ripley="";
if ($local =='ripley'){
	$and_ripley=" and b.producto='Ripley' ";
}
$and_rizzoli="";
if ($local =='rizzoli'){
	$and_rizzoli=" and b.producto='Rizzoli' ";
}
$and_varios="";
if ($local =='varios'){
	$and_varios=" and b.producto not in('Saga','Ripley','Rizzoli') ";
}
$hst=date("Y-m-d",strtotime($hasta));
$dsd=date("Y-m-d",strtotime($desde));
$query= "select p.numpedido,p.idpedido,p.documento,left(p.cliente,36),p.volumen,p.distcliente,p.estado,p.fechaprog,p.horentrega,p.localpedido,p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fecentrega from ddaryza.pedidos p where date(p.fechaprog) between '".$dsd."' and '".$hst.$and_estado.$and_distrito.$and_sucursal.$and_pedido.$and_placa.$and_guia." order by p.fechaprog desc";

//$query=" '$vquery' ";
//echo $query;
//echo $desde."-".$hasta;
$result=mysql_query($query) or die(mysql_error());  //die muestra el error y sale
$NO=0;
while($row = mysql_fetch_array($result)) {  
	$NO++;
	$PEDIDO		= $row[0];
	$ID			= $row[1];
	$NROGUIA		= $row[2];
	$CLIENTE		= ucwords($row[3]);
	$VOLUMEN		= $row[4];
	$DISTRITO		= ucwords($row[5]);
	$ESTADO		= ucwords($row[6]);
	$FECHA			= $row[7];
	$VATFINAL		= $row[8];
	$HORA3			= strtotime($row[8]);
	$SUCURSAL		= ucwords($row[9]);
	$UNIDAD		= $row[10];
	$READX			= $row[11];
	$READY			= $row[12];
	$VHINICIO		= $row[13];
	$VHFINAL		= $row[14];
	$HORA1			= strtotime($row[13]);
	$HORA2			= strtotime($row[14]);

	$tabla.="<tr>";
	$tabla.="<td>".$NO."</td>";
	$tabla.="<td>".$PEDIDO."</td>";
	$tabla.="<td>".$ID."</td><td>".$NROGUIA."</td>";
	$tabla.="<td>".$CLIENTE."</td>";
	$tabla.="<td>".$VOLUMEN."</td>";
	$tabla.="<td>".$DISTRITO."</td>";
	$tabla.="<td>".$ESTADO."</td>";
	$tabla.="<td>".$FECHA."</td>";
	$tabla.="<td>".$VHINICIO." - ".$VHFINAL."</td>";
	$tabla.="<td>".$HORA3."</td>";
	$tabla.="<td>".$SUCURSAL."</td>";
	$tabla.="<td>".$UNIDAD."</td>";
	$tabla.="</tr>";

}
$tabla.="</table>";
echo $tabla;
?>