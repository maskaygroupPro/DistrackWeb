<?php
require_once "/include/conexion.php";
include_once "Menu_Head.php";	
include "filtro.php";
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
}
if ($submit == "Z"){
	$pedido='';
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="600"/>
<title>SAGA</title>
<head>
	<link href="style/style.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" src="script/tigra_tables.js"></script>
	<script language="JavaScript" src="script/sorttable.js"></script>
</head>
<?
$sesion=$_SESSION['ID'];
$and_pedido="";
if ( !empty($pedido) ){
	$and_pedido=" and pedido like '%$pedido%' ";
}
$query = "select b.pedido,b.id,b.guia,left(b.cliente,40),b.volumen,b.distrito,b.estado,b.fentrega,b.vatfinal,b.sucursal,b.unidad,b.read_x,b.read_y,vhinicio,vhfinal from paraiso.maestropedidos b where b.unidad in(select l.VehicleReg from gpslog.livedata l,gpslog.system_users s,gpslog.netusers n where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and s.ID=".$sesion.") ".$and_pedido." and b.producto not in('Saga','Ripley','Rizzoli') limit 300;";
$result = mysql_query($query);
if (!$result) {
	die('Error query: ' . mysql_error());
	$num_rows = mysql_num_rows($result);
	echo "$num_rows Rows\n";
}
$NO=0;
while ($row = mysql_fetch_array($result)) {
	$NO++;
	$PEDIDO[$NO]		= $row[0];
	$ID[$NO]					= $row[1];
	$NROGUIA[$NO]		= $row[2];
	$CLIENTE[$NO]		= ucwords($row[3]);
	$VOLUMEN[$NO]		= $row[4];
	$DISTRIT0[$NO]		= ucwords($row[5]);
	$ESTADO[$NO]		= ucwords($row[6]);
	$FECHA[$NO]			= $row[7];
	$VATFINAL[$NO]		= $row[8];
	$HORA3[$NO]			= strtotime($row[8]);
	$SUCURSAL[$NO]	= ucwords($row[9]);
	$UNIDAD[$NO]			= $row[10];
	$READX[$NO]			= $row[11];
	$READY[$NO]			= $row[12];
	$VHINICIO[$NO]		= $row[13];
	$VHFINAL[$NO]		= $row[14];
	$HORA1[$NO]			= strtotime($row[13]);
	$HORA2[$NO]			= strtotime($row[14]);
}
?>
<form name="frmreporte" method ="post" action="varios.php">
<A name = "INICIO"></A>
<A href = '#FIN'>Final <img src='images/sap_binocular.gif' border='0' alt='Final'></A>
<table width="95%" border="1" cellspacing="0" cellpadding="0" align="center" >
  <tr align="center"> 
    <td nowrap class="PageCaption" align="left" colspan=4>Varios - Estado de Repartos</td>
  </tr>
<?
echo "<tr>";
echo "<td align='left'><b>Pedido :</b>&nbsp;<input type='text' class='AttrField' id='pedido' name='pedido' title='Ingrese el numero del Pedido' value='".$pedido."'  maxlength='11' size='14' onKeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'></td>";
//echo "<td align='left'><b>Guia :</b>&nbsp;<input type='text' class='AttrField' id='guia' name='guia' title='Ingrese el numero de guia' value='".$guia."' maxlength='15'  size='17'></td>";
//echo "<td align='left'><b>Placa :</b>&nbsp;<input type='text' class='AttrField' id='placa' name='placa' title='Ingrese placa' value='".$placa."' maxlength='7'  size='10'> </td>";
echo "<td align='left'><input style='color:white;font-weight:bold;background : #0000A0;font-size:10' type='submit' name='submit' value='Filtrar'></td>";
echo "</tr>";
?>  
</table>
<?
echo "<table id='Tabla_Detalle' class='sortables' width='95%' cellpadding='2' cellspacing='1' border='1' align='center'>";
if ($NO > 0){
	for ($i=1;$i<=$NO;$i++){
		if ($i == 1){
			$TOTAL=0;
			$color='';
			echo "<tr>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>No</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Pedido</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>ID</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Nº Guia</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Cliente</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Distrito</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Estado</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Fecha</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>B.Atención</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>H.Entrega</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Tienda</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Placa</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Mapa</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Volumen</td>";
			echo "</tr>";
		}
		$TOTAL=$TOTAL+$VOLUMEN[$i];
		echo "<tr>";
		echo "<td nowrap class='GridAttrField' align='right'>".$i."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$PEDIDO[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$ID[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$NROGUIA[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$CLIENTE[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$DISTRIT0[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$ESTADO[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$FECHA[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$VHINICIO[$i]."-".$VHFINAL[$i]."</td>";
		if ($HORA3[$i]>$HORA1[$i] && $HORA3[$i]<$HORA2[$i]){
			$colorea="blue";
		} else {
			if($HORA3[$i]<$HORA1[$i]){
				$colorea="green";
			} else {
				$colorea="red";
			}
		}
		echo "<td nowrap class='GridAttrField' align='center'><font color='$colorea'><b>".$VATFINAL[$i]."</b></font></td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$SUCURSAL[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$UNIDAD[$i]."</td>";
		if (	$READX[$i]	<> '' && $READY[$i]	<> '' ){
			echo "<td nowrap class='GridAttrField'  align='center'>";
			$Ubic = "alarm_map.php?var1=".HTML_filtro($READX[$i])."&var2=".HTML_filtro($READY[$i])."&var3=".HTML_filtro($NROGUIA[$i])." / ".HTML_filtro($PEDIDO[$i]);
			echo " <a HREF=\""."javascript:void(window.open('".$Ubic."&dummy=.pdf','_blank', 'scrollbars=yes,toolbar=no,resizable=yes,menubar=no,location=no'))\"".">Ver</a>";
			echo "</td>";
		} else {
			echo "<td nowrap class='GridAttrField'  align='center'></td>";
		}
		echo "<td nowrap class='GridAttrField' align='right'>".$VOLUMEN[$i]."</td>";		
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
}  else {
	echo "<table width='95%' cellpadding='2' cellspacing='1' border='1' align='center'>";
	echo "<tr>";
	echo "<td nowrap class='RecSrcGridHeader' align='center'>NO EXISTEN REGISTRO QUE CUMPLAN LA CONDICION !!!</td>";
	echo "</tr>";
	echo "</table>";
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
<p><a href="repartodiario.php?local=varios" <?php echo 'target="_blank"';?> title="Reparto diario"><b>Reparto diario. Excel</b></a> | <a href="repartohistorico.php?local=varios" <?php echo 'target="_blank"';?> title="Reparto hist&oacute;rico"><b>Reparto hist&oacute;rico. Excel</b></a> | <!--a href="http://190.12.73.84/localiza" <?php echo 'target="_blank"';?> title="Ubicaci&oacute;n de Veh&iacute;culos Google Maps"><b>Localizaci&oacute;n 2</b></a> | <a href="http://190.12.73.84/bb" <?php echo 'target="_blank"';?> title="Ubicaci&oacute;n de Veh&iacute;culos Blackberry"><b>Versi&oacute;n para Blackberry</b></a--></p>
</form>
</body>
</html>
