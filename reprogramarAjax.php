<?php 

    session_start(); 
    if ( !isset($_SESSION["ID"])  ){
    header("Location: FIN_CONEXION.php");
    }

    require_once "include/conexion.php";

    if (!empty($_POST['fecha']) && !empty($_POST['placa']) && !empty($_POST['indice'])){
        $fecha = $_POST['fecha'];
        $placa = $_POST['placa']; 
        $indice = $_POST['indice']; 
    }
    else
    {
        echo "Algunos datos estan vacios.";
    }
    // echo "CALL intralot.ReprogramarPedidos('". $placa ."','" . $fecha . "','" . $indice . "')"; // respondiendo la solicitud ajax
    
    $query = "CALL intralot.ReprogramarPedidos('". $placa ."','" . $fecha . "','" . $indice . "')";

    $result = mysql_query($query ) or die (mysql_error());

    if ($result){
        // echo "Pedido reprogramado! ".$result;
        echo "Pedido reprogramado! ";
    }
    else
        echo "Algo sucedio, no se realizaron cambios ".$result;

?>