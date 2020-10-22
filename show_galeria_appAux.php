<?php
require_once "include/conexion.php";
session_start();
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
} 

?>
<!DOCTYPE html>
<html>
<head>
<style>
button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}
button.accordion.active, button.accordion:hover {
    background-color: #ddd;
}
div.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: 0.6s ease-in-out;
    opacity: 0;
}
div.panel.show {
    opacity: 1;
    max-height: 500px;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
</head>
<body>
<?php
$fotor=$var0;
$qfir="select i.ruta from appdistrack.reg_firmas i where i.documento='".$fotor."';";
$rfir = mysql_query($qfir);
$fil=mysql_fetch_assoc($rfir);
$firma=$fil['ruta'];

$que="select f.id_log_fotos, f.fecha, f.hora, f.documento, f.ruta from appdistrack.reg_fotos f where f.documento='".$fotor."' group by f.fecha, f.hora order by f.fecha ;"; 
//echo $que;
$result = mysql_query($que);
if (!$result) {
	die('Error query: ' .mysql_error());
	$num_rows = mysql_num_rows($result);
	echo $num_rows." Rows\n";
}
$NO=0;
while ($row = mysql_fetch_array($result)) {
	$NO++;
	$IDC[$NO]=$row[0];
	$FEC[$NO]=$row[1];
    $HOR[$NO]=$row[2];
    $SST[$NO]=$row[3];
    $RUT[$NO]=$row[4];
}
echo "<table id='Tabla_Detalle' class='w3-table w3-striped w3-border'>";
if ($NO > 0){

    for ($i=1;$i<=$NO;$i++){
		if ($i == 1){
			$color='';
			echo "<thead class='w3-black'>";	
			echo "<tr>";
			echo "<td align='center'>Ord</td>";
			//echo "<td align='center'>Documento</td>";
			echo "<td align='center'>Imagen</td>";
			echo "</tr>";
			echo "</thead>";
            echo "<tr>";            
            if ($firma!='') {

                echo "<td >Firma:</td><td align='left'>";
                echo "<img width='30%' src='http://tracklogservice.com:3010/".$firma."'>";
                echo "</td>";
                $anch='30';
            }else{
                echo "<td></td>";
                echo "<td></td>";
                $anch='60';
            }
            echo "</tr>";
		}
    		echo "<tr>";
    			echo "<td>";
    				echo $i;
    			echo "</td>";
                echo "<td align='left'>";
    				echo $fotor."<br>";
                    echo $FEC[$i]." ".$HOR[$i]."<br>";
			
                    echo "<img width='".$anch."%' src='http://tracklogservice.com:3010/".$RUT[$i]."'>";
        		echo "</td>";
    		echo "</tr>";

    }
    	echo "</table>";

}else{
    echo "<table width='95%' cellpadding='2' cellspacing='1' border='1' align='center'>";
        echo "<tr>";
            echo "<td nowrap align='center'>NO EXISTEN REGISTRO QUE CUMPLAN LA CONDICION !!!</td>";
        echo "</tr>";
    echo "</table>";
}
?>
