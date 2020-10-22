<?php
require_once "/include/conexion.php";
include_once "Menu_Head.php";	
include "filtro.php";
$colcc='#CEECF5';
$vhasta=date("d-m-Y",time()-(1*24*3600));
$vdesde=date("d-m-Y",time()-(4*24*3600));
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
}
if ($submit == "Limpiar"){
	$submit='Z';
}
if ($submit == "Z"){
	$vpedido='';
	$vid='';
	$vguia='';
	$vplaca='';
	$vfecha='';
	$vestado='';
	$vdistrito='';
	$vsucursal='';
	$vcliente='';
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta http-equiv="refresh" content="600"/> -->
<title>Estado de Repartos</title>
<head>
	<link href="style/style.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" src="script/tigra_tables.js"></script>
	<script language="JavaScript" src="script/sorttable.js"></script>
	<script language="JavaScript" src="ts_picker2.js"></script>
</head>
<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Tabla_Detalle").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>
<?
$sesion=$_SESSION['ID'];
$and_pedido="";
if ( !empty($vpedido) ){
	$and_pedido=" and numpedido like '%$vpedido%' ";
}
$and_id="";
if ( !empty($vid) ){
	$and_id=" and idpedido like '%$vid%' ";
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
	$and_distrito=" and localpedido= '$vdistrito' ";	
}
$and_sucursal="";
if ( !empty($vsucursal) ){
	$and_sucursal=" and cliente= '$vsucursal' ";	
}
$hst=date("Y-m-d",strtotime($vhasta));
$dsd=date("Y-m-d",strtotime($vdesde));
$query= "select p.numpedido,p.idpedido,p.documento,left(p.cliente,20),round(p.volumen,2),left(p.distcliente,18),p.estado,date_format(p.fechaprog,'%d/%m/%Y'),p.horentrega,p.localpedido,p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fecentrega,left(p.dircliente,36),p.producto,p.ronda,p.refcliente,round(p.detalle,2),p.cantidad,p.clasificacion,left(p.observacion,20) from dpro.pedidos p where date(p.fechaprog) between '".$dsd."' and '".$hst.$and_estado.$and_distrito.$and_sucursal.$and_pedido.$and_id.$and_placa.$and_guia." order by p.fechaprog desc";
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
	$ID[$NO]			= $row[1];
	$NROGUIA[$NO]		= $row[2];
	$CLIENTE[$NO]		= ucwords($row[3]);
	$VOLUMEN[$NO]		= $row[4];
	$DISTRIT0[$NO]		= ucwords($row[9]);
	$ESTADO[$NO]		= ucwords($row[6]);
	$FECHA[$NO]			= $row[7];
	$VATFINAL[$NO]		= $row[8];
	$HORA3[$NO]			= strtotime($row[8]);
	$SUCURSAL[$NO]		= ucwords($row[5]);
	$UNIDAD[$NO]		= $row[10];
	$READX[$NO]			= $row[11];
	$READY[$NO]			= $row[12];
	$VHINICIO[$NO]		= $row[13];
	$VHFINAL[$NO]		= $row[14];
	$HORA1[$NO]			= strtotime($row[13]);
	$HORA2[$NO]			= strtotime($row[14]);
	$DIRECCION[$NO]		= $row[16];
	$PRODUCTO[$NO]		= $row[17];
	$RONDA[$NO]			= $row[18];
	$REFERENCIA[$NO]	= $row[19];
	$DETALLE[$NO]		= $row[20];
	$CANTIDAD[$NO]		= $row[21];
	$CLASE[$NO]			= $row[22];
	$OBS[$NO]			= $row[23];
}
?>
<form name="frmreporte" method ="post" action="historico.php">
<A name = "INICIO"></A>
<A href = '#FIN'>Final <img src='images/sap_binocular.gif' border='0' alt='Final'></A>
<table width="95%" border="0" cellspacing="5" cellpadding="0" align="center" >
  <tr align="center"> 
    <td nowrap class="PageCaption" align="left" colspan=6>Historia de Entregas</td>
  </tr>
 <?
echo "<tr>";
echo "<td nowrap class='CaptionConsulta' align='right'> Desde : &nbsp;</td>";
echo "<td nowrap class='CaptionConsulta' align='left'><input type='Text' name='vdesde' class='AttrField' size='12' maxlength='10' value='".$vdesde."' onblur='return isValidDate(vdesde.value);' >&nbsp;";							  
?>
<a href="javascript:show_calendar2('document.frmreporte.vdesde', document.frmreporte.vdesde.value);"><img src="images/calendario.gif" width="16" height="16" border="0" alt="Calendario"></a> 
<?
echo "<td nowrap class='CaptionConsulta' align='right'> Hasta : &nbsp;</td>";
echo "<td nowrap class='CaptionConsulta' align='left'><input type='Text' name='vhasta' class='AttrField' size='12' maxlength='10' value='".$vhasta."' onblur='return isValidDate(vdesde.value);' >&nbsp;";							  
?>
<a href="javascript:show_calendar2('document.frmreporte.vhasta', document.frmreporte.vhasta.value);"><img src="images/calendario.gif" width="16" height="16" border="0" alt="Calendario"></a> 
<?
echo "</tr>";

echo "<tr>";

echo "<td nowrap class='CaptionConsulta' align='right'>Estado :</td>";
echo "<td align=left>";
$query ="select p.estado from dpro.pedidos p where p.estado<>'' and date(p.fechaprog) between '".date("Y-m-d",strtotime($vdesde))."' and '".date("Y-m-d",strtotime($vhasta))."' group by p.estado order by p.estado";
$result = mysql_query($query);
if (!$result) {
	die('Error query: ' . mysql_error());
	$num_rows = mysql_num_rows($result);
	echo "$num_rows Rows\n";
}
echo "<SELECT id='vestado' name='vestado' class='SelectConsulta' >";
echo " <option value='' SELECTED>[-------------------- Todos --------------------]</option>";
while ($row = mysql_fetch_row($result)) {
	$cod_est 	= ucwords($row[0]);
	$desc_est	= strtoupper($row[0]);
	if ($cod_est == $vestado) {
		echo "<option value='".$cod_est."' SELECTED>".$desc_est."</option>\n";
	} else {
		echo "<option value='".$cod_est."'>".$desc_est."</option>\n";
	} 	
}
echo " </select> ";	
echo "</td>";

echo "<td nowrap class='CaptionConsulta' align='right'>Distrito :</td>";
echo "<td align=left>";
$query ="select p.localpedido from dpro.pedidos p where p.localpedido<>'' and date(p.fechaprog) between '".date("Y-m-d",strtotime($vdesde))."' and '".date("Y-m-d",strtotime($vhasta))."' group by p.localpedido order by p.localpedido";
$result = mysql_query($query);
if (!$result) {
	die('Error query: ' . mysql_error());
	$num_rows = mysql_num_rows($result);
	echo "$num_rows Rows\n";
}
echo "<SELECT id='vdistrito' name='vdistrito' class='SelectConsulta' >";
echo " <option value='' SELECTED>[-------------------- Todos --------------------]</option>";
while ($row = mysql_fetch_row($result)) {
	$cod_dist 	= ucwords($row[0]);
	$desc_dist	= strtoupper($row[0]);
	if ($cod_dist == $vdistrito) {
		echo "<option value='".$cod_dist."' SELECTED>".$desc_dist."</option>\n";
	} else {
		echo "<option value='".$cod_dist."'>".$desc_dist."</option>\n";
	} 	
}
echo " </select> ";	
echo "<td nowrap class='CaptionConsulta' align='right'>Cliente :</td>";
echo "<td align=left>";
//$query_suc = "SELECT cliente FROM dpro.pedidos WHERE cliente !='' GROUP BY cliente ORDER BY 1";
$query_suc ="select p.cliente from dpro.pedidos p where p.cliente<>'' and date(p.fechaprog) between '".date("Y-m-d",strtotime($vdesde))."' and '".date("Y-m-d",strtotime($vhasta))."' group by p.cliente order by p.cliente";
$result_suc = mysql_query($query_suc);
if (!$result_suc) {
	die('Error query: ' . mysql_error());
	$num_rows = mysql_num_rows($result_suc);
	echo "$num_rows Rows\n";
}
echo "<SELECT id='vsucursal' name='vsucursal' class='SelectConsulta' >";
echo " <option value='' SELECTED>[-------------------- Todos --------------------]</option>";
while ($row_suc = mysql_fetch_row($result_suc)) {
	$cod_suc	= ucwords($row_suc[0]);
	$desc_suc	= strtoupper($row_suc[0]);
	if ($cod_suc == $vsucursal) {
		echo "<option value='".$cod_suc."' SELECTED>".$desc_suc."</option>\n";
	} else {
		echo "<option value='".$cod_suc."'>".$desc_suc."</option>\n";
	} 	
}
echo "</select> ";	
echo "</tr>";

echo "<tr>";
echo "<td align='right'><b>Pedido :&nbsp;</b></td>";
echo "<td align='left'><input type='text' class='AttrField' id='vpedido' name='vpedido' title='Ingrese el numero del Pedido' value='".$vpedido."' maxlength='11' size='14' onKeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'></td>";
echo "<td align='right'><b>Id :&nbsp;</b></td>";
echo "<td align='left'><input type='text' class='AttrField' id='vid' name='vid' title='Ingrese el Id Pedido' value='".$vid."'  maxlength='25' size='14' onKeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'></td>";
echo "<td align='right'><b>Guia :&nbsp;</b></td>";
echo "<td align='left'><input type='text' class='AttrField' id='vguia' name='vguia' title='Ingrese el numero de guia' value='".$vguia."' maxlength='15' size='17'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><b>Placa:&nbsp;</b></td>";
echo "<td align='left'><input type='text' class='AttrField' id='vplaca' name='vplaca' title='Ingrese placa' value='".$vplaca."' maxlength='7'  size='10'> </td>";
echo "</tr>";

echo "</table>";

echo "<table width='30%' align=center>";
echo "<tr>";
echo "<td align='left'><input style='color:white;font-weight:bold;background : #0000A0;font-size:10' type='submit' name='submit' value='Consultar'></td>";
echo "<td align='left'><input style='color:white;font-weight:bold;background : #0000A0;font-size:10' type='submit' name='submit' value='Limpiar'></td>";
echo "<td align='left'><input style='color:white;font-weight:bold;background : #0000A0;font-size:10' type='submit' name='submit' value='Buscar'></td>";
echo "</tr>";
echo "</table>";
?>  
</table>
<?
echo "<table id='Tabla_Detalle' class='sortables' width='95%' cellpadding='2' cellspacing='1' border='0' align='center'>";
if ($NO > 0){
	for ($i=1;$i<=$NO;$i++){
		if ($i == 1){
			$TOTAL=0;
			$color='';
			echo "<tr bgcolor='#FAFAFA'>";
			//echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>No</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Pedido</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Id</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Nro.Guia</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Cliente</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Distrito</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Clase</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Estado</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Fecha</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>B.Atencion</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>H.Entrega</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Retail</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Placa</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Mapa</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Volumen</td>";
			echo "<td nowrap class='RecSrcGridHeaderLLSort' align='center'>Observacion</td>";
			echo "</tr>";
		}
		$TOTAL=$TOTAL+$VOLUMEN[$i];
		if ($colcc == '#A9E2F3'){
			$colcc='#CEECF5';
		} else{
			$colcc = '#A9E2F3';
		}
		echo "<tr bgcolor='".$colcc."'>";
		//echo "<td nowrap class='GridAttrField' align='right'>".$i."</td>";
		echo "<td nowrap class='GridAttrField' align='right'>".$PEDIDO[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='right'>".$ID[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='right'>".$NROGUIA[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$CLIENTE[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$SUCURSAL[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$CLASE[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$ESTADO[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$FECHA[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$VHINICIO[$i]." - ".$VHFINAL[$i]."</td>";
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
		echo "<td nowrap class='GridAttrField' align='left'>".$PRODUCTO[$i]."</td>";
		echo "<td nowrap class='GridAttrField' align='left'>".$UNIDAD[$i]."</td>";		
		if (	$READX[$i]	<> '' && $READY[$i]	<> '' ){
			echo "<td nowrap class='GridAttrField'  align='center'>";
			$Ubic = "show_map.php?var1=".HTML_filtro($READX[$i])."&var2=".HTML_filtro($READY[$i])."&var3=".HTML_filtro($NROGUIA[$i])." / ".HTML_filtro($PEDIDO[$i]);
			echo " <a HREF=\""."javascript:void(window.open('".$Ubic."&dummy=.pdf','_blank', 'scrollbars=yes,toolbar=no,resizable=yes,menubar=no,location=no'))\"".">Ver</a>";
			echo "</td>";
		} else {
			echo "<td nowrap class='GridAttrField'  align='center'></td>";
		}
		echo "<td nowrap class='GridAttrField' align='right'>".$VOLUMEN[$i]."</td>";		
		echo "<td nowrap class='GridAttrField' align='left'>".$OBS[$i]."</td>";		
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
<?
//echo "<a href=repartohistorico.php?local=historico&vdesde=$vdesde&vhasta=$vhasta&vestado=$vestado&vdistrito=$vdistrito&vsucursal=$vsucursal&vid=$vid&vpedido=$vpedido&vguia=$vguia&vplaca=$vplaca target='_blank' title='Reporte Diario'><b>Reporte Historico Excel</b></a>";
?>
</form>
<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
<p><img src="export_to_excel.gif" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>
</body>
</html>