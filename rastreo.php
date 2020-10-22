<?php 
require_once "/include/conexion.php";
include_once "Menu_Head.php";	
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="600"/>
<title>Rastreo</title>
<head>
	<link href="style/style.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" src="script/tigra_tables.js"></script>
	<script language="JavaScript" src="script/sorttable.js"></script>
</head>
<form name="frmreporte" method ="post" action="rastreo.php">
<table width="95%" border="1" cellspacing="0" cellpadding="0" align="center" >
  <tr align="center"> 
    <td nowrap class="PageCaption" align="left" >Rastreo</td>
  </tr>
  <tr>
	<td nowrap align="left">
	<iframe name="reporte" src="repor_status1.php" frameborder="0" border="0" width="100%'></iframe> 
	<!--<iframe name="reporte" src="repor_status1.php" frameborder="0" height="800" width="1500" border="0"></iframe> -->
	</td>
  </tr>
</table>
</form>
</html>