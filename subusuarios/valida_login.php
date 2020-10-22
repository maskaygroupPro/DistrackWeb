<?php
session_start();

$usu=$_POST['username'];
$pss=$_POST['password'];
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
} 
if ( empty($usu) == false && empty($pss)==false ) {
	require 'include/conexion.php';
	$query = "select u.* from intralot.subusuarios u where u.usuario='".$usu."' and u.password='".$pss."';";
	$fetch = mysql_query($query);
	$user = mysql_fetch_assoc($fetch);
	if (empty($user) ){
		$mensaje = "Usuario o Contraseña incorrecto(s)";
		session_destroy();            
		header("Location: index.html");	
	} else {
		$_SESSION['completo'] =$user['completo'];
		$_SESSION['ID'] =$user['id_usuario'];
		$_SESSION['RUN']=$user['usuario'];
		$_SESSION['ZONA']=$user['zona'];

		$fec=date("Y-m-d");
		$hor=date("H:i:s");
		header("Location: consulta.php");
	}
   mysql_close($connection);
} else {
	   $_SESSION = array(); 
	   session_destroy();
	   header("Location: index.html");
 }
 ?> 