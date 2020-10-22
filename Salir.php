<?
//CREA SESION
session_start();
if ( !isset($_SESSION["USUARIO"]) || !isset($_SESSION["CLAVE"]))
	{header("Location: FIN_CONEXION.php");
}
	   
//SALIR DEL SISTEMA
unset($_SESSION["USUARIO"]);
unset($_SESSION["PASSWORD"]); 
unset($_SESSION["BASEDATOS"]);
unset($_SESSION["PERFIL"]);
$_SESSION = array(); 
session_destroy();            
header("Location: index.php");
?>	   