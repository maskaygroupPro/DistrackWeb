<?php
session_start();
if ( !isset($_SESSION["ID"]) || !isset($_SESSION["FullName"])){
	header("Location: FIN_CONEXION.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Daryza, Seguimiento de Repartos</title>
<link rel="stylesheet" type="text/css" href="pro_dropdown_2/pro_dropdown_2.css" />
<script src="pro_dropdown_2/stuHover.js" type="text/javascript"></script>
<script src="script/funciones.js" type="text/javascript"></script>
<link type="image/x-icon" href="favicon.ico" rel="icon" />
<link type="image/x-icon" href="favicon.ico" rel="shortcut icon" />
</head>
<span class="preload1"></span>
<span class="preload2"></span>

	<ul id="nav">
		<!--<li class="top"><a href="Menu_Head.php" id="products" class="top_link"><span class="down">Inicio</span></a>-->
		<li><a href="actual.php" rel="#iframe" class="top_link">Estado de Reparto</a></li>			
		<li><a href="historico.php?submit=Z" rel="#iframe" class="top_link">Historico de Entregas</a></li>
		<li><a href="var0.php?submit=Z" rel="#iframe" class="top_link">var0</a></li>
		<li><a href="var1.php?submit=Z" rel="#iframe" class="top_link">var1</a></li>
		<li><a href="var2.php?submit=Z" rel="#iframe" class="top_link">var2</a></li>
		<li><a href="var3.php?submit=Z" rel="#iframe" class="top_link">Var3</a></li>
		<li><a href="rastreo.php" rel="#iframe" class="top_link">Rastreo</a></li>
		<li><a href="estadistica_actual.php" rel="#iframe" class="top_link">Estad&iacute;stica Diaria</a></li>
		<li><a href="estadistica_semanal.php" rel="#iframe" class="top_link">Estad&iacute;stica Semanal</a></li>
		<!--<li class="top"><a href="#nogo2" id="products" class="top_link"><span class="down">Sistemas</span></a>
			<ul class="sub">
				<li><a href="#nogo3" class="fly">Mantenimiento </a>
					<ul>
						<li><a href="Mantenimiento.php" target=_self>Tablero</a></li>			
					</ul>
				</li>
			</ul>
		</li>-->
		<li class="top"><a href="Salir.php" id="privacy" class="top_link" target=_self><span>Salir</span></a></li>
	</ul>
</html>