<?php
require_once "include/conexion.php";
$sql="select p.placa, p.documento, e.estado, e.motivo, e.latitud, e.longitud, e.fecha, e.hora from ddaryza.pedidos p inner join appdistrack.reg_estados e on p.documento = e.documento where  p.indice='".$_GET['indice']."' order by e.hora ;";
#$sql="select estado, motivo, latitud, longitud,hora from reg_estados where documento='".$_GET['documento']."' and fecha='".$_GET['fecha']."' order by hora;";
#$sql="select estado, motivo, latitud, longitud, hora from appdistrack.reg_estados where documento='0070581185' and fecha='2019-04-22' order by hora;";

$result = mysql_query($sql);
#$cmp=mysql_fetch_assoc($result);
$datos=array();
$j=0;
while($row = mysql_fetch_array($result)) {
		$datos[$j] = $row;
		$j++;
	} 
?>

    <div class="page-body">
        <div class="panel panel-default">
                <div class="panel-body">
                        <?php
                        echo "Todo OK";
                        ?>
                </div>
                <div class="panel-footer">
                	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button> 
                </div>
        </div>
    </div>