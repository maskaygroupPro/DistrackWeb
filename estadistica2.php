<?php // content="text/plain; charset=utf-8"
session_start();
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
require_once ("include/conexion.php");
//include_once "Menu_Head.php";	
$graph = new PieGraph(800,360);
$graph->SetShadow();
//$graph->title->Set("Cumplimiento de Ventana Horaria (Entrega)");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

//$leyenda = array("Dentro","Despues","Antes","No.Ent");
//$leyenda = array("Antes","Despues","Dentro");
		//$qu="select distinct b.placa from ddaryza.pedidos b,gpslog.livedata l where b.fechaprog=curdate() and b.placa=l.vehicleReg and b.placa in(select l.VehicleReg from gpslog.netusers n,gpslog.system_users s,gpslog.livedata l where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and s.ID=".$_SESSION['ID'].") order by date(fechaprog) desc limit 17;";
		$qu="select distinct b.placa from ddaryza.pedidos b where date(b.fechaprog)=curdate() order by date(b.fechaprog) desc limit 17";
		$re=mysql_query($qu) or die("Sesion Expirada0");		
       	$p1='';
		$z=0;
		$xCol=1;
		$xFil=50;
		while($fi=mysql_fetch_array($re))
			{
				$z++;
				$ant=0;
				$med=0;
				$dsp=0;
				$noe=0;
				$pla=$fi[0];				
		$que="select count(b.estado) qq from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado='Entregado OTIF' and b.horentrega<b.ventanaini and b.placa='".$pla."'";
		$res=mysql_query($que) or die("Sesion Expirada1");
		$ro=mysql_fetch_array($res);
		$ant=$ro[0];
		
		$que1="select count(b.estado) from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado='Entregado OTIF' and b.horentrega>b.ventanafin and b.placa='".$pla."'";
		$res1=mysql_query($que1) or die("Sesion Expirada2");
		$ro1=mysql_fetch_array($res1);
		$dsp=$ro1[0];
		
		$que2="select count(b.estado) from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado='Entregado OTIF' and b.horentrega>b.ventanaini and b.horentrega<b.ventanafin and b.placa='".$pla."'";
		$res2=mysql_query($que2) or die("Sesion Expirada3");
		$ro2=mysql_fetch_array($res2);
		$med=$ro2[0];
		
		$que3="select count(b.estado) from ddaryza.pedidos b where b.fechaprog=curdate() and b.estado<>'Entregado OTIF' and b.placa='".$pla."'";
		$res3=mysql_query($que3) or die("Sesion Expirada4");
		$ro3=mysql_fetch_array($res3);
		$noe=$ro3[0];
		
		if ($xCol>700){
    		$xFil=$xFil+100;//90
    		$xCol=1;
			}
			$xCol=$xCol+120;//75
			$p1 = new PiePlot3D(array($med,$dsp,$ant,$noe));
			$p1->SetAngle(60);
			$p1->SetSize(55);//30
			$p1->SetCenter($xCol,$xFil);
			$p1->SetLabelPos(0.50); 
			$p1->value->SetColor("black"); 
			$theme_class= new VentanasTheme;
			$graph->SetTheme($theme_class);

			$p1->title->Set($pla);			
			$graph->Add($p1);
			$graph->legend->Pos(0.01,0.05,"left","top"); 
//$graph->Stroke();
	if($z==1){					
		$p1->SetLegends($leyenda);
		$theme_class= new VentanasTheme;
		$graph->SetTheme($theme_class);

	}
	}
$graph->Stroke();
?>