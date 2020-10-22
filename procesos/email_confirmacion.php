<?php
require 'include/conexion.php';
header("Refresh: 30; url='email_confirmacion.php'");
$cmps="d.indice, d.placa, d.cliente, d.documento, d.numpedido, d.idpedido, d.documento, d.localpedido, d.sede, d.distcliente, d.dircliente, d.refcliente, d.telfcliente, d.detalle, d.codproducto, d.cantidad, d.volumen, d.peso, d.valor, d.fecentrega, d.horentrega, d.estado, d.motivo, d.latitud, d.longitud, d.prestaciones, d.clase, d.nombre, d.fot_foto, d.observacion, d.conductor, d.email_1, d.email_2, d.aux2, r.comentario, d.aux3";
$tabl="ddaryza.pedidos d inner join appdistrack.reg_estados r on d.documento= r.documento ";
$cond="d.fechaprog=current_date and (d.f_transm='0' or d.f_transm is null or d.f_transm='') and d.estado not in ('Inicio','Llegada','En Ruta','Pendiente') and r.estado not in ('Inicio','Llegada','En Ruta','Pendiente') and r.fecha=current_date ";
$qry1="select ".$cmps." from ".$tabl." where ".$cond." order by d.horentrega";
$resu=mysql_query($qry1);
if (!$resu) {
    die('Error query: ' . mysql_error());
    $num_rows = mysql_num_rows($resu);
    echo "$num_rows Rows\n";
}
$NO=0;
while ($row = mysql_fetch_array($resu)){
    $NO++;
    $INDI[$NO]      = $row[0];
    $PLAC[$NO]      = $row[1];
    $CLIE[$NO]      = $row[2];
    $DOCU[$NO]      = $row[3];
    $NUMP[$NO]      = $row[4];
    $IDPE[$NO]      = $row[5];
    $DOCU[$NO]      = $row[6];
    $LOCA[$NO]      = $row[7];
    $SEDE[$NO]      = $row[8];
    $DIST[$NO]      = $row[9];
    $DIRC[$NO]      = $row[10];
    $REFC[$NO]      = $row[11];
    $TELF[$NO]      = $row[12];
    $DETA[$NO]      = $row[13];
    $CODP[$NO]      = $row[14];
    $CANT[$NO]      = $row[15];
    $VOLU[$NO]      = $row[16];
    $PESO[$NO]      = $row[17];
    $VALO[$NO]      = $row[18];
    $FECE[$NO]      = $row[19];
    $HORA[$NO]      = $row[20];
    $ESTA[$NO]      = $row[21];
    $MOTI[$NO]      = $row[22];
    $LATI[$NO]      = $row[23];
    $LONG[$NO]      = $row[24];
    $PRES[$NO]      = $row[25];
    $CLAS[$NO]      = $row[26];
    $VEND[$NO]      = $row[27];
    $FOTO[$NO]      = $row[28];
    $OBSE[$NO]      = $row[29];
    $CHOF[$NO]      = $row[30];
    $EMA1[$NO]      = $row[31];
    $EMA2[$NO]      = $row[32];
    $AUX2[$NO]      = $row[33];
    $COMN[$NO]      = $row[34];
    $AUX3[$NO]      = $row[35];
}
echo "<html>";
echo "<head>";
echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>";
echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'>";
echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>";
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'><link rel='stylesheet' href='http://www.w3schools.com/lib/w3.css'>";
echo "</head>";
echo "<body>";
if ($NO > 0){
    echo "<table width='95%' align='center'>";
    for ($i=1;$i<=$NO;$i++){
    	$titulo="Distrack: ".$ESTA[$i]." > ".$CLIE[$i]." (".$DOCU[$i].")";
		$cuerpo="Cliente:			".$CLIE[$i]."\n";
		$cuerpo.=$LOCA[$i]." ".$REFC[$i]."\n\n";
		$cuerpo.="Pedido:		".$NUMP[$i]."\n";
        $cuerpo.="Orden C.:     ".$AUX3[$i]."\n";
		$cuerpo.="Vendedor:		".$VEND[$i]."\n\n";
		$cuerpo.="Documento:	".$DOCU[$i]."\n";
		$cuerpo.="Peso:			".$PESO[$i]."\n";
		$cuerpo.="Volumen:		".$VOLU[$i]."\n";
		$cuerpo.="Estado:		".$ESTA[$i]." - ".$MOTI[$i]."\n";
		$cuerpo.="Hora:	 		".$FECE[$i]." ".$HORA[$i]."\n\n";
		$cuerpo.="Placa:		".$PLAC[$i]."\n";
		$cuerpo.="Contacto:		".$CHOF[$i]."\n\n";
		$cuerpo.="Observacion:\n";
		$cuerpo.=$COMN[$i]."\n\n";
		$cuerpo.="Imagenes:\n";
		$cuerpo.="http://190.12.73.86/ddaryza/show_galeria_app.php?var0=".$DOCU[$i]."&dummy=pdf\n\n";
		$cuerpo.="Ubicacion:\n";
		$cuerpo.="http://maps.google.es/?q=".$LONG[$i]."%20".$LATI[$i];
		$dest=$EMA1[$i];
        if ($ESTA[$i]=="Entregado"){
            $ccop="";
        }else{
            $ccop=$EMA2[$i];
        }
		$cmpi="Cod_Sender, lst_To, lst_CC, lst_CCO, eml_Sender, eml_Subject, eml_body, DT_Created";
		$vals="'0001','".$dest."','".$ccop."','','alertas@tracklog.info','".$titulo."','".$cuerpo."','".date('Y-m-d h:i:s', time())."'";
		$inse="insert into aplicaciones.emailqueue(".$cmpi.") values(".$vals.");";
		mysql_query($inse);
		mysql_query("update ddaryza.pedidos set f_transm='1' where indice='".$INDI[$i]."';");
        echo "<tr><td>".$HORA[$i]."</td><td>".$DOCU[$i]." </td><td> ".$CLIE[$i]." </td><td> ".$ESTA[$i]."-".$MOTI[$i]."</td></tr>";
    }
    echo "</table>";
}
echo "</body></html>";
?>