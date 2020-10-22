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
$que="select sum(b.volumen) from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado='Entregado OTIF'";
$res=mysql_query($que) or die("Ha expirado su Sesion vuelva a ingresar");
$ro=mysql_fetch_array($res);
$ent=$ro[0];
$que1="select sum(b.volumen) from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado <> 'Entregado OTIF'";
$res1=mysql_query($que1) or die("Sesion Expirada2");
$ro1=mysql_fetch_array($res1);
$noe=$ro1[0];		
$data = array($ent,$noe);
$leyenda = array("Entreg.OTIF (".number_format($ent,3,'.','')." m3)","NO Entreg.(".number_format($noe,3,'.','')." m3)");
$graph = new PieGraph(350,360);
$graph->SetShadow();
$p1 = new PiePlot3D($data);
$p1->SetSize(150);
$p1->SetCenter(0.45,0.40);
$p1->value->SetColor('white');
$p1->SetAngle(65);
$p1->SetLabelPos(0.5); 
$p1->SetLegends($leyenda);
$theme_class= new VividTheme;
$graph->SetTheme($theme_class);
$graph->Add($p1);
$graph->Stroke();
?>
