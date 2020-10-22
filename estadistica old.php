<?php 
session_start();
require_once "/include/conexion.php";
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
}

		$que="select count(b.estado) from paraiso.maestropedidos b,gpslog.livedata l where b.unidad=l.vehicleReg and b.unidad in(select l.VehicleReg from gpslog.netusers n,gpslog.system_users s,gpslog.livedata l where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and b.estado='Entregado' and s.ID=".$_SESSION['ID'].")";
		$res=mysql_query($que) or die("Sesion Expirada");
		$ro=mysql_fetch_array($res);
		$ent=$ro[0];
		
		$que1="select count(b.estado) from paraiso.maestropedidos b,gpslog.livedata l where b.unidad=l.vehicleReg and b.unidad in(select l.VehicleReg from gpslog.netusers n,gpslog.system_users s,gpslog.livedata l where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and b.estado<>'Entregado' and s.ID=".$_SESSION['ID'].")";
		$res1=mysql_query($que1) or die("Sesion Expirada");
		$ro1=mysql_fetch_array($res1);
		$noe=$ro1[0];		

$data = array($ent,$noe);
$leyenda = array("Entregado","En Ruta");

$graph = new PieGraph(400,300);
$graph->SetShadow();

$graph->title->Set("Entregas del día");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$p1 = new PiePlot3D($data);
$p1->SetTheme("sand");
$p1->SetSize(0.5);
$p1->SetCenter(0.45);
$p1->SetLegends($leyenda);
//$p1->SetLegends($gDateLocale->GetShortMonth());

$graph->Add($p1);

$graph->Stroke();
?>