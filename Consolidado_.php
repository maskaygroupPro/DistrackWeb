<?php 
session_start();
//require_once ('jpgraph/jpgraph.php');
//require_once ('jpgraph/jpgraph_pie.php');
//require_once ('jpgraph/jpgraph_pie3d.php');
require_once "/include/conexion.php";
include ("jpgraph/jpgraph.php"); 
include ("jpgraph/jpgraph_pie.php"); 
include ("jpgraph/jpgraph_pie3d.php"); 
$qent="select count(b.estado) from ddaryza.pedidos b where fechaprog=curdate() and estado='Entregado OTIF'";
$rese=mysql_query($qent) or die("Sesion Expirada");
$ce=mysql_fetch_array($rese);
$qnent="select count(b.estado) from ddaryza.pedidos b where fechaprog=curdate() and estado<>'Entregado OTIF'";
$resn=mysql_query($qnent) or die("Sesion Expirada");
$cn=mysql_fetch_array($resn);
$data = array($cn[0],$ce[0]); 
$graph = new PieGraph(800,190,"auto"); 
$graph->SetShadow(); 
$graph->img->SetAntiAliasing(); 
//$graph->SetMarginColor('white'); 
// Setup margin and titles 
$graph->title->Set("Progreso de Hoy"); 
$p1 = new PiePlot3D($data); 
$p1->SetSize(0.5); 
$p1->SetCenter(0.5); 
// Setup slice labels and move them into the plot 
$p1->value->SetFont(FF_FONT1,FS_BOLD); 
$p1->value->SetColor("black"); 
$p1->SetLabelPos(0.2); 
$nombres=array("No Entreg","Entregado"); 
$p1->SetLegends($nombres); 
// Explode all slices 
$p1->ExplodeAll(); 
$p1->SetTheme("sand2");
$graph->Add($p1); 
$graph->Stroke(); 
?> 