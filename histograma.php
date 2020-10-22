<?php // content="text/plain; charset=utf-8"
session_start();
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');
require_once "/include/conexion.php";
$graph = new Graph(900,400);
$graph->SetShadow();
$graph->title->Set("Histogramas");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$dsd="2014-05-15";
$hst="2014-05-23";
$p1='';
$p2='';	
$p3='';	
$z=0;
$que1="select count(b.estado) from ddaryza.pedidos b where b.estado='Entregado OTIF' and b.fechaprog between date('".$dsd."'') and date('".$hst."'') group by b.fechaprog";
echo $que1;
$res=mysql_query($que1) or die("Sesion Expirada1");
$ro=mysql_fetch_array($res);
while($fi=mysql_fetch_array($res))
	{
	$z++;
	$ent[$z]=$ro[0];		
	}
$p1 = new LinePlot($ent);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Entregado');

$que2="select count(b.estado) from ddaryza.pedidos b where b.estado<>'Entregado OTIF' and date(b.fechaprog) between ".$dsd." and ".$hst." group by date(b.fechaprog)";
$res=mysql_query($que2) or die("Sesion Expirada2");
$ro2=mysql_fetch_array($res2);
while($fi2=mysql_fetch_array($res2))
	{
	$s++;
	$noe[$s]=$ro2[0];		
	}
$p2 = new LinePlot($noe);
$graph->Add($p2);
$p2->SetColor("#6495ED");
$p2->SetLegend('NO Entreg');

$graph->Stroke();
?>