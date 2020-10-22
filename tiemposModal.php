<?php
require_once "include/conexion.php";
$sql="select p.placa, p.documento, e.estado, e.motivo, e.latitud, e.longitud, e.fecha, e.hora from ddaryza.pedidos p inner join appdistrack.reg_estados e on p.documento = e.documento where  p.indice='".$_GET['idc']."' order by e.hora ;";

$result = mysql_query($sql);

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
                    <table class="table table-striped table-hover js-exportable dataTable" cellspacing="0" width="100%">
                            <tbody>
                                <th>Placa</th>
                                <th>Documento</th>
                                <th>Estado/Motivo</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <?php 
                                foreach ($datos as $key => $value):                                 	
                                ?>
                                    <tr><td><?=$value['placa']?></td><td><?=$value['documento']?></td><td><?=$value['estado']." - ".$value['motivo']?></td><td><?=$value['fecha']?></td><td><?=$value['hora']?></td></tr>
                                <?php  
                                endforeach;
                                ?>
                            </tbody>                      

                    </table>

                </div>
                <div class="panel-footer">
                	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button> 
                </div>
        </div>
    </div>