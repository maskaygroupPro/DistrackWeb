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
<script language="JavaScript" type="text/javascript"></script>

<!-- Cabecera de documento -->
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
		</div>
	</div>
	<div class="panel-body">
		<div class="panel-body p-b-25">
			<div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-11">
					<?php 
					
				if(isset($_POST["Import"]))
				{
					echo "Cargando pedido";
					$filename=$_FILES["file"]["tmp_name"];
					if($_FILES["file"]["size"] > 0)
					{
						echo "enviando pedido";
						$file = fopen($filename, "r");
						$emapData = fgetcsv($file, 10000, ",");
						$cont = true;
						while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
						{
							if($cont){
								$cont=false;
								$query9="call intralot.ProgramarMateriales(".$emapData[1].")";
								$result=mysql_query($query9) or die(mysql_error());  //die muestra el error y sale
								//call intralot.ProgramarMateriales($emapData[1]);
							}
							$numPedido_ = $emapData[0];
							$fechaProg_ = $emapData[1];
							$idPedido_ = $numPedido_ .".". date("ymd", strtotime($fechaProg_));
							$localPedido_ = "";
							$cantidad_ = "0";
							$volumen_ = "0";
							
							$cliente_ = "";
							$telfCliente_ = "";
							$dirCliente_ = "";
							$disCliente_ = "";
							$refCliente_ = "";
							$clase_ = "";
							$lat_prg_ = "";
							$lon_prg_ = "";
							$rad_prg_ = "";

							$queryAux = "SELECT d.nombre,d.direccion,d.distrito,d.region,d.cod_zona,d.latitud,d.longitud,d.radio  FROM intralot.terminales as d WHERE d.terminal = "."'".$numPedido_."'";
							$ress = mysql_query($queryAux);
							while($row = mysql_fetch_array($ress)) {
								$cliente_ =  $row["nombre"];
								$dirCliente_ =  $row["direccion"];
								$disCliente_ =  $row["distrito"];
								$refCliente_ =  $row["region"];
								$clase_ = $row["cod_zona"];
								$lat_prg_ = $row["latitud"];
								$lon_prg_ = $row["longitud"];
								$rad_prg_ = $row["radio"];
							} 
						  
						  
							
							$codProducto_ = $emapData[0];
							$placa_ = $emapData[2];
							$orden_ = $emapData[3];
							$documento_ = $numPedido_ .".". date("ymd", strtotime($fechaProg_));
							$estado_ = "En Ruta";
							$idPlaca_ = "";
							
							$queryAuxx = "SELECT d.VehicleID FROM gpslog.livedata as d WHERE d.VehicleReg = "."'".$placa_."' and d.VehicleActive='1'" ;
							$resss = mysql_query($queryAuxx);
							while($row = mysql_fetch_array($resss)) {
								$idPlaca_ =  $row["VehicleID"];  
							}
							
							$peso_ = "0";
							//$clase_ = "";
							$aux1_ = "0";
							$aux2_ = "0";
							$aux3_ = "0";
							$aux4_ = "0";
							$aux5_ = "0";
							$u_transportista_ = "";
							$queryAux = "SELECT d.usuario  FROM appdistrack.usuarios as d WHERE d.completo = "."'".$placa_."' and d.organizacion='INTRALOT'";
							$ress = mysql_query($queryAux);
							while($row = mysql_fetch_array($ress)) {
								$u_transportista_ =  $row["usuario"];
							} 

							$etapa_ = "EN RUTA";
							$corrini_ = date("Ymd", strtotime($fechaProg_))."080000";
							$corract_ = date("Ymd", strtotime($fechaProg_))."080000";;
							$molde_ = "";
							$detalle_ = $emapData[4]; //tipo de programacon
							
							$parte1 = "intralot.pedidos(numpedido,idpedido,localpedido,fechaprog,cantidad,volumen,cliente,telfcliente,dircliente,distcliente,refcliente,codproducto,placa,orden,documento,estado,idplaca,peso,clase,aux1,aux2,aux3,aux4,aux5,u_transportista,lat_prg,lon_prg,rad_prg,etapa,corrini,corract,molde,detalle)"; 
							$parte2 = "('$numPedido_','$idPedido_','$localPedido_','$fechaProg_','$cantidad_','$volumen_','$cliente_','$telfCliente_','$dirCliente_','$disCliente_','$refCliente_','$codProducto_','$placa_','$orden_','$documento_','$estado_','$idPlaca_','$peso_','$clase_','$aux1_','$aux2_','$aux3_','$aux4_','$aux5_','$u_transportista_','$lat_prg_','$lon_prg_','$rad_prg_','$etapa_','$corrini_','$corract_','$molde_','$detalle_')";
							$sql = "INSERT into $parte1 values $parte2 ";
							$resultado1 = mysql_query($sql);

							$clienteMoli = $orden_." ".$cliente_;

							$parte11 = "molitalia.pedidos(estado,codproducto,placa,orden,documento,u_transportista,numpedido,idpedido,localpedido,fechaprog,cantidad,volumen,cliente,telfcliente,dircliente,distcliente,refcliente,peso,molde,detalle)"; 
							$parte22 = "('$estado_','$codProducto_','$placa_','$orden_','$documento_','$u_transportista_','$numPedido_','$idPedido_','$localPedido_','$fechaProg_','$cantidad_','$volumen_','$clienteMoli','$telfCliente_','$dirCliente_','$disCliente_','$refCliente_','$peso_','INTRALOT','$detalle_')";

							$sql2 = "INSERT into $parte11 values $parte22";
							$resultado2 = mysql_query($sql2);
							if($resultado1 && $resultado2){
								echo "todo correcto";
							}
							else{
								echo "ocurio un error en la terminal ".$numPedido_;
								break;
							}

						}
						fclose($file);
						echo 'Se Cargo correctamente pedidos';
						header('Location: carga.php');
					}
					else
					echo 'Pedidos: Formato no aceptado, solo .CSV'; 
				 
				}
				?>
					<form action="carga.php" enctype="multipart/form-data" method="post" role="form">
						<div class="form-group">
							<label for="exampleInputFile">Cargar PEDIDOS</label>
							<input type="file" name="file" id="file" size="150">
							<p class="help-block">Ingrese solo archivos .CSV</p>
							<button type="submit" class="btn btn-primary" style="width:150px" name="Import" value="Import">
								<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>  Cargar
							</button>
						</div>
					</form>
				</div>
				<div class="col-md-1">
				</div>
			</div>
				<br>
				<br>
				<br>
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-11">
					<div class="col-md-3">
											<?php 
							//CARGAR CONSUMIBLES
							if(isset($_POST["Import2"]))
							{
								$filename=$_FILES["file"]["tmp_name"];
								if($_FILES["file"]["size"] > 0)
								{
									$file = fopen($filename, "r");
									$emapData = fgetcsv($file, 10000, ",");
									while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
									{
										$codeReparto_ = $emapData[1].".".date("ymd", strtotime($emapData[0]));
										$fechaProg_ = $emapData[0];
										$terminal_ = $emapData[1];
										$nombre_ = "";
										$placa_ = "";
										$queryAux = "SELECT d.cliente, d.placa  FROM intralot.pedidos as d WHERE d.numpedido = "."'".$terminal_."' and d.fechaprog='".$fechaProg_."'";
										$ress = mysql_query($queryAux);
										if($row = mysql_fetch_array($ress)){
											$nombre_ =  $row["cliente"];
											$placa_ =  $row["placa"];
										}
										$item3926_ = $emapData[2];
										$item4788_ = $emapData[3];
										$item5667_ = $emapData[4];
										$item5669_ = $emapData[5];
										$item5668_ = $emapData[6];
										$item0915_ = $emapData[7];
										$item0861_ = $emapData[8];
										$item2587_ = $emapData[9];
									
										$parte1 = "intralot.prg_consumibles(codreparto,fechaprog,terminal,nombre,item3926,item4788,item5667,item5669,item5668,item0915,item0861,item2587,placa)"; 
										$parte2 = "('$codeReparto_','$fechaProg_','$terminal_','$nombre_','$item3926_','$item4788_','$item5667_','$item5669_','$item5668_','$item0915_','$item0861_','$item2587_','$placa_')";
										$sql = "INSERT into $parte1 values $parte2 ";
										mysql_query($sql);

									}
									fclose($file);
									echo 'Se Cargo correctamente consumibles';
									header('Location: carga.php');
								}
								else
									
									echo 'Consumible: Formato no aceptado, solo .CSV';  

							}
							?>
						<form action="carga.php" enctype="multipart/form-data" method="post" role="form">
							<div class="form-group">
								<label for="exampleInputFile">EXCEL CONSUMIBLES</label>
								<input type="file" name="file" id="file" size="150">
								<p class="help-block">Ingrese solo archivos .CSV</p>
							</div>
							<button type="submit" class="btn btn-primary" style="width:150px" name="Import2" value="Import2">
							<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>  Cargar
							</button>
						</form>
					</div>
					<div class="col-md-3">
											<?php 

						//CARGAR LOGISTICO
						if(isset($_POST["Import3"]))
						{
							$filename=$_FILES["file"]["tmp_name"];
							
							if($_FILES["file"]["size"] > 0)
							{
								
								$file = fopen($filename, "r");
								
								$emapData = fgetcsv($file, 10000, ",");
								while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
								{
									$fechaProg_ = $emapData[0];
									$terminal_ = $emapData[1];
									$codigo_ = $emapData[2];
									$cantidad_ = $emapData[3];
									$descripcion_ = $emapData[4];
									$caso_ = $emapData[5];

									$nombre_ = "";

									$placa_ = "";
									$queryAux = "SELECT d.placa  FROM intralot.pedidos as d WHERE d.numpedido = "."'".$terminal_."' and d.fechaprog='".$fechaProg_."'";
									$ress = mysql_query($queryAux);
									if($row = mysql_fetch_array($ress)){
										$placa_ =  $row["placa"];
									}

									$codReparto_ = $emapData[1].".".date("ymd", strtotime($emapData[0]));
									
									$parte1 = "intralot.prg_logisticos(terminal,nombre,cantidad,descripcion,caso,fechaprog,placa,codreparto)"; 
									$parte2 = "('$terminal_','$nombre_','$cantidad_','$descripcion_','$caso_','$fechaProg_','$placa_','$codReparto_')";
									$sql = "INSERT into $parte1 values $parte2 ";
									mysql_query($sql);

								}
								fclose($file);
								echo 'Se Cargo correctamente logisticos';
								header('Location: carga.php');
							}
							else
								
								echo 'Logistico: Formato no aceptado, solo .CSV'; 

						}
						?>
						<form action="carga.php" enctype="multipart/form-data" method="post" role="form">
							<div class="form-group">
								<label for="exampleInputFile">EXCEL LOGISTICOS</label>
								<input type="file" name="file" id="file" size="150">
								<p class="help-block">Ingrese solo archivos .CSV</p>
							</div>
							<button type="submit" class="btn btn-primary" style="width:150px" name="Import3" value="Import3">
							<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>  Cargar</button>
						</form>
					</div>
					<div class="col-md-3">

					<?php 

					//CARGAR INSTANTANEAS
					if(isset($_POST["Import4"]))
					{
						
						$filename=$_FILES["file"]["tmp_name"];
						
						if($_FILES["file"]["size"] > 0)
						{
							
							$file = fopen($filename, "r");
						
							$emapData = fgetcsv($file, 10000, ",");
							while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
							{
								$fechaProg_ = $emapData[0];
								$terminal_ = $emapData[1];
								$cod_juego_ = $emapData[2];
								$cant_libro_ = $emapData[3];
								$cant_ticket_ = $emapData[4];
								$precio_ = $emapData[5];
								$item_ = $emapData[6];
								$descripcion_ = $emapData[7];
								$orden_ = $emapData[8];

								$codReparto_ = $emapData[1].".".date("ymd", strtotime($emapData[0]));
								$nombre_ = "";
								$dato_ = $terminal_."-".$orden_;

								$placa_ = "";
								$queryAux = "SELECT d.placa  FROM intralot.pedidos as d WHERE d.numpedido = "."'".$terminal_."' and d.fechaprog='".$fechaProg_."'";
								$ress = mysql_query($queryAux);
								if($row = mysql_fetch_array($ress)){
									$placa_ =  $row["placa"];
								}

								
								$parte1 = "intralot.prg_instantaneas(codreparto,cod_juego,cant_libro,cant_ticket,precio,item,descripcion,nombre,orden,dato,fechaprog,placa)"; 
								$parte2 = "('$codReparto_','$cod_juego_','$cant_libro_','$cant_ticket_','$precio_','$item_','$descripcion_','$nombre_','$orden_','$dato_','$fechaProg_','$placa_')";
								$sql = "INSERT into $parte1 values $parte2 ";
								mysql_query($sql);

							}
							fclose($file);
							echo 'Se Cargo correctamente instantaneas';
							header('Location: carga.php');
						}
						else
							echo 'Instantaneas: Formato no aceptado, solo .CSV';
							 

					}
					?>


					<form action="carga.php" enctype="multipart/form-data" method="post" role="form">

						<div class="form-group">
							<label for="exampleInputFile">EXCEL INSTANTANEAS</label>
							<input type="file" name="file" id="file" size="150">
							<p class="help-block">Ingrese solo archivos .CSV</p>
						</div>
						<button type="submit" class="btn btn-primary" style="width:150px" name="Import4" value="Import4">
						<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>  Cargar</button>
					</form>
				</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>

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