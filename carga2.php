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
        
<script language="JavaScript" type="text/javascript">
	// tigra_tables('Tabla_Detalle', 1, 0, '#ffffff', '#efefef', '#ffffcc', '#C8DCF2');
</script>


<?php 
if(isset($_POST["Import"]))
{
    //First we need to make a connection with the database
    $host='localhost'; // Host Name.
    $db_user= 'root'; //User Name
    $db_password= '';
    //$db= 'bdtest'; // Database Name.
    $conn=mysql_connect($host,$db_user,$db_password) or die (mysql_error());
    //mysql_select_db($db) or die (mysql_error());
    $filename=$_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");
        //$sql_data = "SELECT * FROM prod_list_1 ";
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            //print_r($emapData);
            //exit();
            $sql = "INSERT into bdtest.pedidos(valor1,valor2,valor3) values ('$emapData[0]','$emapData[1]','$emapData[2]')";
            mysql_query($sql);

            $sql2 = "INSERT into bdtest2.estados(valor11,valor22,valor33) values ('$emapData[3]','$emapData[4]','$emapData[5]')";
            mysql_query($sql2);
            
        }
        fclose($file);
        echo 'Se Cargo Correctamente';

        //header('Location: carga2.php');
    }
    else
        echo 'Invalid File:Please Upload CSV File';
}
?>



<form enctype="multipart/form-data" method="post" role="form">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="file" id="file" size="150">
        <p class="help-block">Only Excel/CSV File Import.</p>
    </div>
    <button type="submit" class="btn btn-default" name="Import" value="Import">Upload</button>
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
    