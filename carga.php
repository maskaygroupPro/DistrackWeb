<?php 
session_start(); 
if ( !isset($_SESSION["ID"])  ){
    header("Location: FIN_CONEXION.php");
}
error_reporting(0);
require_once "include/conexion.php";
include "filtro.php";
$colcc='#CEECF5';
// foreach ($_POST as $key => $value){
//     $$key = $value;
// }
// foreach ($_GET as $key => $value){
//     $$key = $value;
// }
$colcc='#E0F8E6'; 
?>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <meta http-equiv="refresh" content="60"/> -->
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
	

    <!-- <meta http-equiv="refresh" content="60"> -->
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
                
                <div class="col-md-11">
					
				<form  enctype="multipart/form-data" id="formCargaPedido" method="post" role="form">
						<div class="form-group">
							<label for="exampleInputFile">Cargar PEDIDOS</label>
							<input type="file" name="file" id="file" size="150">
							<p class="help-block">Ingrese solo archivos .CSV</p>
							
							<button type="submit" class="btn btn-primary" style="width:150px" name="Import" value="Import" 
							id='botonSubidor'  >
								<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>  Cargar
							</button>
						</div>
					</form>
				</div>
				
			</div>
				<br>
				<br>
				<br>
			<div class="row">
				
				<div class="col-md-11">
					<div class="col-md-3">
											
						<form id="formCargaConsumibles" enctype="multipart/form-data" method="post" role="form">
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
											
						<form id="formCargaLogisticos" enctype="multipart/form-data" method="post" role="form">
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

					


					<form id="formCargaInstantaneas" enctype="multipart/form-data" method="post" role="form">

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

<!-- <script>
		$(document).ready(function() {     
			$('#botonSubidor').click(hola);

			function hola (){
           	 console.log('-------------------------')
        	}
		})
			

		function uploadAjax(){

			console.log('heyyyyyyyyyyyyyy')

		}
	</script> -->
	<script type="text/javascript">
        function loadModalDaryza(daryza_id){
            console.log(daryza_id);
            $('.modal-body').load('daryzaModal.php?indice='+daryza_id,function(){
                $('#daryzaModal').modal({show:true});
            });
		}
		

		
		$( document ).ready(function(){
			$("#formCargaPedido").on("submit", function(e){
				e.preventDefault();
				$('.result').removeClass('text-danger').removeClass('text-success').text('');
				
				var f = $(this);
				var formData = new FormData(document.getElementById("formCargaPedido"));
				// formData.append("dato", "valor");
				
				// Carga el archivo
				// formData.append(f.attr("file"), $(this)[0].files);
				let fileName = f.find('input').val();

				console.log('El archivo ', fileName)
				if(fileName == '' )
				{
					$('#miModal').modal({show:true});
					$("#result").text('Debe cargar un archivo');

					// break;
				}
				else{
					
					formData.append( f.find('button').attr('value') , f.find('button').attr('value') );

					// console.log('aaaaaaaaaaaaaaa' + f.find('button').attr('value') )

					$.ajax({
						url: "cargaAjax.php",
						type: "post",
						// dataType: "html",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function () {
							console.log('beforeSend')
							
							$('#miModal').modal({show:true});
							
							// for (var value of formData.values()) {
							// 	console.log(value); 
							// }
							// Se va mostrar un mensaje ... modal
							$('#result').text('Procesando, espere por favor...');
							// $('.result').append('<img src="icons/loading.gif" /> ')
								
						},
						success:  function (response) { 
							console.log("respuestaa: " , response);
							// alert(response)
							let salida = jQuery.parseJSON(response);
							if(salida.error){
								console.log("error aqui: ");
								$("#result").addClass('text-danger')
								$("#result").text(salida.error);
							}
							if(salida.success){
								console.log(" success aqui ");
								$("#result").addClass('text-success')
								$("#result").text(salida.success);
							}
							// $('.result').removeClass('text-info').removeClass('text-danger').addClass('text-success');
							
							// setTimeout(function(){// wait for 5 secs(2)
							//     location.reload(); // then reload the page.(3)
							// }, 4000); 
							
							
						},
					});
				}
				
			});

			$("#formCargaConsumibles").on("submit", function(e){
				e.preventDefault();
				$('.result').removeClass('text-danger').removeClass('text-success').text('');
				
				var f = $(this);
				var formData = new FormData(document.getElementById("formCargaConsumibles"));
				// formData.append("dato", "valor");
				
				// Carga el archivo
				// formData.append(f.attr("file"), $(this)[0].files);
				let fileName = f.find('input').val();

				console.log('El archivo ', fileName)
				if(fileName == '' )
				{
					$('#miModal').modal({show:true});
					$("#result").text('Debe cargar un archivo');

					// break;
				}
				else{
					
					formData.append( f.find('button').attr('value') , f.find('button').attr('value') );

					// console.log('aaaaaaaaaaaaaaa' + f.find('button').attr('value') )

					$.ajax({
						url: "cargaAjax.php",
						type: "post",
						// dataType: "html",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function () {
							console.log('beforeSend')
							
							$('#miModal').modal({show:true});
							
							// for (var value of formData.values()) {
							// 	console.log(value); 
							// }
							// Se va mostrar un mensaje ... modal
							$('#result').text('Procesando, espere por favor...');
							// $('.result').append('<img src="icons/loading.gif" /> ')
								
						},
						success:  function (response) { 
							console.log("respuestaa: " , response);
							// alert(response)
							let salida = jQuery.parseJSON(response);
							if(salida.error){
								console.log("error aqui: ");
								$("#result").addClass('text-danger')
								$("#result").text(salida.error);
							}
							if(salida.success){
								console.log(" success aqui ");
								$("#result").addClass('text-success')
								$("#result").text(salida.success);
							}
							// $('.result').removeClass('text-info').removeClass('text-danger').addClass('text-success');
							
							// setTimeout(function(){// wait for 5 secs(2)
							//     location.reload(); // then reload the page.(3)
							// }, 4000); 
							
							
						},
					});
				}
				
			});

			$("#formCargaLogisticos").on("submit", function(e){
				e.preventDefault();
				$('.result').removeClass('text-danger').removeClass('text-success').text('');
				
				var f = $(this);
				var formData = new FormData(document.getElementById("formCargaLogisticos"));
				// formData.append("dato", "valor");
				
				// Carga el archivo
				// formData.append(f.attr("file"), $(this)[0].files);
				let fileName = f.find('input').val();

				console.log('El archivo ', fileName)
				if(fileName == '' )
				{
					$('#miModal').modal({show:true});
					$("#result").text('Debe cargar un archivo');

					// break;
				}
				else{
					
					formData.append( f.find('button').attr('value') , f.find('button').attr('value') );

					// console.log('aaaaaaaaaaaaaaa' + f.find('button').attr('value') )

					$.ajax({
						url: "cargaAjax.php",
						type: "post",
						// dataType: "html",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function () {
							console.log('beforeSend')
							
							$('#miModal').modal({show:true});
							
							// for (var value of formData.values()) {
							// 	console.log(value); 
							// }
							// Se va mostrar un mensaje ... modal
							$('#result').text('Procesando, espere por favor...');
							// $('.result').append('<img src="icons/loading.gif" /> ')
								
						},
						success:  function (response) { 
							console.log("respuestaa: " , response);
							// alert(response)
							let salida = jQuery.parseJSON(response);
							if(salida.error){
								console.log("error aqui: ");
								$("#result").addClass('text-danger')
								$("#result").text(salida.error);
							}
							if(salida.success){
								console.log(" success aqui ");
								$("#result").addClass('text-success')
								$("#result").text(salida.success);
							}
							// $('.result').removeClass('text-info').removeClass('text-danger').addClass('text-success');
							
							// setTimeout(function(){// wait for 5 secs(2)
							//     location.reload(); // then reload the page.(3)
							// }, 4000); 
							
							
						},
					});
				}
				
			});

			$("#formCargaInstantaneas").on("submit", function(e){
				e.preventDefault();
				$('.result').removeClass('text-danger').removeClass('text-success').text('');
				
				var f = $(this);
				var formData = new FormData(document.getElementById("formCargaInstantaneas"));
				// formData.append("dato", "valor");
				
				// Carga el archivo
				// formData.append(f.attr("file"), $(this)[0].files);
				let fileName = f.find('input').val();

				console.log('El archivo ', fileName)
				if(fileName == '' )
				{
					$('#miModal').modal({show:true});
					$("#result").text('Debe cargar un archivo');

					// break;
				}
				else{
					
					formData.append( f.find('button').attr('value') , f.find('button').attr('value') );

					// console.log('aaaaaaaaaaaaaaa' + f.find('button').attr('value') )

					$.ajax({
						url: "cargaAjax.php",
						type: "post",
						// dataType: "html",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function () {
							console.log('beforeSend')
							
							$('#miModal').modal({show:true});
							
							// for (var value of formData.values()) {
							// 	console.log(value); 
							// }
							// Se va mostrar un mensaje ... modal
							$('#result').text('Procesando, espere por favor...');
							// $('.result').append('<img src="icons/loading.gif" /> ')
								
						},
						success:  function (response) { 
							console.log("respuestaa: " , response);
							// alert(response)
							let salida = jQuery.parseJSON(response);
							if(salida.error){
								console.log("error aqui: ");
								$("#result").addClass('text-danger')
								$("#result").text(salida.error);
							}
							if(salida.success){
								console.log(" success aqui ");
								$("#result").addClass('text-success')
								$("#result").text(salida.success);
							}
							// $('.result').removeClass('text-info').removeClass('text-danger').addClass('text-success');
							
							// setTimeout(function(){// wait for 5 secs(2)
							//     location.reload(); // then reload the page.(3)
							// }, 4000); 
							
							
						},
					});
				}
				
			});



		});
    </script>
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
	
	<div class="modal fade" id="miModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">×</span>
						<span class="sr-only">Cerrar</span>
					</button>
					<h4 class="modal-title" id="myModalLabel"> Info </h4>
				</div>
				
				<!-- Modal Body -->
				<div class="modal-body">
					<div id="result" > </div>
				</div>
				
				<!-- Modal Footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
					
				</div>
			</div>
		</div>
	</div>
    

