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

echo "<script>console.log('Debug Objects: " . "ENTREEE" . "' );</script>";

$tabla="<table width=800 border=1 align=center cellpadding=1 cellspacing=1>";
$tabla.="<tr><td colspan=13 align=center><font color=Navy><u><b>Despachos Programados</b></u></font></td></tr>";

//******************************************
$and_historico="";

$and_saga="";

if ($local == 'reporteMateriales'){

	
	$tabla.="<tr>";
$tabla.="<td bgcolor=blue><b><font color=white>N°</b></td>";//1
$tabla.="<td bgcolor=blue><b><font color=white>Terminal</b></td>";//4
$tabla.="<td bgcolor=blue><b><font color=white>Fecha de entrega</b></td>";//6
$tabla.="<td bgcolor=blue><b><font color=white>Placa</b></td>";//18
//zona
$tabla.="<td bgcolor=blue><b><font color=white>Tipo Material</b></td>";//9
$tabla.="<td bgcolor=blue><b><font color=white>Codigo </b></td>";//12
$tabla.="<td bgcolor=blue><b><font color=white>Descripcion</b></td>";//10
$tabla.="<td bgcolor=blue><b><font color=white>Cantidad</b></td>";//2
//$tabla.="<td bgcolor=blue><b><font color=white>Ord.Compra</b></td>";//3
$tabla.="<td bgcolor=blue><b><font color=white>Caso</b></td>";//5

$tabla.="<td bgcolor=blue><b><font color=white>Juego</b></td>";//14
//$tabla.="<td bgcolor=blue><b><font color=white> </b></td>";//15
$tabla.="<td bgcolor=blue><b><font color=white>Libro</b></td>";//16
$tabla.="<td bgcolor=blue><b><font color=white>Orden</b></td>";//17
$tabla.="<td bgcolor=blue><b><font color=white>Estado</b></td>";//17
$tabla.="<td bgcolor=blue></td>";//15

$tabla.="</tr>";

	
	$query="call intralot.ObtenerReporteMateriales(curdate(),curdate())";
    	
	$result=mysql_query($query) or die(mysql_error());  //die muestra el error y sale
	
	$NO=0;
	while($row = mysql_fetch_array($result)) {  
			$NO++;
			$TERMINAL   = $row[0];
			$FECHAENTRE = $row[1];
			$PLACA   	= $row[2];
			$TIPO	    = $row[3];
			$CODIGO		= $row[4];
			$DESCRIPCIO	= $row[5];
			$CANTIDAD	= $row[6];
			$CASO		= $row[7];
			$JUEGO		= $row[8];
			$LIBRO		= $row[9];
			$ORDEN		= $row[10];
			$ESTADO		= $row[11];
			
			


		$tabla.="<tr>";
		$tabla.="<td>".$NO."</td>";//1
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
		$tabla.="<td>".$ESTADO."</td>";//17
		
		$tabla.="</tr>";//16
		
	}

	
	
} else if ($local == 'reporte') {

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

	echo "<script>console.log('Debug Objects: " . "DONDE ESTOY?" . "' );</script>";
	$query="select b.numpedido,b.idpedido,b.documento,left(b.cliente,30),b.volumen,left(b.distcliente,15),b.estado,b.fecentrega,b.horentrega,left(b.localpedido,25),b.placa,b.latitud,b.longitud,b.ventanaini,b.ventanafin,b.fechaprog,b.peso,b.aux1,b.orden,b.aux3,b.aux1,left(b.dircliente,30),b.producto,
	concat(c.item3926,' Rollos Termicos |  \n',
	c.item4788,' Lapiceros Pto.de la Suerte |\n',
	c.item5667,' Cupones Te Apuesto PH |\n',
	c.item5669,' Cupones Tinka PH |\n',
	c.item5668,' Cupones Kabala PH |\n',
	c.item0915,' Cupones Ganadiario |\n',
	c.item0861,' Cupones Ganagol |\n',
	c.item2587,' Cupones Kinelo') as consumibles,
	(select group_concat(' ', cantidad,'  ',descripcion) from intralot.prg_logisticos where terminal = b.numpedido and fechaprog = b.fechaprog) as logisticos,
	(select group_concat(' ',cant_ticket,'  ',descripcion) from intralot.prg_instantaneas where fechaprog = b.fechaprog and left(codreparto,6) = b.numpedido) as instantaneas,
	b.detalle
	from intralot.pedidos b
	left join intralot.prg_consumibles c on (b.numpedido = c.terminal and b.fechaprog = c.fechaprog)
	where b.fechaprog=curdate() order by b.placa,b.orden ";
	//$query="select b.numpedido,b.idpedido,b.documento,left(b.cliente,30),b.volumen,left(b.distcliente,15),b.estado,b.fecentrega,b.horentrega,left(b.localpedido,25),b.placa,b.latitud,b.longitud,b.ventanaini,b.ventanafin,b.fechaprog,b.peso,b.aux1,b.orden,b.aux3,b.aux1,left(b.dircliente,30),b.producto from intralot.pedidos b where b.fechaprog=curdate() order by b.placa,b.orden ";
	//$queryAux="select b.numpedido,b.idpedido,b.documento,left(b.cliente,30),b.volumen,left(b.distcliente,15),b.estado,b.fecentrega,b.horentrega,left(b.localpedido,25),b.placa,b.latitud,b.longitud,b.ventanaini,b.ventanafin,b.fechaprog,b.peso,b.aux1,b.orden,b.aux3,b.aux1,left(b.dircliente,30),b.producto from intralot.pedidos b where b.fechaprog=curdate() order by b.placa,b.orden ";
	$queryAux = "select (aux1)  from intralot.pedidos where aux1='1002010'";

	$result=mysql_query($query) or die(mysql_error());  //die muestra el error y sale
$resultAux=mysql_query($queryAux) or die(mysql_error());  //die muestra el error y sale
$NO=0;
while($row = mysql_fetch_array($result)) {  
		$NO++;
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
			$HORA3		= $row[8];
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
			$DIRCLI		= $row[21];
			$REFCLI		= $row[22];

			$CONSUM		= $row[23];
			$LOGIST		= $row[24];
			$INSTAN		= $row[25];
			$REPARTO		= $row[26];

		$tabla.="<tr>";
		$tabla.="<td>".$ORDEN."</td>";//1
		$tabla.="<td>".$PEDIDO."</td>";//4
		$tabla.="<td>".$CLIENTE."</td>";//6
		$tabla.="<td>".$REPARTO."</td>";//20

		$tabla.="<td>".$DISTRIT0."</td>";//9
		$tabla.="<td>".$HORA3."</td>";//12
		$tabla.="<td>".$ESTADO."</td>";//10
		$tabla.="<td>".$UNIDAD."</td>";//2
		//$tabla.="<td>".$ORDCMP."</td>";//3		
		$tabla.="<td>".$NROGUIA."</td>";//5
		//$tabla.="<td>".$SUCURSAL."</td>";//7
		//$tabla.="<td>".$REFCLI."</td>";//8
		//$tabla.="<td>".$HORA1." - ".$HORA2."</td>";//11
		
		//$tabla.="<td>".$PESO."</td>";//13
		$tabla.="<td>".$DIRCLI."</td>";//14
		//$tabla.="<td>".$PLAREF."</td>";//15
		$tabla.="<td>".$CONSUM."</td>";//17
		$tabla.="<td>".$LOGIST."</td>";//18
		$tabla.="<td>".$INSTAN."</td>";//19
		
		$tabla.="</tr>";//16
		
	}
} else{
	
	$tabla.="<tr>";
$tabla.="<td bgcolor=blue><b><font color=white>Ord</b></td>";//1
$tabla.="<td bgcolor=blue><b><font color=white>Terminal</b></td>";//4
$tabla.="<td bgcolor=blue><b><font color=white>Nombre</b></td>";//6
$tabla.="<td bgcolor=blue><b><font color=white>Distrito</b></td>";//18
$tabla.="<td bgcolor=blue><b><font color=white>Zona</b></td>";//9
$tabla.="<td bgcolor=blue><b><font color=white>Direccion</b></td>";//12
$tabla.="<td bgcolor=blue><b><font color=white>Tipo de Reparto</b></td>";//10
$tabla.="<td bgcolor=blue><b><font color=white>Fecha Entrega</b></td>";//2
$tabla.="<td bgcolor=blue><b><font color=white>Hora</b></td>";//3
$tabla.="<td bgcolor=blue><b><font color=white>Estado</b></td>";//5
$tabla.="<td bgcolor=blue><b><font color=white>Placa</b></td>";//14
$tabla.="<td bgcolor=blue><b><font color=white>N° guia</b></td>";//16
$tabla.="<td bgcolor=blue><b><font color=white>Fecha Reprogramada</b></td>";//16
$tabla.="<td bgcolor=blue></td>";//15

$tabla.="</tr>";

	
	$query="call intralot.ObtenerReportePedidos(curdate(),curdate())";
    	
	$result=mysql_query($query) or die(mysql_error());  //die muestra el error y sale
	
	$NO=0;
	while($row = mysql_fetch_array($result)) {  
			$NO++;
			$ORDEN		= $row[0];
			$TERMINAL   = $row[1];
			$NOMBRE 	= $row[2];
			$DISTRITO   = $row[3];
			$ZONA		= $row[4];
			$DIRECCION	= $row[5];
			$TIPOREPART	= $row[6];
			$FECHAENTRE	= $row[7];
			$HORA		= $row[8];
			$ESTADO		= $row[9];
			$PLACA		= $row[10];
			$NGUIA   	= $row[11];
			$FECHAREPRO = $row[12];
			
			


		$tabla.="<tr>";
		$tabla.="<td>".$NO."</td>";//1
		$tabla.="<td>".$ORDEN."</td>";//1
		$tabla.="<td>".$TERMINAL."</td>";//4
		$tabla.="<td>".$NOMBRE."</td>";//6
		$tabla.="<td>".$DISTRITO."</td>";//20
		$tabla.="<td>".$ZONA."</td>";//9
		$tabla.="<td>".$DIRECCION."</td>";//9
		$tabla.="<td>".$TIPOREPART."</td>";//12
		$tabla.="<td>".$FECHAENTRE."</td>";//10
		$tabla.="<td>".$HORA."</td>";//2
		$tabla.="<td>".$ESTADO."</td>";//5
		$tabla.="<td>".$PLACA."</td>";//14
		$tabla.="<td>".$NGUIA."</td>";//17
		$tabla.="<td>".$FECHAREPRO."</td>";//17
		
		$tabla.="</tr>";//16
		
	}

	
	
}

//$tabla.="<td>".$resultAux."</td>";//16
//		$tabla.="</tr>";//15
$tabla.="</table>";
echo $tabla;
?>