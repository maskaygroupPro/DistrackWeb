<?php
session_start();
if ( !isset($_SESSION["ID"])  ){
    header("Location: FIN_CONEXION.php");
}
error_reporting(0);
require_once "include/conexion.php";
include "filtro.php";
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
                                                            <li style="padding: 18px;">
                                                              <div class="dropdown">
                                                                <a data-toggle="dropdown" style="color:black;">Estad&iacute;sticas
                                                                  <span class="caret"></span>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                  <li><a href="estadistica_actual.php">Por Zonas</a></li>
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

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <head>
  <script language="JavaScript" src="script/tigra_tables.js"></script>
  <script language="JavaScript" src="script/sorttable.js"></script> 
  <script language="JavaScript" src="ts_picker2.js"></script> 
  <link href="style/style.css" rel="stylesheet" type="text/css">    
    <?php

    if($vdesde=='' && $vhasta==''){
      $vdesde=date("Y-m-d",time()-(30*24*3600));
      $vhasta=date("Y-m-d",time()-(0*24*3600));
    }
    if(!empty($_POST)){
      $vdesde=$_POST['vdesde'];
      $vhasta=$_POST['vhasta'];
    }

    $cmps="p.fechaprog, 
    sum(if(p.estado='Entregado',1,0)), 
    sum(if(p.estado='Parcial',1,0)),
    sum(if(p.estado='No Entregado',1,0)), 
    sum(if(p.estado='Llegada' or p.estado='Inicio' or p.estado='Retorno',1,0)),
    sum(if(p.estado='En Ruta',1,0))";

    $from="intralot.pedidos p";
    $cond="date(p.fechaprog) between '".$vdesde."' and '".$vhasta."' ";
    $query="select ".$cmps." from ".$from."  where ".$cond." group by p.fechaprog order by p.fechaprog,p.placa;";

    $result = mysql_query($query);
    if (!$result) {
      die('Error query: ' . mysql_error());
      $num_rows = mysql_num_rows($result);
      echo "$num_rows Rows\n";
    }
    $NO=0;
    while ($row = mysql_fetch_array($result)) {
      $NO++;
      $FECHT[$NO]    = $row[0];
      $ESPET[$NO]    = $row[1];
      $ATENT[$NO]    = $row[2];
      $SALIT[$NO]    = $row[3];
      $CADET[$NO]    = "['".$row[0]."',".$row[1].",".$row[4].",".$row[2].",".$row[3]."],";
    }

    $rutil=mysql_query("select fechaprog, count(distinct placa) from alcha.pedidos where (date(fechaprog) between '".$vdesde."' and '".$vhasta."')  group by fechaprog order by fechaprog ;");
    while ($autil=mysql_fetch_array($rutil)) {
      $cadu .= "['".$autil[0]."',".$autil[1].",".$autil[2]."],";
    }
    ?>    
    <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
    <script type="text/javascript">
            google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {    var data = new google.visualization.DataTable();
      data.addColumn('string', 'Fecha');
      data.addColumn('number', 'Entregado');
      data.addColumn('number', 'No Entregado');
      data.addColumn('number', 'En Ruta');
      data.addColumn('number', 'Parcial');
      data.addRows([
<?php
       for ($i=1;$i<=$NO;$i++){
          echo $CADET[$i];          
        }
?>
      ]);
      var options = {
        legend: { position: 'bottom', maxLines: 3 },
        bar: { groupWidth: '90%' },
        vAxis:{title: 'Cant.Pedidos', textStyle:{color: '#005500',fontSize: '9', paddingRight: '10',marginRight: '10'}},
        hAxis:{title: 'Estados', textStyle: { color: '#005500', fontSize: '9', paddingRight: '4', marginRight: '4'} },     
        colors: ['#0040FF', '#FF0000', '#CFF0FB','#02F229']
      };
              var chart = new google.visualization.AreaChart(
        document.getElementById('ex3'));
        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {
      packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

      var data1 = google.visualization.arrayToDataTable([
        ['Motivo', 'Cantidad' ],
        <?php
          echo $cadu;
        ?>


      ]);

      var options1 = {
        title: 'Unidades Programadas',
        chartArea: {
          width: '90%'
        },
        hAxis: {
          title: 'Fechas',
          minValue: 0,
          textStyle:{color: '#005500',fontSize: '9', paddingRight: '10',marginRight: '10'}
        },
        vAxis: {
          title: 'Cant.Unidades',
          textStyle:{color: '#005500', fontSize: '9', paddingRight: '4', marginRight: '4'} 
        }
      };

      var chart1 = new google.visualization.ColumnChart(document.getElementById('chart_div'));

      chart1.draw(data1, options1);
    }


    </script>

  </head>
  <body>
    
 <form class="form-horizontal" role="form" action="est_his.php" method="post" enctype="multipart/form-data">
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
  
         /*----------SELECTOR DE CADENA----------*/
  echo "<table align='center' width=35%><tr> ";  
  echo "</tr>";
  ?>
  </tr></table>
  </form>
    <table width='95%' align='center'>
    <tr>
      <tr><td align='center' style="background-color:#DCEDF0" ><h4>Cronologia de Estados</h4></td></tr>
      <td><div id="ex3" style="align='left'; width: 1300px; height: 250px;"></div></td></tr>
      <!--<tr><td align='center' style="background-color:#DCEDF0" ><h4>Disposicion de Flota (Max.8 uu.)</h4></td></tr>
    <tr><td><div id="chart_div" style="align='left'; width: 1300px; height: 250px;"></div></td></tr>-->
    </table>
  </body>
</html>