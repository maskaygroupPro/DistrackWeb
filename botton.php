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

<button type="submit" class="btn btn-success" style="width:200px">
	<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>  Reporte Pedidos
</button>
							
<button type="submit" class="btn btn-success" style="width:200px">
	<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>  Reporte Materiales
</button>

<button type="submit" class="btn btn-success" style="width:200px">
	<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>  Reporte Materiales
</button>

        


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