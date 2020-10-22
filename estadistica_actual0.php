<?php
session_start(); 
if ( !isset($_SESSION["ID"]) ){
    header("Location: FIN_CONEXION.php");
}

require_once "include/conexion.php";
include "filtro.php";
error_reporting(0);
if($vdesde=='' && $vhasta==''){
  $vdesde=date("Y-m-d",time()-(1*24*3600));
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
                  <td><img src="images/logo.png" width='180px' height="60px"></td>
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
$cmps="p.placa, 
sum(if(p.estado='Entregado' or p.estado='Entregado OTIF',1,0)), 
sum(if(p.estado='Parcial',1,0)),
sum(if(p.estado='No Entregado',1,0)), 
sum(if(p.estado='Llegada' or p.estado='Inicio' or p.estado='Retorno',1,0)),
sum(if(p.estado='En Ruta',1,0)), 

round(sum(if(p.estado='Entregado',p.peso,0))),
round(sum(if(p.estado='Parcial',p.peso,0))),
round(sum(if(p.estado='No Entregado',p.peso,0))), 
round(sum(if(p.estado='Llegada' or p.estado='Inicio' or p.estado='Retorno',p.peso,0))),
round(sum(if(p.estado='En Ruta',p.peso,0)))
";
$from="ddaryza.pedidos p";
$cond="date(p.fechaprog) between '".$vdesde."' and '".$vhasta."' ";
$query="select ".$cmps." from ".$from."  where ".$cond." group by p.placa order by p.placa;";
#echo $query;
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
  $CADE_P[$NO]      = "['".$row[0]."',".$row[6].",".$row[7].",".$row[8].",".$row[9].",".$row[10]."],";
}

$cmps="
sum(if(p.estado='Entregado' or p.estado='Entregado OTIF',1,0)), 
sum(if(p.estado='Parcial',1,0)),
sum(if(p.estado='No Entregado',1,0)), 
sum(if(p.estado='Llegada' or p.estado='Inicio' or p.estado='Retorno',1,0)),
sum(if(p.estado='En Ruta',1,0)),  

round(sum(if(p.estado='Entregado',p.peso,0))),
round(sum(if(p.estado='Parcial',p.peso,0))),
round(sum(if(p.estado='No Entregado',p.peso,0))), 
round(sum(if(p.estado='Llegada' or p.estado='Inicio' or p.estado='Retorno',p.peso,0))),
round(sum(if(p.estado='En Ruta',p.peso,0)))
";
$from="ddaryza.pedidos p";
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
  $CADE_PE     = "['Entregado',".$row[5]."],['Parcial',".$row[6]."],['No Entregado',".$row[7]."],['Proceso',".$row[8]."],['En Ruta',".$row[9]."]";
}

$cmps="fechaprog, count(distinct placa) as tot ";
$from="ddaryza.pedidos";
$cond="fechaprog between '".$vdesde."' and '".$vhasta."'";
$query3="select ".$cmps." from ".$from." where ".$cond." group by fechaprog order by fechaprog desc;" ;
$result3=mysql_query($query3);
if (!$result3) {
  die('Error query: ' . mysql_error());
  $num_rows = mysql_num_rows($result3);
  echo "$num_rows Rows\n";
}
while ($row = mysql_fetch_array($result3)) {
    $CADE_UT="'".$row[0]."',".$row[1].",";  
}

$cmps="placa, count(indice) as tot";
$from="ddaryza.pedidos";
$cond="fechaprog between '".$vdesde."' and '".$vhasta."'";
$query4="select ".$cmps." from ".$from." where ".$cond." group by placa order by tot desc;" ;
$result4=mysql_query($query4);
if (!$result4) {
  die('Error query: ' . mysql_error());
  $num_rows = mysql_num_rows($result4);
  echo "$num_rows Rows\n";
}
while ($row = mysql_fetch_array($result4)) {
    $CADE_ASI="'".$row[0]."',".$row[1].",";  
}

$cmps="fechaprog,sum(if(estado<>'En Ruta',1,0)), sum(if(estado='En Ruta',1,0))";
$from="ddaryza.pedidos";
$cond="fechaprog between '".$vdesde."' and '".$vhasta."'";
$query5="select ".$cmps." from ".$from." where ".$cond." group by fechaprog order by fechaprog;" ;
$result5=mysql_query($query5);
if (!$result5) {
  die('Error query: ' . mysql_error());
  $num_rows = mysql_num_rows($result5);
  echo "$num_rows Rows\n";
}
while ($row = mysql_fetch_array($result4)) {
    $CADE_PRO="'".$row[0]."',".$row[1].",".$row[2].",";  
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
        var d_peso = google.visualization.arrayToDataTable([
          ['Estado', 'Kgs'],
          <?php    
            echo $CADE_PE;
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
      var chart_p = new google.visualization.PieChart(document.getElementById('donut_peso'));
      chart_p.draw(d_peso, options);
      }
    </script>
    <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
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

        var data_peso = new google.visualization.DataTable();
        data_peso.addColumn('string', 'Placa');
        data_peso.addColumn('number', 'Entregado Kg');
        data_peso.addColumn('number', 'Parcial Kg');
        data_peso.addColumn('number', 'No Entregado Kg');
        data_peso.addColumn('number', 'Proceso Kg');
        data_peso.addColumn('number', 'En Ruta Kg');      
        data_peso.addRows([
        <?php
         for ($i=1;$i<=$NO;$i++){
            echo $CADE_P[$i];          
          }
        ?>
        ]);
        /*
        var data_uti = new google.visualization.DataTable();
        data_uti.addColumn('string', 'Fecha');
        data_uti.addColumn('number', 'Unidades');    
        data_uti.addRows([
        <?php
         for ($i=1;$i<=$NO;$i++){
            echo $CADE_UT[$i];          
          }
        ?>
        ]);


        var data_asi = new google.visualization.DataTable();
        data_asi.addColumn('string', 'Placa');
        data_asi.addColumn('number', 'Documentos');
        data_asi.addRows([
        <?php
         for ($i=1;$i<=$NO;$i++){
            echo $CADE_ASI[$i];          
          }
        ?>
        ]);


        var data_ges = new google.visualization.DataTable();
        data_ges.addColumn('string', 'Fecha');
        data_ges.addColumn('number', 'Gestionados');
        data_ges.addColumn('number', 'Omitidos');  
        data_ges.addRows([
        <?php
         for ($i=1;$i<=$NO;$i++){
            echo $CADE_PRO[$i];          
          }
        ?>
        ]);*/

        var options2 = {
          hAxis: {textStyle: {color: '#01579b', fontSize: '9', fontName: 'Verdana', bold: true}},
          vAxis: {textStyle: {color: '#1a237e', fontSize: '10', bold: true }},
          legend: { position: 'top', maxLines: 2, textStyle: {color: 'black', fontSize: 9}},
          bar: { groupWidth: '70%' },
          isStacked: true,
          colors: ['#0040FF','#01DF01','#DF0101','#f98C07','#CEECF5'],    
          //chartArea:{left:100,top:100,width:'90%',height:'95%'}
       };
       /*var options3 = {
          hAxis: {textStyle: {color: '#01579b', fontSize: '9', fontName: 'Verdana', bold: true}},
          vAxis: {textStyle: {color: '#1a237e', fontSize: '10', bold: true }},
          legend: { position: 'top', maxLines: 2, textStyle: {color: 'black', fontSize: 9}},
          bar: { groupWidth: '70%' },
          colors: ['#0040FF','#01DF01','#DF0101','#f98C07','#CEECF5'],    
          //chartArea:{left:100,top:100,width:'90%',height:'95%'}
       };*/
      var chart_docs = new google.visualization.ColumnChart(document.getElementById('d_docs'));
      chart_docs.draw(data_docs, options2);

      var chart_peso = new google.visualization.ColumnChart(document.getElementById('d_peso'));
      chart_peso.draw(data_peso, options2);

      var chart_uti = new google.visualization.ColumnChart(document.getElementById('d_uti'));
      chart_uti.draw(data_uti, options2);

      var chart_asi = new google.visualization.ColumnChart(document.getElementById('d_asi'));
      chart_asi.draw(data_asi, options2);

      var chart_ges = new google.visualization.ColumnChart(document.getElementById('d_ges'));
      chart_ges.draw(data_ges, options2);
      }
    </script>
  </head>
  <body>
    <table>

      <tr>
        <td><div id="donut_docs" style="width: 300px; height: 200px;"></div></td>
        <td><div id="d_docs" style="width: 1100px; height: 250px;"></div></td>
      </tr>
      <tr>
        <td align='center'>Documentos</td>
        <td align='center'>Docs</td>
      </tr>
      <tr>
        <td><div id="donut_peso" style="width: 300px; height: 200px;"></div></td>
        <td><div id="d_peso" style="width:1100px; height: 250px;"></div></td>
      </tr>
      <tr>
        <td align='center'>Peso (Kgs)</td>
        <td align='center'>Kgs.</td>
      </tr>
      <tr>
        <td colspan='2'><div id="d_uti" style="width:1100px; height: 250px;"></div></td>
      </tr>
      <tr>
        <td colspan='2'><div id="d_asi" style="width:1100px; height: 250px;"></div></td>
      </tr>
      <tr>
        <td colspan='2'><div id="d_ges" style="width:1100px; height: 250px;"></div></td>
      </tr>

    </table>
  </body>
</html>
