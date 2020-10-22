<?php 
session_start(); 
if ( !isset($_SESSION["ID"])  ){
    header("Location: FIN_CONEXION.php");
}
error_reporting(0);
require_once "include/conexion.php";
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
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>	
    <meta http-equiv="refresh" content="60">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	<link type="image/x-icon" href="favicon.ico" rel="shortcut icon" />
    <link rel="stylesheet" href="css/bootstrap/3.3.7/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chosen/chosen.css">
    <link rel="stylesheet" href="css/estilos-daryza.css">
    <!-- fontawesome css -->
    <link rel="stylesheet" href="css/fontawesome/5.0.8/fa-solid.css">
    <link rel="stylesheet" href="css/fontawesome/5.0.8/fontawesome.css">
    <!-- Jquery Datatables Css --><!-- Tabla responsiva -->
    <link href="css/DataTables/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="css/DataTables/responsive.dataTables.min.css" rel="stylesheet" />
    <script src="js/jquery/jquery.min.js"></script>
    
</head>
<body>
        
<?php
$operacion='';
$cmp='';
if( ! empty($_POST)){
    $valor=$_POST['valor'];
    $vcampo=$_POST['selectedCampo'];
    switch ($vcampo) {
                case 'numpedido':
                    $cmp="p.numpedido";
                    break;
                case 'cliente':
                    $cmp="p.producto";
                    break;
                case 'placa':
                    $cmp="p.placa";
                    break;
                case 'destinatario':
                    $cmp="p.cliente";
                    break;
                case 'documento':
                    $cmp="p.documento";
                    break;
                case 'estado':
                    $cmp="p.estado";
                    break;
    }

    if(!empty($vcampo) && !empty($valor)){
                $operacion=" and ".$cmp." like '%".$valor."%' ";    
    }
    #p.placa, p.idpedido, p.documento, p.cliente, p.distcliente, p.hora_llegada, p.hora_inicio, p.horentrega, timediff(hora_inicio, p.hora_llegada) espera, timediff(horentrega, p.hora_inicio) atencion, timediff(horentrega, p.hora_llegada) completo 
    $cmps="p.placa, p.idpedido, p.documento, p.cliente, p.distcliente, p.estado, p.motivo, p.fot_foto,p.indice as Id,e.col_text, e.col_back, p.hora_llegada, p.hora_inicio, p.horentrega, timediff(hora_inicio, p.hora_llegada) espera, timediff(horentrega, p.hora_inicio) atencion, timediff(horentrega, p.hora_llegada) completo, p.latitud, p.longitud";
    $tabl="alcha.pedidos p inner join ddaryza.estados e on p.estado=e.estado";
    $cond="p.fechaprog=current_date";
    $query = "select ".$cmps." from ".$tabl." where ".$cond.$operacion." order by p.placa,p.orden;";
    // var_dump($query);exit();
    $result = mysql_query($query);

}else{
    $cmps="p.placa, p.idpedido, p.documento, p.cliente, p.distcliente, p.estado, p.motivo, p.fot_foto,p.indice as Id,e.col_text, e.col_back, p.hora_llegada, p.hora_inicio, p.horentrega, timediff(hora_inicio, p.hora_llegada) espera, timediff(horentrega, p.hora_inicio) atencion, timediff(horentrega, p.hora_llegada) completo, p.latitud, p.longitud";
    $tabl="alcha.pedidos p inner join ddaryza.estados e on p.estado=e.estado";
    $cond="p.fechaprog=current_date";
    $query = "select ".$cmps." from ".$tabl." where ".$cond." order by p.placa,p.orden ; ";
    $result = mysql_query($query);
}
#echo $query;
$datos=array();
$j=0;
while($row = mysql_fetch_array($result)) {
		$datos[$j] = $row;
		$j++;
	} 

?>
<section class="content dashboard">
	<div class="page-body menu-body">
        <div class="panel panel-default borde">
        	<div class="panel-heading" style="background-color:white; margin:10px; padding:0px">
                    
                <div class="row">
                    <div class="col-md-2">
            			<td><img src="images/logo.png" width="60%"></td>
                    </div>
                    <div class="col-md-10">
                        <table>
                            <tr>
                            <div class="header-nav animate-dropdown">
                                    <div class="container pedido-container">
                                        <div class="bs-example">
                                            <nav class="navbar navbar-inverse pedido-menu" role="navigation">
                                                <div class="container-fluid">
                                                    <div class="navbar-header">
                                                                  <button type="button" class="navbar-toggle collapsed menu-despegable" data-toggle="collapse" data-target="#bs-example-navbar-collapse-animations">
                                                                  <span class="sr-only">Toggle navigation</span>
                                                                  <span class="icon-bar"></span>
                                                                  <span class="icon-bar"></span>
                                                                  <span class="icon-bar"></span>
                                                                  </button>
                                                                  <a class="navbar-brand" href="#"></a>
                                                    </div>
                                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-animations" data-hover="dropdown" data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft">
                                                        <ul class="nav navbar-nav">
                                                            <li><a href="actual.php" rel="#iframe" class="top_link">Actual</a></li> 
                                                            <li><a href="historico.php" rel="#iframe" class="top_link">B&uacute;squeda</a></li> 
                                                            <li style="padding: 16px;">
                                                              <div class="dropdown">
                                                                <a data-toggle="dropdown" style="color:black;">Estad&iacute;sticas
                                                                  <span class="caret"></span>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                  <li><a href="estadistica_actual.php">Por placa</a></li>
                                                                  <li><a href="est_his.php">Por periodo</a></li>
                                                                </ul>
                                                              </div>
                                                            </li>
                                                            <li class="top"><a href="logout.php" id="privacy" class="top_link" target=_self><span>Salir</span></a></li>            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                            </div>
                            </tr>
                        </table>
                    </div>
                </div>
						
            </div>
			<div class="panel-body">
				<div class="panel-body p-b-25">

                    <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                               
                                <div class="col-sm-5 col-md-3">
                                        <label class="col-xs-4 control-label">Campo</label>
                                        <div class="col-xs-8">
                                            <select class="form-control chosen-select" id="selectedCampo" name='selectedCampo' data-placeholder="Seleccione un campo">
                                                <option value='<?=( !empty($vcampo) ? $vcampo : '')?>' select><?=( !empty($vcampo) ? $vcampo : '')?></option>
                                                <option value="numpedido">Num Pedido</option>
                                                <option value="cliente">Cliente</option>
                                                <option value="placa">Placa</option>
                                                <option value="destinatario">Destinatario</option>
                                                <option value="documento">Documento</option>
                                                <option value="estado">Estado</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-sm-5 col-md-2">
                                        <label class="col-xs-4 control-label">Valor</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control" id="valor" name="valor" placeholder="Ingrese el valor" value='<?=( !empty($valor) ? $valor : '')?>'>
                                        </div>
                                </div>
                                <div class="col-sm-2 col-md-1">
                                    <div class="col-sm-12">
                                        <div class="col-sm-offset-2 p-l-15">
                                            <button type="submit" class="btn btn-sm btn-success">Procesar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                            
                            <table class="table table-striped table-hover js-exportable" id="example2" cellspacing="0" width="100%">
                                    <thead style="background-color:#131212f7; color:white;">
                                        <tr>
                                            <th width="8%"><center>Placa</center></th>
                                            <th width="10%"><center>Documento</center></th>
                                            <th width="20%"><center>Destinatario</center></th>
                                            <th width="15%"><center>Distrito</center></th>
                                            <th width="8%"><center>Llegada</center></th>
                                            <th width="8%"><center>Inicio</center></th>
                                            <th width="8%"><center>Final</center></th>
                                            <th width="10%"><center>Estado</center></th>
                                            <th width="8%"><center>Espera</center></th>
                                            <th width="8%"><center>Atencion</center></th>
                                            <th width="8%"><center>Total</center></th>
                                            <th width="2%"></th>
                                            <th width="2%"></th>
                                            <th width="2%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="tabla-pedidos">
                                        <?php foreach ($datos as $key => $value){ ?>
<!--
p.placa, p.idpedido, p.documento, p.cliente, p.distcliente, p.hora_llegada, p.hora_inicio, p.horentrega, p.estado,p.motivo, p.fot_foto,p.indice as Id,e.col_text, e.col_back timediff(hora_inicio, p.hora_llegada) espera, timediff(horentrega, p.hora_inicio) atencion, timediff(horentrega, p.hora_llegada) completo-->                                        
                                        <tr>
                                            <td class="center" align="center"><?=$value[0]?></td> 
                                            <td class="center" align="center"><?=$value[2]?></td> 
                                            <td class="center"><?=$value[3]?></td> 
                                            <td class="center"><?=$value[4]?></td> 
                                            <td class="right"><?=$value['hora_llegada']?></td> 
                                            <td class="right"><?=$value['hora_inicio']?></td> 
                                            <td class="right"><?=$value['horentrega']?></td>                                             
                                            <td class="center" align="center" style="background-color:<?=$value['col_back']?>;color:<?=$value['col_text'];?> !important;"><?=$value[5]."-".$value[6]?></td> 
                                            <td class="right"><?=$value['espera']?></td> 
                                            <td class="right"><?=$value['atencion']?></td> 
                                            <td class="right"><?=$value['completo']?></td> 
                                                <form action="" id="estadoAjax">
                                                <td class="text-center">
                                                    <a  style="color: #1a1919;" href="javascript:loadModalDaryza(<?=$value['Id']?>);"><i class="fas fa-file-alt"></i></a>
                                                </td>

                                                <td class="text-center">
                                                    <?php 
                                                    if($value['latitud']  <> '' && $value['longitud'] <> ''){
                                                        $Ubic = "show_map.php?var1=".$value['latitud']."&var2=".$value['longitud'];
                                                        echo " <a style='color: #1a1919;' HREF=\""."javascript:void(window.open('".$Ubic."&dummy=.pdf','_blank', 'scrollbars=yes,toolbar=no,resizable=yes,menubar=no,location=no'))\""."><i class='fas fa-map-marker-alt'></i></a>";
                                                    } else {
                                                        echo "<a></a>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if($value['documento'] <> ''){
                                                        $Ubic = "show_galeria_app.php?var0=".$value['documento'];
                                                        echo " <a style='color: #1a1919;' HREF=\""."javascript:void(window.open('".$Ubic."&dummy=.pdf','_blank', 'scrollbars=yes,toolbar=no,resizable=yes,menubar=no,location=no'))\""."><i class='fas fa-camera'></i></a>";
                                                        // echo "</td>";
                                                    } else {
                                                        echo "<a></a>";
                                                    }
                                                    ?>
                                                </td>
                                            </td>
                                                </form>
                                        </tr>
                                    <?php }?>                              
                                    </tbody>                        
                            </table>
                    </form>
					
				</div>
			</div>
		</div>
	</div>
</section>
<script language="JavaScript" type="text/javascript">
	// tigra_tables('Tabla_Detalle', 1, 0, '#ffffff', '#efefef', '#ffffcc', '#C8DCF2');
</script>
<p style="margin:40px;"><a href="repartodiario.php?local=X" <?php echo 'target="_blank"';?> title="Reparto diario"><b><img src="images/excell.jpg" width='60px' height="30px"></b></a> </p>
</form>
</body>
</html>
</section>

        </div>

        <!-- bootstrap js -->
        <!--<script src="js/bootstrap/bootstrap.min.js"></script>-->
        <script src="js/bootstrap/3.3.7/bootstrap.min.js"></script>
         
        <!-- fontawesome js -->
        <script src="css/fontawesome/5.0.8/fa-solid.js"></script>
        <script src="css/fontawesome/5.0.8/fontawesome.js"></script>
        <!-- chosen js -->
        <script src="js/chosen/chosen.jquery.min.js"></script>

        <!-- JQuery Datatables Js --><!-- Tabla responsiva -->
       <!--<script src="js/DataTables/jquery.dataTables.min.js"></script> -->
        <script src="js/actual/jquery.dataTables.min.js"></script>
        <script src="js/DataTables/dataTables.bootstrap.js"></script>

        <script src="js/actual/dashboard.js"></script>
        
    </body>
</html>


    <div class="modal fade" id="daryzaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content pedidos-modal-content">
                <div class="modal-header pedidos-modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Detalle</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function loadModalDaryza(daryza_id){
            console.log(daryza_id);
            $('.modal-body').load('daryzaModal.php?indice='+daryza_id,function(){
                $('#daryzaModal').modal({show:true});
            });
        }
    </script>
    <script type="text/javascript">
        // $('#example2').dataTable({
        //   "bPaginate": false, 
        // })
    </script>