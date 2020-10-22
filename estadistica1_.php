<?php // content="text/plain; charset=utf-8"
session_start();
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');

require_once "/include/conexion.php";
//include_once "Menu_Head.php";	
$graph = new PieGraph(800,550);
$graph->SetShadow();

$graph->title->Set("Últimas 7 entregas");
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$leyenda = array("Entregados","Otros");

		//$qu="select distinct date(fechaprog) from ddaryza.pedidos order by date(fechaprog) desc limit 7;";
		$qu="select distinct date(fechaprog) from ddaryza.pedidos b,gpslog.livedata l where b.fechaprog<=curdate() and b.placa=l.vehicleReg and b.placa in(select l.VehicleReg from gpslog.netusers n,gpslog.system_users s,gpslog.livedata l where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and s.ID=".$_SESSION['ID'].") order by date(fechaprog) desc limit 7;";
		$re=mysql_query($qu) or die("Sesion Expirada");
		
        	$p1='';
            $p2='';	
            $p3='';	
            $p4='';	
            $p5='';	
            $p6='';	
            $p7='';	
		$z=0;
		while($fi=mysql_fetch_array($re))
			{
				$z++;
				$ent=0;
				$noe=0;
				$fec=$fi[0];
					
		$que="select count(b.estado) from ddaryza.pedidos b,gpslog.livedata l where b.fechaprog<=curdate() and b.placa=l.vehicleReg and b.placa in(select l.VehicleReg from gpslog.netusers n,gpslog.system_users s,gpslog.livedata l where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and b.estado='Entregado' and s.ID=".$_SESSION['ID'].") and b.fechaprog='".$fec."'";
		$res=mysql_query($que) or die("Sesion Expirada");
		$ro=mysql_fetch_array($res);
		$ent=$ro[0];
		
		$que1="select count(b.estado) from ddaryza.pedidos b,gpslog.livedata l where b.fechaprog<=curdate() and b.placa=l.vehicleReg and b.placa in(select l.VehicleReg from gpslog.netusers n,gpslog.system_users s,gpslog.livedata l where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and b.estado<>'Entregado' and s.ID=".$_SESSION['ID'].") and b.fechaprog='".$fec."'";
		$res1=mysql_query($que1) or die("Sesion Expirada");
		$ro1=mysql_fetch_array($res1);
		$noe=$ro1[0];

	if($z==1){					
		$p1 = new PiePlot3D(array($ent,$noe));
		$p1->SetTheme("sand");
		$p1->SetSize(0.15);
		$p1->SetCenter(0.15,0.32);
		$p1->title->Set($fec);
		$p1->SetLegends($leyenda);
	}
	if($z==2){					
		$p2 = new PiePlot3D(array($ent,$noe));
		$p2->SetTheme("sand");
		$p2->SetSize(0.15);
		$p2->SetCenter(0.45,0.32);
		$p2->title->Set($fec);
	}
	if($z==3){					
		$p3 = new PiePlot3D(array($ent,$noe));
		$p3->SetTheme("sand");
		$p3->SetSize(0.15);
		$p3->SetCenter(0.75,0.32);
		$p3->title->Set($fec);
	}
	if($z==4){					
		$p4 = new PiePlot3D(array($ent,$noe));
		$p4->SetTheme("sand");
		$p4->SetSize(0.15);
		$p4->SetCenter(0.15,0.62);
		$p4->title->Set($fec);
	}
	if($z==5){					
		$p5 = new PiePlot3D(array($ent,$noe));
		$p5->SetTheme("sand");
		$p5->SetSize(0.15);
		$p5->SetCenter(0.45,0.62);
		$p5->title->Set($fec);
	}
	if($z==6){					
		$p6 = new PiePlot3D(array($ent,$noe));
		$p6->SetTheme("sand");
		$p6->SetSize(0.15);
		$p6->SetCenter(0.75,0.62);
		$p6->title->Set($fec);
	}
	if($z==7){					
		$p7 = new PiePlot3D(array($ent,$noe));
		$p7->SetTheme("sand");
		$p7->SetSize(0.15);
		$p7->SetCenter(0.15,0.87);
		$p7->title->Set($fec);
	}
	}
		
        if($z==1)		
				$graph->Add($p1);

        if($z==2){		
				$graph->Add($p1);
                $graph->Add($p2);
			}
                
        if($z==3){		
				$graph->Add($p1);
                $graph->Add($p2);
				$graph->Add($p3);
				}
        if($z==4){		
				$graph->Add($p1);
                $graph->Add($p2);
				$graph->Add($p3);
				$graph->Add($p4);
                }
       if($z==5){		
				$graph->Add($p1);
                $graph->Add($p2);
				$graph->Add($p3);
				$graph->Add($p4);
				$graph->Add($p5);
                }
       if($z==6){		
				$graph->Add($p1);
                $graph->Add($p2);
				$graph->Add($p3);
				$graph->Add($p4);
				$graph->Add($p5);
				$graph->Add($p6);
                }
       if($z==7){		
				$graph->Add($p1);
                $graph->Add($p2);
				$graph->Add($p3);
				$graph->Add($p4);
				$graph->Add($p5);
				$graph->Add($p6);
				$graph->Add($p7);           
               } 
   
$graph->Stroke();

?>