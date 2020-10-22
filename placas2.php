<?php
require_once "/include/conexion.php";
include_once "Menu_Head.php";	
include "filtro.php";
$colcc='#CEECF5';
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
}
$colcc='#E0F8E6'; 
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="600"/>
<title>Estado de Repartos</title>
<head>
	<link href="style/style.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" src="script/tigra_tables.js"></script>
	<script language="JavaScript" src="script/sorttable.js"></script>
	<link type="image/x-icon" href="favicon.ico" rel="icon" />
	<link type="image/x-icon" href="favicon.ico" rel="shortcut icon" />
</head>
<body>
<form name="frmreporte" method ="post" action="placas2.php">
<A name = "INICIO"></A>
<A href = '#FIN'>Final <img src='images/sap_binocular.gif' border='0' alt='Final'></A>
<table width="95%" border="1" cellspacing="0" cellpadding="0" align="center" >
  <tr align="center"> 
    <td nowrap class="PageCaption" align="left">Estado de Reparto</td>
  </tr>
</table>
<?
//$query = "select b.numpedido,b.idpedido,b.documento,left(b.cliente,40),b.volumen,b.distcliente,b.estado,b.fecentrega,b.horentrega,b.localpedido,b.placa,b.latitud,b.longitud,ventanaini,ventanafin,b.fechaprog,b.peso from ddaryza.pedidos b,gpslog.livedata l where b.fechaprog=curdate() and b.placa=l.vehicleReg and b.placa in(select l.VehicleReg from gpslog.netusers n,gpslog.system_users s,gpslog.livedata l where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and s.ID=".$_SESSION['ID'].") order by b.placa,b.orden ";
//$query = "select b.numpedido,b.idpedido,b.documento,left(b.cliente,40),b.volumen,b.distcliente,b.estado,b.fecentrega,b.horentrega,b.localpedido,b.placa,b.latitud,b.longitud,b.ventanaini,b.ventanafin,b.fechaprog,b.peso,b.aux1,b.orden from ddaryza.pedidos b where b.fechaprog=curdate() order by b.placa,b.orden ";
$query="select l.vehiclereg from livedata l where l.vehicleactive='1' and l.vehicleid in (select n.uin from netusers n where n.netusername='pdespacho')";
$result = mysql_query($query);
if (!$result) {
	die('Error query: ' . mysql_error());
	$num_rows = mysql_num_rows($result);
	echo "$num_rows Rows\n";
}
$NO=0;
while ($row = mysql_fetch_array($result)) {
	$NO++;
	$PLACAS[$NO]		= $row[0];
}

echo "<table id='Tabla_Detalle' class='sortables' width='95%' cellpadding='2' cellspacing='1' border='0' align='center'>";
if ($NO > 0){
	for ($i=1;$i<=$NO;$i++){
		if ($i == 1){
			$TOTAL=0;
			$color='';
			echo "<tr>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>No</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Placas</td>";
			echo "</tr>";
		}
		$TOTAL=$TOTAL+$VOLUMEN[$i];
		if ($colcc == '#A9E2F3'){
			$colcc='#CEECF5';
		} else{
			$colcc = '#A9E2F3';
		}
		echo "<tr bgcolor='".$colcc."'>";
		echo "<td nowrap class='GridAttrField' align='right'>".$i."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$PLACAS[$i]."</td>";
		echo "</tr>";
		if ($i == $NO){
			echo "<table width='95%' cellpadding='2' cellspacing='1' border='1' align='center'>";
			echo "<tr>";
			echo "<td nowrap class='RecSrcGridHeader' align='left'>TOTAL DE PEDIDO(S) ($NO)</td>";
			echo "<td nowrap class='GridAttrField' align='right'><font size=4><b>".number_format($TOTAL,2,'.',',')."</b></font></td>";
			echo "</tr>";
			echo "</table>";
		}
	}
}  
?>
<script language="JavaScript" type="text/javascript">
	tigra_tables('Tabla_Detalle', 1, 0, '#ffffff', '#efefef', '#ffffcc', '#C8DCF2');
</script>
<?
echo "</table>";
?>	
<A href = '#INICIO'>Inicio <img src='images/sap_binocular.gif' border='0' alt='Inicio'></A>
<A name = "FIN"></A>
<p><a href="repartodiario.php?local=X" <?php echo 'target="_blank"';?> title="Reparto diario"><b>Reparto diario. Excel</b></a> </p>
</form>
</body>
</html>