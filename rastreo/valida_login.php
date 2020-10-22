<?php
session_start();

$doc=$_POST['documento'];

foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
} 
if ( empty($doc) == false ) {
	require 'include/conexion.php';
	$query = "select u.* from intralot.pedidos u where u.codproducto='".$doc."' and fechaprog<=current_date order by indice desc limit 1;";
	$fetch = mysql_query($query);
	$user = mysql_fetch_assoc($fetch);
	echo $query;
	if (empty($user) ){
		$mensaje = "Usuario o Contraseña incorrecto(s)";
		session_destroy();            
		header("Location: index.php");	
	
	} else {
		$_SESSION['completo'] =$user['completo'];
		$_SESSION['ID'] =$user['id_usuario'];
		$_SESSION['Usua']=$user['usuario'];
		$fec=date("Y-m-d");
		$hor=date("H:i:s");
		$ind=$user['indice'];
		header("Location: getContent.php?var0=".$ind);
	}
   mysql_close($connection);
} else {
	   $_SESSION = array(); 
	   session_destroy();
	   #echo "Aqui 1";
	   header("Location: index.php");
 }
 ?> 