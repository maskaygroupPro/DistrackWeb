<?php 
session_start();
require_once "include/conexion.php";
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
}
$que1="select count(b.placa)from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado='Entregado OTIF' and b.horentrega<b.ventanaini ";
$res1=mysql_query($que1) or die("Ha expirado su Sesion vuelva a ingresar1");
$ro1=mysql_fetch_array($res1);
$ant=$ro1[0];

$que2="select count(b.placa)from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado='Entregado OTIF' and b.horentrega>b.ventanafin ";
$res2=mysql_query($que2) or die("Ha expirado su Sesion vuelva a ingresar2");
$ro2=mysql_fetch_array($res2);
$dsp=$ro2[0];

$que3="select count(b.placa)from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado='Entregado OTIF' and b.horentrega>b.ventanaini and b.horentrega<b.ventanafin ";
$res3=mysql_query($que3) or die("Ha expirado su Sesion vuelva a ingresar3");
$ro3=mysql_fetch_array($res3);
$med=$ro3[0];

$que4="select count(b.placa)from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado <> 'Entregado OTIF'";
$res4=mysql_query($que4) or die("Sesion Expirada2");
$ro4=mysql_fetch_array($res4);
$noe=$ro4[0];		

$data = array($med,$dsp,$ant,$noe);
$leyenda = array("Dentro","Despues","Antes", "No Ent.");
$graph = new PieGraph(350,360);
$graph->SetShadow();
$p1 = new PiePlot3D($data);
$p1->SetSize(150);
$p1->SetCenter(0.45,0.40);
$p1->value->SetColor('white');
$p1->SetAngle(65);
$p1->SetLabelPos(0.5); 
$p1->SetLegends($leyenda);
$theme_class= new VentanasTheme;
$graph->SetTheme($theme_class);
$graph->Add($p1);
$graph->Stroke();
?>
