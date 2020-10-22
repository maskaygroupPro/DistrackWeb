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
$tabla="<table width=800 border=1 align=center cellpadding=1 cellspacing=1>";
$tabla.="<tr><td colspan=13 align=center><font color=Navy><u><b>Despachos Programados</b></u></font></td></tr>";
$tabla.="<tr>";
$tabla.="<td bgcolor=black><b><font color=white>Ord.</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Placa</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Ord.Compra</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Pedido</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Guia</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Cliente</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Sucursal</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Sede</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Distrito</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Estado</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Horario</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Hora Ent.</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Peso</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Direccion</b></td>";
$tabla.="<td bgcolor=black><b><font color=white>Placa Ref.</b></td>";
$tabla.="</tr>";
//******************************************
$query = "select b.numpedido,b.idpedido,b.documento,left(b.cliente,30),b.volumen,left(b.distcliente,15),b.estado,b.fecentrega,b.horentrega,left(b.localpedido,25),b.placa,b.latitud,b.longitud,b.ventanaini,b.ventanafin,b.fechaprog,b.peso,b.aux1,b.orden,b.aux3,b.aux1,left(b.dircliente,30),b.refcliente from ddaryza.pedidos b where b.fechaprog=curdate() order by b.placa,b.orden ";
$result=mysql_query($query) or die(mysql_error());  //die muestra el error y sale
$NO=0;
while($row = mysql_fetch_array($result)) {  
		$NO++;
		$PEDIDO		= $row[0];
		$ID			= $row[1];
		$NROGUIA	= $row[2];
		$CLIENTE	= ucwords($row[3]);
		$VOLUMEN	= $row[4];
		$DISTRIT0	= ucwords($row[5]);
		$ESTADO		= ucwords($row[6]);
		$FECHA		= $row[7];
		$VATFINAL	= $row[8];
		$HORA3		= strtotime($row[8]);
		$SUCURSAL	= ucwords($row[9]);
		$UNIDAD		= $row[10];
		$READX		= $row[11];
		$READY		= $row[12];
		$VHINICIO	= $row[13];
		$VHFINAL	= $row[14];
		$HORA1		= $row[13];
		$HORA2		= $row[14];
		$PESO		= $row[16];
		$DRIVER		= $row[17];
		$ORDEN		= $row[18];	
		$ORDCMP		= $row[19];	
		$PLAREF		= $row[20];
		$DIRCLI 	= $row[21];
		$REFCLI		= $row[22];
		
		$tabla.="<tr>";
		$tabla.="<td>".$ORDEN."</td>";
		$tabla.="<td>".$UNIDAD."</td>";
		$tabla.="<td>".$ORDCMP."</td>";
		$tabla.="<td>".$PEDIDO."</td>";
		$tabla.="<td>".$NROGUIA."</td>";
		$tabla.="<td>".$CLIENTE[$NO]."</td>";
		$tabla.="<td>".$SUCURSAL[$NO]."</td>";
		$tabla.="<td>".$REFCLI[$NO]."</td>";
		$tabla.="<td>".$DISTRIT0[$NO]."</td>";
		$tabla.="<td>".$ESTADO[$NO]."</td>";
		$tabla.="<td>".$HORA1[$NO."-".$HORA2[$NO]."</td>";
		$tabla.="<td>".$HORA3[$NO]."</td>";
		$tabla.="<td>".$DIRCLI[$NO]."</td>";
		$tabla.="<td>".$PLAREF[$NO]."</td>";
		$tabla.="</tr>";
}
$tabla.="</table>";
echo $tabla;
?>