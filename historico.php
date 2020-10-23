<?php 
session_start(); 
if ( !isset($_SESSION["ID"])  ){
   header("Location: FIN_CONEXION.php");
}

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
	
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	<!-- <link type="image/x-icon" href="favicon.ico" rel="icon" /> -->
	<link type="image/x-icon" href="favicon.ico" rel="shortcut icon" />
    <!-- <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/bootstrap/3.3.7/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/bootstrap/3.3.7/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/chosen/chosen.css">
    <link rel="stylesheet" href="css/estilos-daryza.css">
    <!-- fontawesome css -->
    <link rel="stylesheet" href="css/fontawesome/5.0.8/fa-solid.css">
    <link rel="stylesheet" href="css/fontawesome/5.0.8/fontawesome.css">
    <!-- Jquery Datatables Css --><!-- Tabla responsiva -->
    <link href="css/DataTables/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="css/DataTables/responsive.dataTables.min.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery/jquery.min.js"></script>
</head>
<body>
        
<?php
$operacion='';
$cmp='';
//if($_POST['valorT'] == "test"){
  //  echo "<script>console.log('Debug Objects: " . "Recivido" . "' );</script>";
//}
if( ! empty($_POST)){

    echo "<script>console.log('Debug Objects: " . "NO VACIOaa" . "' );</script>";
    
    $valor=$_POST['valor'];
    $vdesde=$_POST['vdesde'];
    $vdesde=date("Y-m-d",strtotime($vdesde));
    $vhasta=$_POST['vhasta'];
    $vhasta=date("Y-m-d",strtotime($vhasta));
    $vcampo=$_POST['selectedCampo'];
    echo "<script>console.log('Debug Objects: " . $vhasta . "' );</script>";
    switch ($vcampo) {
                case 'Terminal':
                    $cmp="p.codproducto";
                    break;
                case 'Zona':
                    $cmp="p.refcliente";
                    break;
                case 'Distrito':
                    $cmp="p.distcliente";
                    break;
                case 'Nombre':
                    $cmp="p.cliente";
                    break;
                case 'Estado':
                    $cmp="p.estado";
                    break;
                case 'Caso':
                    $cmp="p.caso";
                    break;
    }
    if(!empty($vcampo) && !empty($valor)){
            $operacion=" and ".$cmp." like '%".$valor."%' ";    
    }
    #$cmps="p.numpedido,p.idpedido,p.documento,left(p.cliente,30),p.volumen,left(p.distcliente,15),p.estado,p.fecentrega,p.horentrega,left(p.localpedido,25),p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fechaprog,p.peso,p.aux1,p.orden,p.aux3,p.aux1,left(p.dircliente,30),left(p.refcliente,25),p.observacion,p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back";
    $cmps="p.detalle, p.documento,p.codproducto, p.cliente, p.refcliente, p.distcliente, p.horentrega, p.estado, p.latitud,p.longitud, p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back, p.fechaprog";
    $tabl="intralot.pedidos p inner join ddaryza.estados e on p.estado=e.estado";
    $query = "select ".$cmps." from ".$tabl." where p.fechaprog between '".$vdesde."' and '".$vhasta."'".$operacion." order by p.fechaprog desc,p.placa,p.orden;";
    $result = mysql_query($query);
}else{
    echo "<script>console.log('Debug Objects: " . "VACIO000 POR DEFECTO" . "' );</script>";
    $cmps="p.detalle, p.documento,p.codproducto, p.cliente, p.refcliente, p.distcliente, p.horentrega, p.estado, p.latitud,p.longitud,p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back, p.fechaprog";
    $tabl="intralot.pedidos p inner join ddaryza.estados e on p.estado=e.estado";
    $cond="p.fechaprog=current_date";
    $query = "select ".$cmps." from ".$tabl." where ".$cond." order by p.fechaprog desc, p.placa,p.orden ; ";
    $result = mysql_query($query);
}
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
                                                                  <li><a href="estadistica_actual.php">Por Zona</a></li>
                                                                  <li><a href="est_his.php">Por Periodo</a></li>
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
                                <div class="col-md-3">
                                    <label class="col-sm-4 control-label">Desde:</label>
                                    <div class="col-sm-8">
                                        <input type='date' id='vdesde' name='vdesde' value='<?=( !empty($vdesde) ? $vdesde : date("Y-m-d",time()-(0*24*3600)))?>'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-sm-4 control-label">Hasta:</label>
                                    <div class="col-sm-8">
                                        <input type='date' id='vhasta' name='vhasta' value='<?=( !empty($vhasta) ? $vhasta : date("Y-m-d",time()-(0*24*3600)))?>'>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-md-3">
                                        <label class="col-xs-4 control-label">Campo</label>
                                        <div class="col-xs-8">
                                            <select class="form-control chosen-select" id="selectedCampo" name='selectedCampo' data-placeholder="Seleccione un campo">
                                                <option value='<?=( !empty($vcampo) ? $vcampo : '')?>' select><?=( !empty($vcampo) ? $vcampo : '')?></option>
                                                <option value="Terminal">Terminal</option>
                                                <option value="Nombre">Nombre</option>
                                                <option value="Zona">Zona</option>
                                                <option value="Distrito">Distrito</option>
                                                <option value="Estado">Estado</option>
                                                <option value="Caso">Caso</option>
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
                            <table class="table table-striped table-hover js-exportable" id="example" cellspacing="0" width="100%">
                                    <thead style="background-color:#131212f7; color:white;">
                                        <tr>
                                            <th width="10%"><center>Agente</center></th>
                                            <th width="25%"><center>Nombre</center></th>
                                            <th width="10%"><center>Reparto</center></th>
                                            <th width="5%"><center>caso</center></th>
                                            <th width="10%"><center>Zona</center></th>
                                            <th width="14%"><center>Distrito</center></th>
                                            <th width="10%"><center>Horas</center></th>
                                            <th width="10%"><center>Estado</center></th>
                                            <th width="10%"></th>
                                            <th width="10%"></th>
                                            <th width="10%"></th>
                                            <th width="10%"></th>

                                        </tr>
                                    </thead>
                                    <tbody class="tabla-pedidos">
                                        <?php foreach ($datos as $key => $value){ ?>
                                        <tr>
                                            <td class="center" align="center"><?=$value['codproducto']?></td> 
                                            <td class="center"><?=$value['cliente']?></td> 
                                            <td class="center"><?=$value['detalle']?></td> 
                                            <td class="center"><?=$value['caso']?></td> 
                                            <td class="center"><?=$value['refcliente']?></td> 
                                            <td class="center"><?=$value['distcliente']?></td> 
                                            <td class="center"><?=$value['horentrega']?></td> 
                                            <td class="center" align="center" style="background-color:<?=$value['col_back']?>;color:<?=$value['col_text'];?> !important;"><?=$value['estado']?></td> 
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
             
                                                    if($value['fot_foto'] <> ''){
                                                        $Ubic = "show_galeria_app.php?var0=".$value['documento'];
                                                        echo " <a style='color: #1a1919;' HREF=\""."javascript:void(window.open('".$Ubic."&dummy=.pdf','_blank', 'scrollbars=yes,toolbar=no,resizable=yes,menubar=no,location=no'))\""."><i class='fas fa-camera'></i></a>";
                                                        // echo "</td>";
                                                    } else {
                                                        echo "<a></a>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php 
                                                    
                                                        if($value['estado'] == "En Ruta"){
                                                    ?>
                                                        <a  style="color: #1a1919;" href="javascript:loadModalReprogramar(<?=$value['Id']?>);"><i class="fas fa-history"></i></a>
                                                    <?php
                                                        }
                                                    ?>
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

<?php 
$reportePedidos = "repartodiarioAux.php?local=historicoPedidos&desdeAux=".$vdesde."&hastaAux=".$vhasta;
$reporteMateriales = "repartodiarioAux.php?local=historicoMateriales&desdeAux=".$vdesde."&hastaAux=".$vhasta;
?>

<p style="margin-left:35px;;display:inline;">
    <a href="<?php echo $reportePedidos; ?>" <?php echo 'target="_blank"';?> title="Reparto diario">
        <button type="submit" class="btn btn-success" style="width:200px">
            <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>  Reporte Pedidos
        </button>
    </a>
</p>
<p style="margin-left:30px;display:inline;">
    <a href="<?php echo $reporteMateriales; ?>" <?php echo 'target="_blank"';?> title="Reparto diario">
        <button type="submit" class="btn btn-success" style="width:200px">
            <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>  Reporte Materiales
        </button>
    </a>
</p>




<?php
echo "<script>console.log('Debug Objectssss hasta: " . $vdesde . "' );</script>";
echo "<script>console.log('Debug Objectssss hasta: " . $vhasta . "' );</script>";
$url='repartodiarioAux.php?tipo="historico"&desde="'.$vdesde.'"&hasta="'.$vhasta.'"&campo="'.$vcampo.'"&valor="'.$valor.'"';


echo "<script>console.log('Debug Objectssss hasta: " . $url . "' );</script>";
?>	
<p style="margin:40px;"><?php echo '<a href="'.$url.'"  target="_blank"';?> title="Reparto diario"><b><img src="images/excell.jpg" width='0px' height="0px"></b></a> </p>
</form>
</body>
</html>
</section>
            
        <!-- bootstrap js -->
        <!--<script src="js/bootstrap/bootstrap.min.js"></script>-->
        <script src="js/bootstrap/3.3.7/bootstrap.min.js"></script>
         
        <!-- fontawesome js -->
        <script src="css/fontawesome/5.0.8/fa-solid.js"></script>
        <script src="css/fontawesome/5.0.8/fontawesome.js"></script>
        <!-- chosen js -->
        <script src="js/chosen/chosen.jquery.min.js"></script>

        <!-- JQuery Datatables Js --><!-- Tabla responsiva -->
        <script src="js/DataTables/jquery.dataTables.min.js"></script>
        <script src="js/DataTables/dataTables.bootstrap.js"></script>

        <script src="js/dashboard.js"></script>
        
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

    <div class="modal fade" id="reprogramarModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content pedidos-modal-content">
                <div class="modal-header pedidos-modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Reprogramar</h4>
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
        function loadModalReprogramar(daryza_id){
            console.log("entre?");
            console.log(daryza_id);

            $('.modal-body').load('reprogramarModal.php?indice='+daryza_id,function(){
                $('#reprogramarModal').modal({show:true});
            });
        }
    </script>