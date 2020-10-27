<?php
session_start();
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
} 
$user=$_POST['username'];
$pass=$_POST['password'];
if ( empty($username) == false && empty($password)==false ) {
	require 'include/conexion.php';
	// $query = "select * from gpslog.system_users where RemoteUserName='".$username."' and WebPassword='".$password."';";
	// $query = "select * from aplicaciones.acc_distrack where usuario='".$username."' and clave='".$password."';";
	$query = "select * from aplicaciones.acc_distrack as u inner join aplicaciones.acc_distrack_rol as r ON u.id_rol = r.id_acc_distrack_rol where usuario='".$username."' and clave='".$password."' LIMIT 1;";
	
	$fetch = mysql_query($query);
	$user = mysql_fetch_assoc($fetch);
	// var_dump('<pre>',$user);exit();
	if (empty($user) ){
		// var_dump('entro1');exit();
		$mensaje = "Usuario o Contrase�a incorrecto(s)";
		session_destroy();            
		header("Location: index.php");	
	} else {
		// var_dump('entro2');exit();
		$_SESSION['FullName'] =$user['FullName'];
		$_SESSION['ID'] =$user['id'];
		$_SESSION['codigo'] =$user['ID'];
		$_SESSION['CompanyName']=$user['CompanyName'];
		$fec=date("Y-m-d");
		$hor=date("H:i:s");
		$usu=$_POST['username'];
		$ful=$user['FullName'];

		$_SESSION['pass'] = $user['webpassword'];
		$_SESSION['usu'] = $user['remoteusername'];

		// Roles: recibe un filtro tipo consulta dependiendo de lo asignado
		// $_SESSION['priv_filtro'] = "clase IN ('OP004','OP003')";
		$_SESSION['priv_filtro'] =$user['privilegio_filtro'];
		$_SESSION['ruta'] = $user['ruta'];
		$_SESSION['bbdd'] =$user['bbdd'];
		$_SESSION['rol'] =$user['rol'];


		$clientip= getenv("REMOTE_ADDR"); 
		header("Location: actual.php");
	}
   mysql_close($connection);
} else {
	   $_SESSION = array(); 
	   session_destroy();
	   header("Location: index.php");
 }
 ?> 