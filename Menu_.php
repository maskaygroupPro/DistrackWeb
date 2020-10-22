<?
session_start();
if ( !isset($_SESSION['ID']) || !isset($_SESSION['FullName'])){
	//header("Location: FIN_CONEXION.php");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Sistema de Control</title>
</head>
<!--	<frameset rows="*" cols="160,857*" frameborder="NO" border="0" framespacing="0"> 
  <frame name="leftFrame" scrolling="NO" noresize src="PORTAL_Tree.php">  -->
<!--<frameset rows="90%,**" frameborder="NO" border="0" framespacing="0" cols="*">-->
<frameset rows="100%" frameborder="NO" border="0" framespacing="0" cols="*">
    <frame name="topFrame" src="Menu_Head.php" scrolling="auto">
    <!--<frame name="mainFrame" src="Menu_Detail.php" scrolling="auto">-->
 </frameset>
<noframes>
<body bgcolor="#FFFFFF" >
</body>
</noframes>
</html>