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

    $result = mysql_query($query ) ;
    
    // mysql_close();

    if($result === false){
        // echo "Pedido reprogramado! ".$result;
        die( "Algo sucedio, no se realizaron cambios. ".mysql_error() . '::'.mysql_errno());
    }
    else
        echo "Pedido reprogramado! ";

?>