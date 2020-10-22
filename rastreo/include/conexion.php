<?php
$db = mysql_connect('192.168.1.12:21580','Client_Apl','CA2494378_tl') or die("No se puede Conectar...");
	//	$db = mysql_connect('127.0.0.1:3306','root','') or die("No se puede Conectar");
	mysql_select_db("gpslog") or die ("Error al abrir Base de Datos");
?>