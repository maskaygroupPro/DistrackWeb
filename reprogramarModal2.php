<?php
require_once "include/conexion.php";
//header("Location: ../reprogramarModal.php");
if( ! empty($_POST)){
    $nFecha=$_POST['nuevaFecha'];
    $nIndice=$_POST['indice'];
    $nPlaca=$_POST['placa'];
    echo "Reprogramando";
    echo $nFecha;
    echo ",";
    echo $nIndice;
    echo ",";
    echo $nPlaca;

    //$query="call intralot.ReprogramarPedidos('".$nPlaca."','".$nFecha."',".$nIndice.")";
    	
  //$result=mysql_query($query) or die(mysql_error());  //die muestra el error y sale
  echo "Completado!!!";
}
//<button type="button" id="btn" class="btn btn-info" data-toggle="modal" data-target="#myModal" >Enivar Data</button>
?>

<script type="text/javascript">
var iframe = document.getElementById("iframe");
iframe.onload = function () { formSubmitResponse(iframe); };
function formSubmitResponse(iframe) {
  var idocument = (iframe.contentDocument || iframe.contentWindow.document);
  if(idocument) {
    var responseFromBackend = idocument.getElementsByTagName("body")[0].innerHTML;
  }
}
</script>
