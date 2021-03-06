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

        <script src="js/dashboard.js"></script>
        
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
$cmps="p.refcliente, 
sum(if(p.estado='Entregado' or p.estado='Entregado',1,0)), 
sum(if(p.estado='Parcial',1,0)),
sum(if(p.estado='No Entregado',1,0)), 
sum(if(p.estado='Llegada' or p.estado='Inicio' or p.estado='Retorno',1,0)),
sum(if(p.estado='En Ruta',1,0))";
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
  $CADE_D[$NO]      = "['".$row[0]."',".$row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5]."],";
}
$cmps="
sum(if(p.estado='Entregado' or p.estado='Entregado',1,0)), 
sum(if(p.estado='Parcial',1,0)),
sum(if(p.estado='No Entregado',1,0)), 
sum(if(p.estado='Llegada' or p.estado='Inicio' or p.estado='Retorno',1,0)),
sum(if(p.estado='En Ruta',1,0))
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
  $CADE_DO     = "['Entregado',".$row[0]."],['Parcial',".$row[1]."],['No Entregado',".$row[2]."],['Proceso',".$row[3]."],['En Ruta',".$row[4]."]";
}

$qnoe1="select left(motivo,20), count(indice) as cant from alcha.pedidos where (fechaprog between '".$vdesde."' and '".$vhasta."') and estado='No Entregado' group by motivo order by cant desc;";
$qnoe2="select zona, count(indice) as cant from alcha.pedidos where (fechaprog between '".$vdesde."' and '".$vhasta."') and estado='No Entregado' group by zona order by cant desc;";
$qnoe3="select distrito, count(indice) as cant from alcha.pedidos where (fechaprog between '".$vdesde."' and '".$vhasta."') and estado='No Entregado' group by distrito order by cant desc;";

$rnoe1=mysql_query($qnoe1);
$rnoe2=mysql_query($qnoe2);
$rnoe3=mysql_query($qnoe3);

while ($anoe1=mysql_fetch_array($rnoe1)) {
  $cad1 .= "['".$anoe1[0]."',".$anoe1[1]."],";
}
while ($anoe2=mysql_fetch_array($rnoe2)) {
  $cad2 .= "['".$anoe2[0]."',".$anoe2[1]."],";
}
while ($anoe3=mysql_fetch_array($rnoe3)) {
  $cad3 .= "['".$anoe3[0]."',".$anoe3[1]."],";
}

?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart1);
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
          colors: ['#0040FF','#01DF01','#DF0101','#f98C07','#CEECF5'],              
        };

      var chart_d = new google.visualization.PieChart(document.getElementById('donut_docs'));
      chart_d.draw(d_docs, options);

      }
    </script>
    
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
      google.setOnLoadCallback(drawChart);

      function drawChart() {    
        var data_docs = new google.visualization.DataTable();
        data_docs.addColumn('string', 'Placa');
        data_docs.addColumn('number', 'Entregado');
        data_docs.addColumn('number', 'Parcial');
        data_docs.addColumn('number', 'No Entregado');
        data_docs.addColumn('number', 'Proceso');
        data_docs.addColumn('number', 'En Ruta');      
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
          bar: { groupWidth: '70%' },
          isStacked: true,
          colors: ['#0040FF','#01DF01','#DF0101','#f98C07','#CEECF5'],    
          
       };
      var chart_docs = new google.visualization.ColumnChart(
      document.getElementById('d_docs'));
      chart_docs.draw(data_docs, options2);

      }
    </script>
      
    <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

      var data1 = google.visualization.arrayToDataTable([
        ['Motivo', 'Cantidad' ],
          <?php    
            echo $cad1;
          ?>
      ]);

      var options1 = {
        title: 'Motivos de Rechazo',
        chartArea: {
          width: '50%'
        },
        hAxis: {
          title: 'Pedidos',
          minValue: 0
        },
        vAxis: {
          title: 'Motivos'
        },
         colors: ['#DF0101']
      };




      var data2 = google.visualization.arrayToDataTable([
        ['Placa', 'Cantidad', ],
          <?php    
            echo $cad2;
          ?>
      ]);

      var options2 = {
        title: 'Placas con Rechazos',
        chartArea: {
          width: '50%'
        },
        hAxis: {
          title: 'Pedidos',
          minValue: 0
        },
        vAxis: {
          title: 'Placas'
        },
         colors: ['#DF0101']
      };



      var data3 = google.visualization.arrayToDataTable([
        ['Producto', 'Cantidad', ],
          <?php    
            echo $cad3;
          ?>
      ]);

      var options3 = {
        title: 'Productos de Rechazados',
        chartArea: {
          width: '50%'
        },
        hAxis: {
          title: 'Pedidos',
          minValue: 0
        },
        vAxis: {
          title: 'Productos'
        },
         colors: ['#DF0101']
      };

      var chart1 = new google.visualization.BarChart(document.getElementById('chart_div1'));
      chart1.draw(data1, options1);
      var chart2 = new google.visualization.BarChart(document.getElementById('chart_div2'));
      chart2.draw(data2, options2);      
      var chart3 = new google.visualization.BarChart(document.getElementById('chart_div3'));
      chart3.draw(data3, options3);

    }


    </script>
    
  </head>
  <body>
    <table align='center' width="95%">
      <tr>
        <td  align='center' colspan='2' style="background-color:#DCEDF0"><h4>Estados General</h4></td>
      </tr>
      <tr>
        <td><div id="donut_docs" style="width: 300px; height: 200px;"></div></td>
        <td><div id="d_docs" style="width: 800px; height: 250px;"></div></td>
      </tr>
      <tr>
        <td align='center'>Documentos</td>
        <td align='center'>Docs</td>
      </tr>
    </table>
<BR>
    <!--<table align='center' width="95%">
      <tr><td align='center' style="background-color:#DCEDF0" colspan='3'><h4>Observados</h4></td></tr>
      <tr>
        <td><div id="chart_div1" style="width: 500px; height: 400px;"></div>P1</td>
        <td><div id="chart_div2" style="width: 300px; height: 400px;"></div>P2</td>
        <td><div id="chart_div3" style="width: 300px; height: 400px;"></div>P3</td>
      </tr>

    </table>-->

  </body>
</html>
