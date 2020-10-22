<?php
//$db = mysql_connect('localhost','root','') or die("No puede Conectarse...");
		$db = mysql_connect('190.12.73.84:21580','amoviles','am12345') or die("No se puede Conectar");
	mysql_select_db("gpslog") or die ("Error al intentar conectarse a la Base de Datos");
?>
