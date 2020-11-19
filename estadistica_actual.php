<?php
session_start(); 
if ( !isset($_SESSION["ID"]) ){
    header("Location: FIN_CONEXION.php");
}
require_once "include/conexion.php";
include "filtro.php";
error_reporting(0);
if($vdesde=='' && $vhasta==''){
  $vdesde=date("Y-m-d",time()-(0*24*3600));
  $vhasta=date("Y-m-d",time()-(0*24*3600));
}
if(!empty($_POST)){
  $vdesde=$_POST['vdesde'];
  $vhasta=$_POST['vhasta'];
}
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
    <script src="js/jquery/jquery.min.js"></script>
</head>
<body>
       
<section class="content dashboard">
  <div class="page-body menu-body">
        <div class="panel panel-default borde">
          <div class="panel-heading" style="background-color:white; margin:10px; padding:0px">
                    
                <div class="row">
                    <div class="col-md-2">
                  <td><img src="images/logo.png"  width="60%"></td>
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
     
    </div>
  </div>
</section>

</form>
</body>
</html>
</section>
        </div>

        <!-- bootstrap js -->
        <script src="js/bootstrap/3.3.7/bootstrap.min.js"></script>
       <!-- <script src="js/bootstrap/bootstrap.min.js"></script>-->
         
        <!-- fontawesome js -->
        <script src="css/fontawesome/5.0.8/fa-solid.js"></script>
        <script src="css/fontawesome/5.0.8/fontawesome.js"></script>
        <!-- chosen js -->
        <script src="js/chosen/chosen.jquery.min.js"></script>

        <!-- <script src="js/dashboard.js"></script> -->
        
    </body>
</html>

<form class="form-horizontal" role="form" action="estadistica_actual.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <div class="col-md-4">
      </div>
      <div class="col-md-2">
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
      <div class="col-sm-2 col-md-1">
           <div class="col-sm-12">
               <div class="col-sm-offset-2 p-l-15">
                   <button type="submit" class="btn btn-sm btn-success">Consultar</button>
               </div>
           </div>
      </div>
    </div> 
</form>

<?php
$keys = ['zona', 'Entregado', 'Parcial', 'No entregado', 'Proceso', 'En Ruta', 'Reprogramado'];

$cmps="p.refcliente, 
sum(if(p.estado='Entregado' or p.estado='Entregado',1,0)), 
sum(if(p.estado='Parcial',1,0)),
sum(if(p.estado='No Entregado',1,0)), 
sum(if(p.estado='Llegada' or p.estado='Inicio' or p.estado='Retorno',1,0)),
sum(if(p.estado='En Ruta',1,0)),
sum(if(p.estado='ReProgramado',1,0))";
$from="intralot.pedidos p";
$cond="date(p.fechaprog) between '".$vdesde."' and '".$vhasta."' ";
$query="select ".$cmps." from ".$from."  where ".$cond." group by p.refcliente order by p.placa;";

$result = mysql_query($query);
if (!$result) {
  die('Error query: ' . mysql_error());
  $num_rows = mysql_num_rows($result);
  echo "$num_rows Rows\n";
}
$NO=0;
while ($row = mysql_fetch_array($result)) {
  $NO++;
  // Datos del grafico de barras
  $values = "['".$row[0]."',".$row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5].",".$row[6]."],";
  $CADE_D[$NO]  =  $values;
  $dataBarra[$NO] = array_combine($keys, array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]));

}
// echo "<script> console.log('El no es', ". $NO . ") </script>";
$cmps="
sum(if(p.estado='Entregado' or p.estado='Entregado',1,0)), 
sum(if(p.estado='Parcial',1,0)),
sum(if(p.estado='No Entregado',1,0)), 
sum(if(p.estado='Llegada' or p.estado='Inicio' or p.estado='Retorno',1,0)),
sum(if(p.estado='En Ruta',1,0)),
sum(if(p.estado='ReProgramado',1,0))
";
$from="intralot.pedidos p";
$cond="date(p.fechaprog) between '".$vdesde."' and '".$vhasta."' ";
$query2="select ".$cmps." from ".$from."  where ".$cond." ;";

$result2 = mysql_query($query2);
if (!$result2) {
  die('Error query: ' . mysql_error());
  $num_rows = mysql_num_rows($result2);
  echo "$num_rows Rows\n";
}
while ($row = mysql_fetch_array($result2)) {
  // Datos del grafico de dona
  $CADE_DO     = "['Entregado',".$row[0]."],['Parcial',".$row[1]."],['No Entregado',".$row[2]."],['Proceso',".$row[3]."],['En Ruta',".$row[4]."],['Reprogramado',".$row[5]."]";
}

$qest="select estado , count(estado) cant from intralot.pedidos where (fechaprog  between '".$vdesde."' and '".$vhasta."')  group by estado;";
$rest=mysql_query($qest);
 
$qzon="select Estado,sum(if(p.refcliente='Lima Norte',1,0)) as 'Lima Norte', sum(if(p.refcliente='Lima Oeste',1,0)) as 'Lima Oeste', sum(if(p.refcliente='Lima Centro',1,0)) as 'Lima Centro', sum(if(p.refcliente='Lima Este I',1,0)) as 'Lima Este I', sum(if(p.refcliente='Lima Este II',1,0)) as 'Lima Este II', sum(if(p.refcliente='Lima Sur',1,0))  as 'Lima Sur' from intralot.pedidos p where date(p.fechaprog) between '".$vdesde."' and '".$vhasta."' group by estado;";
$rzon=mysql_query($qzon);
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart1);
      var chart_d ;

      function drawChart1() {
        var d_docs = google.visualization.arrayToDataTable([
          ['Estado', 'Cant.Docs'],
          <?php    
            echo $CADE_DO;
          ?>
        ]);
      var options = {
          pieHole: 0.4,
          pieSliceTextStyle : {fontSize: 12},
          width: 300,
          height: 200 ,
          legend: { position: "top" },
          chartArea: {height: '90%'},          
          colors: ['#0040FF','#01DF01','#DF0101','#f98C07','#CEECF5', '#f97a7a'],  
          hAxis: {textStyle: {color: '#01579b', fontSize: '9', fontName: 'Verdana', bold: true}},
          vAxis: {textStyle: {color: '#1a237e', fontSize: '10', bold: true }},            
        };
      chart_d = new google.visualization.PieChart(document.getElementById('donut_docs'));
      chart_d.draw(d_docs, options);

      }
    </script>
    
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);
      var chart_docs;

      function drawChart() {    
        var data_docs = new google.visualization.DataTable();
        data_docs.addColumn('string', 'Zonas');
        data_docs.addColumn('number', 'Entregado');
        data_docs.addColumn('number', 'Parcial');
        data_docs.addColumn('number', 'No Entregado');
        data_docs.addColumn('number', 'Proceso');
        data_docs.addColumn('number', 'En Ruta');      
        data_docs.addColumn('number', 'Reprogramado');      
        data_docs.addRows([
        <?php
         for ($i=1;$i<=$NO;$i++){
            echo $CADE_D[$i];          
          }
        ?>
        ]);

        var options2 = {
          hAxis: {textStyle: {color: '#01579b', fontSize: '9', fontName: 'Verdana', bold: true}},
          vAxis: {textStyle: {color: '#1a237e', fontSize: '10', bold: true }},
          legend: { position: 'top', maxLines: 2, textStyle: {color: 'black', fontSize: 9}},
          bar: { groupWidth: '80%' },
          isStacked: true,
          colors: ['#0040FF','#01DF01','#DF0101','#f98C07','#CEECF5','#f97a7a'],    
          
       };
      chart_docs = new google.visualization.ColumnChart( document.getElementById('d_docs'));
      chart_docs.draw(data_docs, options2);

      }
    </script>
      
      
    
  </head>
  <body>
    <table align='center' width="95%">
      <tr>
        <td  align='center' colspan='2' style="background-color:#DCEDF0"><h4>Estados General</h4>
        <div id="zonas" class="zonas">
            <div class="zona">
                <label for="entregado">Entregado
                    <input class="checkZona" type="checkbox" name="zona[]" value="Entregado" id="entregado" checked>
                </label>
            </div>
            <div class="zona">
                <label for="parcial">Parcial
                    <input class="checkZona" type="checkbox" name="zona[]" value="Parcial" id="parcial" checked>
                </label>
            </div>
            <div class="zona">
                <label for="noEntregado">No-Entregado
                    <input class="checkZona" type="checkbox" name="zona[]" value="No entregado" id="noEntregado" checked>
                </label>
            </div>
            <div class="zona">
                <label for="proceso">Proceso
                    <input class="checkZona" type="checkbox" name="zona[]" value="Proceso" id="proceso" checked>
                </label>
            </div>
            <div class="zona">
                <label for="enRuta">En-Ruta
                    <input class="checkZona" type="checkbox" name="zona[]" value="En Ruta" id="enRuta" checked>
                </label>
            </div>
            <div class="zona">
                <label for="Reprogramado">Reprogramado
                    <input class="checkZona" type="checkbox" name="zona[]" value="Reprogramado" id="Reprogramado" checked>
                </label>
            </div>

          </div>
          </td>
      </tr>
      <tr>
        <td>
          
        </td>
      </tr>
      <tr>
        <td><div id="donut_docs" style="width: 300px; height: 200px;"></div></td>
        <td><div id="d_docs" style="width: 90%; height: 55vh;"></div></td>
      </tr>
      <tr style="font-weight: bold; text-transform: uppercase;">
        <td align='center'>Total</td>
        <td align='center'>Por Zonas</td>
      </tr>
      <tr>
        <td><center>
          <table class="table" width="60%" align="center">
            <th>
              <tr style="font-weight: bold;"><td align="left">Estado</td><td align="center">Total</td></tr>
            </th>
            <?php
            while ($row = mysql_fetch_array($rest)) {
            ?>
              <tr class="<?php echo str_replace(' ', '', $row[0]) ?>" >
              <td align='left' bgcolor> <?php echo $row[0] ?> </td>
              <td align='center'> <?php echo $row[1] ?> </td>
              </tr>
            <?php
            }
            ?>
          </table>
          </center>
        </td>
        <td><center>
          <table class="table" width="60%" align="center" space='4'>
            <th>
              <tr><td align="center"></td><td align="center">Lima Norte</td><td align="center">Lima Oeste</td><td align="center">Lima Centro</td><td align="center">Lima Este I</td><td align="center">Lima Este II</td><td align="center">Lima Sur</td></tr>
            </th>
            <?php
            while ($row = mysql_fetch_array($rzon)) {
              // var_dump($row);
              ?>
              <tr class="<?php echo str_replace(' ', '', $row[0]) ?>" >
              <td  align='center' bgcolor></td>
              <td align='center'> <?php echo $row[1] ?></td>
              <td align='center'> <?php echo $row[2] ?> </td>
              <td align='center'> <?php echo $row[3] ?></td>
              <td align='center'><?php echo $row[4] ?></td>
              <td align='center'><?php echo $row[5] ?></td>
              <td align='center'><?php echo $row[6] ?></td>
              </tr>
              
              <?php
            }
            ?>
          </table>
          </center>
        </td>
      </tr>

    </table>
<BR>

  </body>

  <script>
    $(document).ready(function () {
        // console.log("TEST ====>")
        
        $('input:checkbox').on('click', function()  {  
          console.log("change")
          var checked = [];
          $("input[name='zona[]']:checked").each(function () {
              checked.push($(this).val());
          });
          console.log(checked)

          var data = <?php echo json_encode($dataBarra); ?> 
          console.log("Enviada")
          console.log(data)
          var parametros = {
              "checked" : checked,
              "dataBarra" : data,
            };
          $.ajax({
            type: 'POST',
            url: 'filtroBusqueda.php',
            data:   parametros,
            dataType: 'json',
            // cache: false,
            success: function(response) {
              console.log("respuesta")
              console.log(response)

              var arr = [];
              for (i in response){
                var tmp = []  
                // console.log("lleg ", response[i].Proceso)
                tmp.push(response[i].zona );
                if(response[i].Entregado != undefined){
                  tmp.push( response[i].Entregado);
                  $('.Entregado').removeClass("ocultar") 
                }else $('.Entregado').addClass("ocultar");
                if(response[i].Parcial != undefined){
                  $('.Parcial').removeClass("ocultar") 
                  tmp.push( response[i].Parcial);
                }else $('.Parcial').addClass("ocultar");
                if(response[i].Noentregado != undefined){
                  tmp.push( response[i].Noentregado);
                  $('.NoEntregado').removeClass("ocultar") 
                }else $('.NoEntregado').addClass("ocultar");
                if(response[i].Proceso != undefined){
                  tmp.push( response[i].Proceso);
                  $('.Proceso').removeClass("ocultar") 
                }else $('.Proceso').addClass("ocultar");
                if(response[i].EnRuta != undefined){
                  tmp.push( response[i].EnRuta);
                  $('.EnRuta').removeClass("ocultar") 
                }else $('.EnRuta').addClass("ocultar");
                if(response[i].Reprogramado != undefined){
                  tmp.push( response[i].Reprogramado);
                  $('.Reprogramado').removeClass("ocultar") 
                }else $('.Reprogramado').addClass("ocultar");
                

                arr.push(tmp)
              }

              console.log(arr)
              var result = arr
              // console.log(result)
              
              // if(checked.indexOf("Proceso") !== -1){
              //     console.log("Existe: "+checked.indexOf("Proceso"))
              // }

              // checked.Entregado != undefined ? console.log(checked.Entregado) : console.log("vEEEEEEEEEEE");
              
              google.setOnLoadCallback(drawChartv2());
              // console.log("======================================================")
              // Ocultar la tabla
              

              function drawChartv2() {    
                // console.log(result)
                var data_docs = new google.visualization.DataTable();
                data_docs.addColumn('string', 'Zonas');
                checked.indexOf("Entregado") !== -1 ? data_docs.addColumn('number', 'Entregado'): "";
                checked.indexOf("Parcial") !== -1 ? data_docs.addColumn('number', 'Parcial'): "";
                checked.indexOf("No entregado") !== -1 ? data_docs.addColumn('number', 'No Entregado'): "";
                checked.indexOf("Proceso") !== -1 ? data_docs.addColumn('number', 'Proceso'): "";
                checked.indexOf("En Ruta") !== -1 ? data_docs.addColumn('number', 'En Ruta'): "";      
                checked.indexOf("Reprogramado") !== -1 ? data_docs.addColumn('number', 'Reprogramado'): "";      
                data_docs.addRows(                  
                  result
                );
                console.log(result)
                var options2 = {
                  hAxis: {textStyle: {color: '#01579b', fontSize: '9', fontName: 'Verdana', bold: true}},
                  vAxis: {textStyle: {color: '#1a237e', fontSize: '18', bold: true }},
                  legend: { position: 'top', maxLines: 2, textStyle: {color: 'black', fontSize: 9}},
                  bar: { groupWidth: '80%' },
                  isStacked: true,
                  colors: ['#0040FF','#01DF01','#DF0101','#f98C07','#CEECF5','#f97a7a'],    
                  
                  
              };
              // chart_docs = new google.visualization.ColumnChart( document.getElementById('d_docs'));
              chart_docs.draw(data_docs, options2);

              }
              
              console.log("graficado")
            },
        });
          
        }); 
        
      });
    // });
  </script>
</html>
