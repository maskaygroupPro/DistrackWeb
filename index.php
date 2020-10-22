<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
} 
$srv_bd =$_SERVER['SERVER_NAME'];
//echo getcwd()."<BR>";
 ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style/style.css" rel="stylesheet" type="text/css">

<title>DISTRACK</title>
<script languaje=javascript>
 function Valida( ) { 
    if (document.forms.formulario.usuario.value=='' || document.forms.formulario.password.value=='')
    	{alert('Ingrese USUARIO y PASSWORD');
	}
 }

//MENSAJE DE DERECHOS RESERVADOS

var message="Derechos Reservados©";
///////////////////////////////////
function clickIE4(){
	if (event.button==2){
	alert(message);
	return false;
	}
}

function clickNS4(e){
	if (document.layers||document.getElementById&&!document.all){
		if (e.which==2||e.which==3){
			alert(message);
			return false;
		}
	}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("alert(message);return false")

</script>

</head>
<body>
<form name="formulario" action = 'valida_login.php' method= 'post' ONSUBMIT = ' Valida () '; >
<input type="hidden" name="srv_bd" value='<?php echo $srv_bd ?>' > 
</br>
<center><IMG SRC="images/logo.png"  WIDTH=500  BORDER=0 ALIGN="center"> </center>
<p>
<table align='center' border=0 width=25%>
<tr>
	<td>
	<table align=center  width=100% cellspacing=2 cellpadding=8 >
	<tr>
		<td align=right class="AttrCaption2">USUARIO</td>
		<td align=left class="AttrCaption2"><input type='text' class='AttrField' size='12' name='username' maxlength='10 '></td>
	</tr>
	<tr>
		<td align=right class="AttrCaption2">CLAVE </td>
		<td align=left class="AttrCaption2"><input type='password' class='AttrField' size='14' name='password' maxlength='12 '></td>
	</tr>
	</table>
	</td>
</tr>
</table>
<table width="10%" border="0" align="center">	    
 <tr> 
 </br>
<td  align="center"> <input   width=70% type="image" src="images/Ingresar.png" name="login" border="0" value="ingreso"  alt="ingreso"></td> 
 </tr>
</table>   
<p class="style1"> <!--<a href="mailto: info@websystemonline.com"></a></p>-->
</body>
</form>
</html>