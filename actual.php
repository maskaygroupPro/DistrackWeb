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
<meta http-equiv="refresh" content="60"/>
<head>	
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	<!-- <link type="image/x-icon" href="favicon.ico" rel="icon" /> -->
	<link type="image/x-icon" href="favicon.ico" rel="shortcut icon" />
    <!-- <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css"> -->
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
    <meta http-equiv="refresh" content="60">
</head>
<body>
        
<?php
$operacion='';
$cmp='';
if(isset($_SESSION['priv_filtro'])){
    $priv_filtro = " and ".$_SESSION['priv_filtro']." ";
    
}
else{
    $priv_filtro = "";
}
if( ! empty($_POST)){
    $valor=$_POST['valor'];
    $vcampo=$_POST['selectedCampo'];
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
                    $cmp="l.caso";
                    break;
                case 'Descripcion':
                    $cmp="l.descripcion";
                        break;
    

    }

    if(!empty($vcampo) && !empty($valor)){
                $operacion=" and ".$cmp." like '%".$valor."%' ";    
    }
    if($cmp == "l.descripcion"){
        #$cmps="p.numpedido,p.idpedido,p.documento,left(p.cliente,30),p.volumen,left(p.distcliente,20),p.estado,p.fecentrega,p.horentrega,left(p.localpedido,25),p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fechaprog,p.peso,p.aux1,p.orden,p.aux3,p.aux1,left(p.dircliente,30),p.producto,p.observacion,p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back";
        $cmps="l.caso as caso_real, p.* ,p.indice as Id,e.col_text, e.col_back"; 
        
        $tabl="intralot.pedidos p inner join ddaryza.estados e on p.estado=e.estado left join intralot.prg_logisticos l on l.terminal=p.numpedido and l.fechaprog=p.fechaprog";
        
        $cond="p.fechaprog=current_date";
        $query="";
        $query = "select ".$cmps." from ".$tabl." where ".$cond.$operacion.$priv_filtro." order by p.placa,p.orden;";
        //echo $query;
        
        // var_dump($query);exit();
        $result = mysql_query($query);


    }else if($cmp == "l.caso"){
        #$cmps="p.numpedido,p.idpedido,p.documento,left(p.cliente,30),p.volumen,left(p.distcliente,20),p.estado,p.fecentrega,p.horentrega,left(p.localpedido,25),p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fechaprog,p.peso,p.aux1,p.orden,p.aux3,p.aux1,left(p.dircliente,30),p.producto,p.observacion,p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back";
        $cmps="l.caso as caso_real, p.* ,p.indice as Id,e.col_text, e.col_back"; 
        
        $tabl="intralot.pedidos p inner join ddaryza.estados e on p.estado=e.estado left join intralot.prg_logisticos l on l.terminal=p.numpedido and l.fechaprog=p.fechaprog";
        
        $cond="p.fechaprog=current_date";
        $query="";
        $query = "select ".$cmps." from ".$tabl." where ".$cond.$operacion.$priv_filtro." order by p.placa,p.orden;";
        //echo $query;
        
        // var_dump($query);exit();
        $result = mysql_query($query);

    }else{
        #$cmps="p.numpedido,p.idpedido,p.documento,left(p.cliente,30),p.volumen,left(p.distcliente,20),p.estado,p.fecentrega,p.horentrega,left(p.localpedido,25),p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fechaprog,p.peso,p.aux1,p.orden,p.aux3,p.aux1,left(p.dircliente,30),p.producto,p.observacion,p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back";
        //$cmps="l.caso as caso_real, p.* ,p.indice as Id,e.col_text, e.col_back";    ROGINIAL
        $cmps="p.* ,p.indice as Id,e.col_text, e.col_back";    
        //$tabl="intralot.pedidos p inner join ddaryza.estados e on p.estado=e.estado left join intralot.prg_logisticos l on l.terminal=p.numpedido and l.fechaprog=p.fechaprog";ORIGINAL
        $tabl="intralot.pedidos p inner join ddaryza.estados e on p.estado=e.estado";
        $cond="p.fechaprog=current_date";
        $query="";
        $query = "select ".$cmps." from ".$tabl." where ".$cond.$operacion.$priv_filtro." order by p.placa,p.orden;";
        //echo $query;
        
        // var_dump($query);exit();
        $result = mysql_query($query);
    }
    
/**DAVID */
    #$cmps="p.numpedido,p.idpedido,p.documento,left(p.cliente,30),p.volumen,left(p.distcliente,20),p.estado,p.fecentrega,p.horentrega,left(p.localpedido,25),p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fechaprog,p.peso,p.aux1,p.orden,p.aux3,p.aux1,left(p.dircliente,30),p.producto,p.observacion,p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back";
    //$cmps="l.caso as caso_real, p.* ,p.indice as Id,e.col_text, e.col_back";    
    //$tabl="intralot.pedidos p inner join ddaryza.estados e on p.estado=e.estado left join intralot.prg_logisticos l on l.terminal=p.numpedido and l.fechaprog=p.fechaprog";
    //$cond="p.fechaprog=current_date";
    //$query="";
    //$query = "select ".$cmps." from ".$tabl." where ".$cond.$operacion.$priv_filtro." order by p.placa,p.orden;";
    //echo $query;
    
    // var_dump($query);exit();
    //$result = mysql_query($query);

}else{

    #$cmps="p.numpedido,p.idpedido,p.documento,left(p.cliente,30),p.volumen,left(p.distcliente,20),p.estado,p.fecentrega,p.horentrega,left(p.localpedido,25),p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fechaprog,p.peso,p.aux1,p.orden,p.aux3,p.aux1,left(p.dircliente,30),p.producto,p.observacion,p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back";
    //$cmps="l.caso as caso_real,p.* ,p.indice as Id,e.col_text, e.col_back"; ORIGINAL
    $cmps="p.* ,p.indice as Id,e.col_text, e.col_back";
    $tabl="intralot.pedidos p inner join ddaryza.estados e on p.estado=e.estado";
    //$tabl="intralot.pedidos p inner join ddaryza.estados e on p.estado=e.estado left join intralot.prg_logisticos l on l.terminal=p.numpedido and l.fechaprog=p.fechaprog"; ORIGONAL
    $cond="p.fechaprog=current_date";
    $query = "select ".$cmps." from ".$tabl." where ".$cond.$priv_filtro." order by p.placa,p.orden ; ";
    $result = mysql_query($query);
//DAVID
    #$cmps="p.numpedido,p.idpedido,p.documento,left(p.cliente,30),p.volumen,left(p.distcliente,20),p.estado,p.fecentrega,p.horentrega,left(p.localpedido,25),p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fechaprog,p.peso,p.aux1,p.orden,p.aux3,p.aux1,left(p.dircliente,30),p.producto,p.observacion,p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back";
    //$cmps="l.caso as caso_real,p.* ,p.indice as Id,e.col_text, e.col_back";
    //$tabl="intralot.pedidos p inner join ddaryza.estados e on p.estado=e.estado left join intralot.prg_logisticos l on l.terminal=p.numpedido and l.fechaprog=p.fechaprog";
    //$cond="p.fechaprog=current_date";
    //$query = "select ".$cmps." from ".$tabl." where ".$cond.$priv_filtro." order by p.placa,p.orden ; ";
    //$result = mysql_query($query);
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
                                                                  <li><a href="estadistica_actual.php">Por Zonas</a></li>
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
                                                <option value="Descripcion">Descripcion</option>
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
                                            <th width="10%"><center>Agente</center></th>
                                            <th width="25%"><center>Nombre</center></th>
                                            <th width="10%"><center>Reparto</center></th>
                                            
                                            <th width="10%"><center>Zona</center></th>
                                            <th width="14%"><center>Distrito</center></th>
                                            <th width="14%"><center>Fecha Prog.</center></th>
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
                                            
                                            <td class="center"><?=$value['refcliente']?></td> 
                                            <td class="center"><?=$value['distcliente']?></td> 
                                            <td class="center"><?=$value['fechaprog']?></td> 
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
                                                        //echo "<script>console.log('Debug Objects: " . "funciona?¿" . "' );</script>";
                                                        $Ubic = "show_galeria_app.php?var0=".$value['documento'];
                                                        echo " <a style='color: #1a1919;' HREF=\""."javascript:void(window.open('".$Ubic."&dummy=.pdf','_blank', 'scrollbars=yes,toolbar=no,resizable=yes,menubar=no,location=no'))\""."><i class='fas fa-camera'></i></a>";
                                                        // echo "</td>";
                                                    } else {
                                                        echo "<a></a>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <!-- Solo se muestra la interfaz si estas en Ruta y eres Admn  -->
                                                    <?php 
                                                    
                                                        if($value['estado'] == "En Ruta" and $_SESSION['priv_filtro'] == 1){
                                                    ?>
                                                        <a  style="color: #1a1919;" href="javascript:loadModalReprogramar(<?=$value['Id']?>);"><i class="fas fa-history"></i></a>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                            </td>
                                                </form>
                                        </tr>
                                    <?php }?>                              
                                    </tbody>                        
                            </table>
                            <td class="text-center">
                            
</td>
                    </form>
					
                    <!-- <pre>
                    <?php print_r($_SESSION); ?>
                    </pre> -->
				</div>
			</div>
		</div>
	</div>
</section>
<script language="JavaScript" type="text/javascript">
	// tigra_tables('Tabla_Detalle', 1, 0, '#ffffff', '#efefef', '#ffffcc', '#C8DCF2');
</script>



<p style="margin-left:35px;;display:inline;">
    <a href="repartodiario.php?local=reportePedidos" <?php echo 'target="_blank"';?> title="Reparto diario">
        <button type="submit" class="btn btn-success" style="width:200px">
                <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>  Reporte Pedidos
        </button>
    </a>
</p>
<p style="margin-left:30px;display:inline;">
    <a href="repartodiario.php?local=reporteMateriales" <?php echo 'target="_blank"';?> title="Reparto diario">
        <button type="submit" class="btn btn-success" style="width:200px">
                <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>  Reporte Materiales
        </button>
    </a>
</p>




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
    <script type="text/javascript">
        // $('#example2').dataTable({
        //   "bPaginate": false, 
        // })
    </script>