<?php
require_once "include/conexion.php";
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
<?
$query = "select b.numpedido,b.idpedido,b.documento,left(b.cliente,30),b.volumen,left(b.distcliente,15),b.estado,b.fecentrega,b.horentrega,left(b.localpedido,25),b.placa,b.latitud,b.longitud,b.ventanaini,b.ventanafin,b.fechaprog,b.peso,b.aux1,b.orden,b.aux3,b.aux1,left(b.dircliente,30),left(b.refcliente,25),b.aux4 from ddaryza.pedidos b where b.fechaprog=current_date order by b.placa,b.orden; ";
$result = mysql_query($query);
if (!$result) {
	die('Error query: ' . mysql_error());
	$num_rows = mysql_num_rows($result);
	echo "$num_rows Rows\n";
}
$TCANT=mysql_num_rows($result); 
$NO=0;
$qry = "select b.estado from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado<>'En Ruta'";
$rst = mysql_query($qry);
if (!$rst) {
	die('Error query: ' . mysql_error());
	$num_row = mysql_num_rows($rst);
	echo "$num_row Rows\n";
}
$TLECT=mysql_num_rows($rst); 
echo "<table width='95%' border='0' cellspacing='0' cellpadding='4' align='center' >";
echo "<tr align='center'>";
echo "<td nowrap class='RecSrcGridHeaderLLSort0' align='left'>.::  Reparto de Hoy | ".date('d-m-Y')." |</td>";
echo "<td nowrap class='RecSrcGridHeaderLLSort0' align='right'>".$TLECT." Lecturas de ".$TCANT." Items</td>";
echo "</tr>";
echo "</table>";
while ($row = mysql_fetch_array($result)) {
	$NO++;
	$PEDIDO[$NO]		= $row[0];
	$ID[$NO]			= $row[1];
	$NROGUIA[$NO]		= $row[2];
	$CLIENTE[$NO]		= ucwords($row[3]);
	$VOLUMEN[$NO]		= $row[4];
	$DISTRIT0[$NO]		= ucwords($row[5]);
	$ESTADO[$NO]		= ucwords($row[6]);
	$FECHA[$NO]			= $row[7];
	$VATFINAL[$NO]		= $row[8];
	$HORA3[$NO]			= strtotime($row[8]);
	$SUCURSAL[$NO]		= ucwords($row[9]);
	$UNIDAD[$NO]		= $row[10];
	$READX[$NO]			= $row[11];
	$READY[$NO]			= $row[12];
	$VHINICIO[$NO]		= $row[13];
	$VHFINAL[$NO]		= $row[14];
	$HORA1[$NO]			= $row[13];
	$HORA2[$NO]			= $row[14];
	$PESO[$NO]			= $row[16];
	$DRIVER[$NO]		= $row[17];
	$ORDEN[$NO]			= $row[18];	
	$ORDCMP[$NO]		= $row[19];	
	$PLAREF[$NO]		= $row[20];
	$DIRCLI[$NO]		= $row[21];
	$REFCLI[$NO]		= $row[22];
	$OBSERV[$NO]		= $row[23];
}

echo "<table id='Tabla_Detalle'  width='95%' cellpadding='2' cellspacing='1' border='0' align='center'>";
if ($NO > 0){
	for ($i=1;$i<=$NO;$i++){
		if ($i == 1){
			$TOTAL=0;
			$color='';
			echo "<tr>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Ord</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Placa</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Ord.Compra</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Pedido</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>N Guia</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Cliente</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Sede</td>";	
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Sucursal</td>";	
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Distrito</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Estado</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Horario</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Hora Ent.</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Ver</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Peso</td>";			
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Direccion</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Placa.Ref</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Observacion.Ref</td>";
			echo "</tr>";
		}
		$TOTAL=$TOTAL+$PESO[$i];
		if ($colcc == '#A9E2F3'){
			$colcc='#CEECF5';
		} else{
			$colcc = '#A9E2F3';
		}
		echo "<tr bgcolor='".$colcc."'>";
		echo "<td nowrap class='GridAttrField' align='right'>".$ORDEN[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$UNIDAD[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$ORDCMP[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$PEDIDO[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$NROGUIA[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$CLIENTE[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$SUCURSAL[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$REFCLI[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$DISTRIT0[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$ESTADO[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='center'>".$HORA1[$i]."-".$HORA2[$i]."</td>";
		$HORA1[$i]=strtotime($HORA1[$i]);
		$HORA2[$i]=strtotime($HORA2[$i]);		
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
		if (	$READX[$i]	<> '' && $READY[$i]	<> '' ){
			echo "<td nowrap class='GridAttrField'  align='center'>";
			$Ubic = "show_map.php?var1=".HTML_filtro($READX[$i])."&var2=".HTML_filtro($READY[$i])."&var3=".HTML_filtro($NROGUIA[$i])." / ".HTML_filtro($PEDIDO[$i]);
			echo " <a HREF=\""."javascript:void(window.open('".$Ubic."&dummy=.pdf','_blank', 'scrollbars=yes,toolbar=no,resizable=yes,menubar=no,location=no'))\""."><img src='images/lupa.png' height='10' width='10'> </a>";
			echo "</td>";
		} else {
			echo "<td nowrap class='GridAttrField'  align='center'></td>";
		}
		echo "<td nowrap class='GridAttrField' align='right'>".number_format($PESO[$i],3,'.',',')."</td>";	
		echo "<td nowrap class='GridAttrField' align='left'>".$DIRCLI[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$PLAREF[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$OBSERV[$i]."</td>";
		echo "</tr>";
		if ($i == $NO){
			echo "<table width='95%' cellpadding='2' cellspacing='1' border='1' align='center'>";
			echo "<tr>";
			echo "<td nowrap class='RecSrcGridHeader' align='left'>TOTAL DE PEDIDO(S) ($NO)</td>";
			echo "<td nowrap class='GridAttrField' align='right'><font size=4><b>".number_format($TOTAL,3,'.',',')."</b></font></td>";
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
<p><a href="repartodiario.php?local=X" <?php echo 'target="_blank"';?> title="Reparto diario"><b>Reparto diario. Excel</b></a> </p>
</form>
</body>
</html>