<?php // content="text/plain; charset=utf-8"
session_start();
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
require_once "/include/conexion.php";
//include_once "Menu_Head.php";	
$graph = new PieGraph(800,300);
$graph->SetShadow();
$graph->title->Set("Detallado por Placa");
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$leyenda = array("Entregados","No Entreg.");
		//$qu="select distinct date(fechaprog) from dpro.pedidos order by date(fechaprog) desc limit 7;";
//		$qu="select distinct date(fechaprog) from dpro.pedidos b,gpslog.livedata l where b.fechaprog<=curdate() and b.placa=l.vehicleReg and b.placa in(select l.VehicleReg from gpslog.netusers n,gpslog.system_users s,gpslog.livedata l where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and s.ID=".$_SESSION['ID'].") order by date(fechaprog) desc limit 7;";
		$qu="select distinct b.placa FROM ddaryza.pedidos b WHERE b.fechaprog=curdate() order by b.placa limit 17";
		$re=mysql_query($qu) or die("Sesion Expirada1");		
        	$p1='';
		$z=0;
		$xCol=0.10;
		$xFil=0.25;
		while($fi=mysql_fetch_array($re))
			{
				$z++;
				$ent=0;
				$noe=0;
				$pla=$fi[0];					
		$que="select count(b.estado) from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado='Entregado OTIF' and b.placa='".$pla."'";
		$res=mysql_query($que) or die("Sesion Expirada2");
		$ro=mysql_fetch_array($res);
		$ent=$ro[0];
		$que1="select count(b.estado) from ddaryza.pedidos b where b.fechaprog=curdate()  and b.estado<>'Entregado OTIF' and b.placa='".$pla."'";
		$res1=mysql_query($que1) or die("Sesion Expirada3");
		$ro1=mysql_fetch_array($res1);
		$noe=$ro1[0];
		$xCol=$xCol+0.20;
		if ($xCol>1.0){
    		$xFil=$xFil+0.30;
    		$xCol=0.10;
			}
			$p1 = new PiePlot3D(array($ent,$noe));
			$p1->SetTheme("sand");
			$p1->SetSize(0.14);
			$p1->SetCenter($xCol,$xFil);
			$p1->SetLabelPos(0.2); 
			$p1->value->SetColor("black"); 
			$p1->title->Set($pla);
			$theme_class= new VividTheme;
			$graph->SetTheme($theme_class);
			$graph->Add($p1);
//$graph->Stroke();
	if($z==1){					
		//$p1->SetLegends($leyenda);
	}
	}
$graph->Stroke();
?>