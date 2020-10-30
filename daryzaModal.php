<?php
require_once "include/conexion.php";
$sql="select b.numpedido,b.idpedido,b.documento,left(b.cliente,30) as cliente,b.volumen,left(b.distcliente,15),b.estado,b.fecentrega,b.horentrega,
left(b.localpedido,25) as localpedido,b.placa,b.latitud,b.longitud,b.ventanaini,b.ventanafin,b.fechaprog,b.peso,b.aux1,b.orden,b.aux3,b.aux1,
left(b.dircliente,30) as direccion,left(b.refcliente,25) as refcliente,b.observacion,b.fot_foto,b.motivo,b.indice as Id from intralot.pedidos b
where b.indice='".$_GET['indice']."' order by b.placa,b.orden;";
$result = mysql_query($sql);
$datos=array();
$j=0;
while($row = mysql_fetch_array($result)) {
		$datos[$j] = $row;
		$j++;
	} 

$sql="select p.placa, p.documento, e.estado, e.motivo, e.latitud, e.longitud, e.fecha, e.hora from intralot.pedidos p inner join appdistrack.reg_estados e on p.documento = e.documento where  p.indice='".$_GET['indice']."' order by e.hora ;";
$result = mysql_query($sql);
$tiempos=array();
$j=0;
while($row = mysql_fetch_array($result)) {
        $tiempos[$j] = $row;
        $j++;
    }     

?>
    <div class="page-body">
        <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-hover js-exportable dataTable" cellspacing="0" width="100%">
                            <tbody>
                                <?php foreach ($datos as $key => $value): ?>
                                	<tr><td>Ord</td><td><?=$value['orden']?></td><td>Placa</td><td><?=$value['placa']?></td></tr>
                                    <!-- <tr><td>Placa</td><td><?=$value['placa']?></td></tr> -->
                                    <tr><td>Ord.Compra</td><td><?=$value['aux3']?></td><td>Pedido</td><td><?=$value['numpedido']?></td></tr>
                                    <!-- <tr><td>Pedido</td><td><?=$value['numpedido']?></td></tr> -->
                                    <tr><td>N° Guia</td><td><?=$value['documento']?></td><td>Cliente</td><td><?=$value['cliente']?></td></tr>
                                    <!-- <tr><td>Cliente</td><td><?=$value['cliente']?></td></tr> -->
                                    <tr><td>Sede</td><td><?=$value['localpedido']?></td><td>Sucursal</td><td><?=$value['refcliente']?></td></tr>
                                    <!-- <tr><td>Sucursal</td><td><?=$value['refcliente']?></td></tr> -->
                                    <tr><td>Estado</td><td><?=$value['estado']?></td><td>Motivo</td><td><?=$value['motivo']?></td></tr>
                                    <!-- <tr><td>Motivo</td><td><?=$value['motivo']?></td></tr> -->
                                    <tr><td>Horario</td><td><?=date('H:i:s',strtotime($value['ventanaini']))."-".date('H:i:s',strtotime($value['ventanafin']))?></td><td>Hora Ent.</td><td><?=$value['horentrega']?></td></tr>
                                    <!-- <tr><td>Hora Ent.</td><td><?=$value['horentrega']?></td></tr> -->
                                    <!-- <tr><td>GPS</td><td><?=$value['placa']?></td></tr>
                                    <tr><td>Foto</td><td><?=$value['placa']?></td></tr> -->
                                    <tr><td>Peso</td><td><?=$value['peso']?></td><td>Direccion</td><td><?=$value['direccion']?></td></tr>
                                    <!-- <tr><td>Direccion</td><td><?=$value['direccion']?></td></tr> -->
                                    <tr><td>Placa.Ref</td><td><?=$value[20]?></td><td>Observacion.Ref</td><td><?=$value['observacion']?></td></tr>
                                    <!-- <tr><td>Observacion.Ref</td><td><?=$value['observacion']?></td></tr> -->
                            	<?php endforeach;?>
                            </tbody>                      
                    </table>
                    <br><br><h3>Contenido</h3>
                    <div class="row">
                        <div class="col-sm-5">
                            <?php 

                            //$fecha_actual = date("d-m-Y");
                            //sumo 1 día
                            //$newFecha = date("Y-m-d",strtotime("2020-10-22"));
                            //echo date("Y-m-d",strtotime("2020-10-22"));
                            //echo getdate()["wday"];

                            //echo date("d-m-Y",strtotime($fecha_actual."+ 1 days")); 
                            //resto 1 día
                            //echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 



                            $qcons="select item3926, item4788, item5667, item5669, item5668, item0915, item0861, item2587 from intralot.prg_consumibles where terminal='".$value['numpedido']."' and fechaprog='".$value['fechaprog']."';";
                            $rcons=mysql_query($qcons);
                            $acons=mysql_fetch_assoc($rcons);
                            $dcons=intval($acons['item3926'])." Rollos Termicos"."<br>".intval($acons['item4788'])." Lapiceros Pto.de la Suerte"."<br>".intval($acons['item5667'])." Cupones Te Apuesto PH"."<br>".intval($acons['item5669'])." Cupones Tinka PH"."<br>".intval($acons['item5668'])." Cupones Kabala PH"."<br>".intval($acons['item0915'])." Cupones Ganadiario"."<br>".intval($acons['item0861'])." Cupones Ganagol"."<br>".intval($acons['item2587'])."Cupones Kinelo";
                            echo "<h4>Consumibles</h4>".$dcons;
                            ?>
                        </div>
                        <div class="col-sm-7">
                            
                            <?php 
                            $qlogs="select cantidad, descripcion, caso from intralot.prg_logisticos where terminal='".$value['numpedido']."' and fechaprog='".$value['fechaprog']."';";
                            #echo $qcons;
                            $rlogs=mysql_query($qlogs);
                            $dlogs="";
                            while ($alogs =mysql_fetch_assoc($rlogs)){                                     
                                $dlogs.=$alogs['cantidad']." ".$alogs['descripcion']." #Caso:".$alogs['caso']."<br>";
                            }
                            echo "<h4>Logisticos</h4>".$dlogs;
                            $qinst="select cant_ticket, descripcion from intralot.prg_instantaneas where fechaprog='".$value['fechaprog']."' and left(codreparto,6)='".$value['numpedido']."';";
                            $rinst=mysql_query($qinst);
                            $dinst="";
                            while ($ainst =mysql_fetch_assoc($rinst)){                                     
                                $dinst.=$ainst['cant_ticket']." ".$ainst['descripcion']."<br>";
                            }
                            echo "<br><h4>Instantanea</h4>".$dinst;
                            ?>
                        </div>
                    </div>

<br><br><h3>Tiempos</h3>

                    <table class="table table-striped table-hover js-exportable dataTable" cellspacing="0" width="100%">
                            <tbody>
                                <th>Placa</th>
                                <th>Documento</th>
                                <th>Estado/Motivo</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <?php 
                                foreach ($tiempos as $key => $vals):                                     
                                ?>
                                    <tr><td><?=$vals['placa']?></td><td><?=$vals['documento']?></td><td><?=$vals['estado']." - ".$vals['motivo']?></td><td><?=$vals['fecha']?></td><td><?=$vals['hora']?></td></tr>
                                <?php  
                                endforeach;
                                ?>
                           </tbody>                      
                    </table>
                    


                </div>
                <div class="panel-footer">
                	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar </button>
                </div>
        </div>
    </div>