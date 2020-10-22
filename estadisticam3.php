<?php // content="text/plain; charset=utf-8"
session_start();
require_once ("/include/conexion.php");
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
$z=0;
$xCol=1;
$xFil=50;
$qu="select b.placa, sum(b.peso) from ddaryza.pedidos b where b.fechaprog=curdate() group by b.placa order by b.placa";
$re = mysql_query($qu);
if (!$re) {
	die('Error query: ' . mysql_error());
	$num_rows = mysql_num_rows($re);
	echo "$num_rows Rows\n";
}
$p1='';
$graph=new PieGraph(800,360);
$graph->SetShadow();
while($fi=mysql_fetch_array($re)){
	$z++;
	$pla=$fi[0];					
	$tot=$fi[1];
	$que="select (sum(p.peso)/".$tot.") from ddaryza.pedidos p where p.fechaprog=curdate() and p.placa='".$pla."' and p.estado='Entregado OTIF'	 group by p.estado";
	
	//echo $que."   " ;
	$res= mysql_query($que);
	if (!$res) {
		die('Error query: '. mysql_error());
		$num_row = mysql_num_rows($res);
		echo "$num_rows Rows\n";
	}
	else{
		$ro=mysql_fetch_array($res);
		$ent=round($ro[0] *100);
		$noe=100-$ent;
	}
	//	echo $pla."(".$ent.",".$noe."=".$tot.") ";
	$data=array($ent,$noe);

	if ($xCol>700){
    	$xFil=$xFil+100;//90
    	$xCol=1;
	}
	$xCol=$xCol+120;//75
	$p1[$z] = new PiePlot3D($data);
	$p1[$z]->SetAngle(60);
	$p1[$z]->SetSize(55);//30
	$p1[$z]->SetCenter($xCol,$xFil);
	$p1[$z]->SetLabelPos(0.15); 
	$p1[$z]->value->SetColor("black"); 
	$p1[$z]->title->Set($pla);
	$graph->Add($p1[$z]);			
}
$graph->Stroke();	
?>