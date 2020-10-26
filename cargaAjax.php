<?php 

    session_start(); 
    if ( !isset($_SESSION["ID"])  ){
    header("Location: FIN_CONEXION.php");
    }

    require_once "include/conexion.php";


    // echo "Post ";
    // var_dump($_POST);

    // $filename=$_FILES["file"]["tmp_name"];
    // if($_FILES["file"]["size"] > 0)
    // {
    //     // echo "pedido recibido";
    //     $file = fopen($filename, "r");
    //     $emapData = fgetcsv($file, 10000, ",");
    //     $cont = true;
    //     while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
    //     {
    //         print_r($emapData);
    //     }
    // }
    // else {
    //     echo 'noe enviaste nada';
    // }
    // return ;

    // Retornara los diferentes tipos de sucesos para la BD
    $result = [];

    //echo "<script>console.log('Entre' );</script>";
    if(isset($_POST["Import"]))
    {
        // echo "Cargando pedido";
        // return;
        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
        {
            // echo "pedido recibido";
            echo "";
            $file = fopen($filename, "r");
            $emapData = fgetcsv($file, 10000, ",");
            $cont = true;
            $flagAux = true;
            $parte2 = "";
            $parte22 = "";
            //echo "<script>console.log('hay data' );</script>";
            $num=0;
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                //echo "<script>console.log('-num-',$num );</script>";
                //echo "<script>console.log('***' );</script>";
                //$num=$num+1;
                //  echo $emapData[1];
                //  echo "";
                if($cont){
                    $cont=false;
                    // TODO: REVISAR PROCEDIMIENTO DE LA VARIABLE fechaprog, (1968)/Typo
                    $query9="call intralot.ProgramarMateriales('".$emapData[1]."')";
                    $resultAux=mysql_query($query9) ;  //die muestra el error y sale
                    if($resultAux){
                        // echo "Consulta Ok Programar MAteriales";
                        
                    }
                    else {
                        $result['error'] =  mysql_error();
                        echo json_encode($result); 
                        return;

                    }
                    //call intralot.ProgramarMateriales($emapData[1]);
                }
                
                $numPedido_ = $emapData[0];
                $fechaProg_ = $emapData[1];
                $idPedido_ = $numPedido_ .".". date("ymd", strtotime($fechaProg_));
                $localPedido_ = "";
                $cantidad_ = "0";
                $volumen_ = "0";
                
                $cliente_ = "";
                $telfCliente_ = "";
                $dirCliente_ = "";
                $disCliente_ = "";
                $refCliente_ = "";
                $clase_ = "";
                $lat_prg_ = "";
                $lon_prg_ = "";
                $rad_prg_ = "";

                $queryAux = "SELECT d.nombre,d.direccion,d.distrito,d.region,d.cod_zona,d.latitud,d.longitud,d.radio  FROM intralot.terminales as d WHERE d.terminal = "."'".$numPedido_."'";
                $ress = mysql_query($queryAux);
                while($row = mysql_fetch_array($ress)) {
                    $cliente_ =  $row["nombre"];
                    $dirCliente_ =  $row["direccion"];
                    $disCliente_ =  $row["distrito"];
                    $refCliente_ =  $row["region"];
                    $clase_ = $row["cod_zona"];
                    $lat_prg_ = $row["latitud"];
                    $lon_prg_ = $row["longitud"];
                    $rad_prg_ = $row["radio"];
                } 
                
                
                
                $codProducto_ = $emapData[0];
                $placa_ = $emapData[2];
                $orden_ = $emapData[3];
                $documento_ = $numPedido_ .".". date("ymd", strtotime($fechaProg_));
                $estado_ = "En Ruta";
                $idPlaca_ = "";
                
                $queryAuxx = "SELECT d.VehicleID FROM gpslog.livedata as d WHERE d.VehicleReg = "."'".$placa_."' and d.VehicleActive='1'" ;
                $resss = mysql_query($queryAuxx);
                while($row = mysql_fetch_array($resss)) {
                    $idPlaca_ =  $row["VehicleID"];  
                }
                
                $peso_ = "0";
                //$clase_ = "";
                $aux1_ = "0";
                $aux2_ = "0";
                $aux3_ = "0";
                $aux4_ = "0";
                $aux5_ = "0";
                $u_transportista_ = "";
                $queryAux = "SELECT d.usuario  FROM appdistrack.usuarios as d WHERE d.completo = "."'".$placa_."' and d.organizacion='INTRALOT'";
                $ress = mysql_query($queryAux);
                while($row = mysql_fetch_array($ress)) {
                    $u_transportista_ =  $row["usuario"];
                } 

                $etapa_ = "EN RUTA";
                $corrini_ = date("Ymd", strtotime($fechaProg_))."080000";
                $corract_ = date("Ymd", strtotime($fechaProg_))."080000";;
                $molde_ = "";
                $detalle_ = $emapData[4]; //tipo de programacon
                
                $parte1 = "intralot.pedidos(numpedido,idpedido,localpedido,fechaprog,cantidad,volumen,cliente,telfcliente,dircliente,distcliente,refcliente,codproducto,placa,orden,documento,estado,idplaca,peso,clase,aux1,aux2,aux3,aux4,aux5,u_transportista,lat_prg,lon_prg,rad_prg,etapa,corrini,corract,molde,detalle)"; 
//                $parte2 .= "('$numPedido_','$idPedido_','$localPedido_','$fechaProg_','$cantidad_','$volumen_','$cliente_','$telfCliente_','$dirCliente_','$disCliente_','$refCliente_','$codProducto_','$placa_','$orden_','$documento_','$estado_','$idPlaca_','$peso_','$clase_','$aux1_','$aux2_','$aux3_','$aux4_','$aux5_','$u_transportista_','$lat_prg_','$lon_prg_','$rad_prg_','$etapa_','$corrini_','$corract_','$molde_','$detalle_'), ";
                

                $clienteMoli = $orden_." ".$cliente_;

                $parte11 = "molitalia.pedidos(estado,codproducto,placa,orden,documento,u_transportista,numpedido,idpedido,localpedido,fechaprog,cantidad,volumen,cliente,telfcliente,dircliente,distcliente,refcliente,peso,molde,detalle)"; 
                //$parte22 .= "('$estado_','$codProducto_','$placa_','$orden_','$documento_','$u_transportista_','$numPedido_','$idPedido_','$localPedido_','$fechaProg_','$cantidad_','$volumen_','$clienteMoli','$telfCliente_','$dirCliente_','$disCliente_','$refCliente_','$peso_','INTRALOT','$detalle_'), ";
                if($flagAux){
                    $flagAux=false;
                    $parte2 .= "('$numPedido_','$idPedido_','$localPedido_','$fechaProg_','$cantidad_','$volumen_','$cliente_','$telfCliente_','$dirCliente_','$disCliente_','$refCliente_','$codProducto_','$placa_','$orden_','$documento_','$estado_','$idPlaca_','$peso_','$clase_','$aux1_','$aux2_','$aux3_','$aux4_','$aux5_','$u_transportista_','$lat_prg_','$lon_prg_','$rad_prg_','$etapa_','$corrini_','$corract_','$molde_','$detalle_')";
                    $parte22 .= "('$estado_','$codProducto_','$placa_','$orden_','$documento_','$u_transportista_','$numPedido_','$idPedido_','$localPedido_','$fechaProg_','$cantidad_','$volumen_','$clienteMoli','$telfCliente_','$dirCliente_','$disCliente_','$refCliente_','$peso_','INTRALOT','$detalle_')";
                }else{
                    $parte2 .= ", ('$numPedido_','$idPedido_','$localPedido_','$fechaProg_','$cantidad_','$volumen_','$cliente_','$telfCliente_','$dirCliente_','$disCliente_','$refCliente_','$codProducto_','$placa_','$orden_','$documento_','$estado_','$idPlaca_','$peso_','$clase_','$aux1_','$aux2_','$aux3_','$aux4_','$aux5_','$u_transportista_','$lat_prg_','$lon_prg_','$rad_prg_','$etapa_','$corrini_','$corract_','$molde_','$detalle_')";
                    $parte22 .= ", ('$estado_','$codProducto_','$placa_','$orden_','$documento_','$u_transportista_','$numPedido_','$idPedido_','$localPedido_','$fechaProg_','$cantidad_','$volumen_','$clienteMoli','$telfCliente_','$dirCliente_','$disCliente_','$refCliente_','$peso_','INTRALOT','$detalle_')";
                }
                // insert into $columas  (data1, dato2), (data1, dato2),(data1, dato2),(data1, dato2),(data1, dato2),(data1, dato2),(data1, dato2)

                
            }
            $sql = "INSERT into $parte1 values $parte2 ";
            $resultado1 = mysql_query($sql);

            $sql2 = "INSERT into $parte11 values $parte22";
            $resultado2 = mysql_query($sql2);
            if($resultado1 && $resultado2){
                $result['success'] = "Pedidos guardados  exitosamente.";
                // echo "todo correcto";
                
            }
            else{
                $result['error'] = "ocurio un error en la terminal";
                // echo json_encode($result); 

                // break;
            }


            fclose($file);
            // echo $parte11. ' => ' . $parte22;
            // echo 'Se Cargo correctamente pedidos';
            echo json_encode($result); 
            // header('Location: carga.php');
            //echo "respuesta aqui"; 
        }
        else{

            $result['error'] = 'Pedidos: Formato no aceptado, solo .CSV'; 

            echo json_encode($result);
        }

        
    }



    //CARGAR CONSUMIBLES
    if(isset($_POST["Import2"]))
    {
        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
        {
            $file = fopen($filename, "r");
            $emapData = fgetcsv($file, 10000, ",");
            $flagAux = true;
            $parte2 = "";
            
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                $codeReparto_ = $emapData[1].".".date("ymd", strtotime($emapData[0]));
                $fechaProg_ = $emapData[0];
                $terminal_ = $emapData[1];
                $nombre_ = "";
                $placa_ = "";
                $queryAux = "SELECT d.cliente, d.placa  FROM intralot.pedidos as d WHERE d.numpedido = "."'".$terminal_."' and d.fechaprog='".$fechaProg_."'";
                $ress = mysql_query($queryAux);
                if($row = mysql_fetch_array($ress)){
                    $nombre_ =  $row["cliente"];
                    $placa_ =  $row["placa"];
                }
                $item3926_ = $emapData[2];
                $item4788_ = $emapData[3];
                $item5667_ = $emapData[4];
                $item5669_ = $emapData[5];
                $item5668_ = $emapData[6];
                $item0915_ = $emapData[7];
                $item0861_ = $emapData[8];
                $item2587_ = $emapData[9];
            
                $parte1 = "intralot.prg_consumibles(codreparto,fechaprog,terminal,nombre,item3926,item4788,item5667,item5669,item5668,item0915,item0861,item2587,placa)"; 
//                $parte2 = "('$codeReparto_','$fechaProg_','$terminal_','$nombre_','$item3926_','$item4788_','$item5667_','$item5669_','$item5668_','$item0915_','$item0861_','$item2587_','$placa_')";
                if($flagAux){
                    $flagAux=false;
                    $parte2 .= "('$codeReparto_','$fechaProg_','$terminal_','$nombre_','$item3926_','$item4788_','$item5667_','$item5669_','$item5668_','$item0915_','$item0861_','$item2587_','$placa_')";                  
                }else{
                    $parte2 .= ", ('$codeReparto_','$fechaProg_','$terminal_','$nombre_','$item3926_','$item4788_','$item5667_','$item5669_','$item5668_','$item0915_','$item0861_','$item2587_','$placa_')";                  
                }

                //$sql = "INSERT into $parte1 values $parte2 ";
//                mysql_query($sql);

            }
            $sql = "INSERT into $parte1 values $parte2 ";
            $resultado1 = mysql_query($sql);
            if($resultado1){
                $result['success'] = "Pedidos guardados  exitosamente.";
                // echo "todo correcto";
            }
            else{
                $result['error'] = "ocurio un error en la terminal";
                // echo json_encode($result); 

                // break;
            }

            fclose($file);
            //echo 'Se Cargo correctamente consumibles';
            //header('Location: carga.php');
            echo json_encode($result); 
        }
        else{
            $result['error'] = 'Pedidos: Formato no aceptado, solo .CSV'; 

            echo json_encode($result);
            //echo 'Consumible: Formato no aceptado, solo .CSV';  
        }
        

    }


    //CARGAR LOGISTICO
    if(isset($_POST["Import3"]))
    {
        $filename=$_FILES["file"]["tmp_name"];
        
        if($_FILES["file"]["size"] > 0)
        {
            
            $file = fopen($filename, "r");
            
            $emapData = fgetcsv($file, 10000, ",");
            $flagAux = true;
            $parte2 = "";
            
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                $fechaProg_ = $emapData[0];
                $terminal_ = $emapData[1];
                $codigo_ = $emapData[2];
                $cantidad_ = $emapData[3];
                $descripcion_ = $emapData[4];
                $caso_ = $emapData[5];

                $nombre_ = "";

                $placa_ = "";
                $queryAux = "SELECT d.placa  FROM intralot.pedidos as d WHERE d.numpedido = "."'".$terminal_."' and d.fechaprog='".$fechaProg_."'";
                $ress = mysql_query($queryAux);
                if($row = mysql_fetch_array($ress)){
                    $placa_ =  $row["placa"];
                }

                $codReparto_ = $emapData[1].".".date("ymd", strtotime($emapData[0]));
                
                $parte1 = "intralot.prg_logisticos(terminal,nombre,cantidad,descripcion,caso,fechaprog,placa,codreparto)"; 
                //$parte2 = "('$terminal_','$nombre_','$cantidad_','$descripcion_','$caso_','$fechaProg_','$placa_','$codReparto_')";
                
                if($flagAux){
                    $flagAux=false;
                    $parte2 .= "('$terminal_','$nombre_','$cantidad_','$descripcion_','$caso_','$fechaProg_','$placa_','$codReparto_')";
                }else{
                    $parte2 .= ", ('$terminal_','$nombre_','$cantidad_','$descripcion_','$caso_','$fechaProg_','$placa_','$codReparto_')";
                    
                }
                
                //$sql = "INSERT into $parte1 values $parte2 ";
                //mysql_query($sql);

            }
            $sql = "INSERT into $parte1 values $parte2 ";
            $resultado1 = mysql_query($sql);

            if($resultado1){
                $result['success'] = "Pedidos guardados  exitosamente.";
                // echo "todo correcto";
            }
            else{
                $result['error'] = "ocurio un error en la terminal";
                // echo json_encode($result); 
                // break;
            }


            fclose($file);

            echo json_encode($result); 
            //echo 'Se Cargo correctamente logisticos';
            //header('Location: carga.php');
        }
        else{
            $result['error'] = 'Pedidos: Formato no aceptado, solo .CSV'; 

            echo json_encode($result);
            //echo 'Consumible: Formato no aceptado, solo .CSV';  
        }
            
            

    }


    //CARGAR INSTANTANEAS
    if(isset($_POST["Import4"]))
    {
        
        $filename=$_FILES["file"]["tmp_name"];
        
        
        if($_FILES["file"]["size"] > 0)
        {
            
            $file = fopen($filename, "r");
        
            $emapData = fgetcsv($file, 10000, ",");
            $flagAux = true;
            $parte2 = "";
            
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                $fechaProg_ = $emapData[0];
                $terminal_ = $emapData[1];
                $cod_juego_ = $emapData[2];
                $cant_libro_ = $emapData[3];
                $cant_ticket_ = $emapData[4];
                $precio_ = $emapData[5];
                $item_ = $emapData[6];
                $descripcion_ = $emapData[7];
                $orden_ = $emapData[8];

                $codReparto_ = $emapData[1].".".date("ymd", strtotime($emapData[0]));
                $nombre_ = "";
                $dato_ = $terminal_."-".$orden_;

                $placa_ = "";
                $queryAux = "SELECT d.placa  FROM intralot.pedidos as d WHERE d.numpedido = "."'".$terminal_."' and d.fechaprog='".$fechaProg_."'";
                $ress = mysql_query($queryAux);
                if($row = mysql_fetch_array($ress)){
                    $placa_ =  $row["placa"];
                }

                
                $parte1 = "intralot.prg_instantaneas(codreparto,cod_juego,cant_libro,cant_ticket,precio,item,descripcion,nombre,orden,dato,fechaprog,placa)"; 
                //$parte2 = "('$codReparto_','$cod_juego_','$cant_libro_','$cant_ticket_','$precio_','$item_','$descripcion_','$nombre_','$orden_','$dato_','$fechaProg_','$placa_')";

                if($flagAux){
                    $flagAux=false;
                    $parte2 .= "('$codReparto_','$cod_juego_','$cant_libro_','$cant_ticket_','$precio_','$item_','$descripcion_','$nombre_','$orden_','$dato_','$fechaProg_','$placa_')";
                }else{
                    $parte2 .= ", ('$codReparto_','$cod_juego_','$cant_libro_','$cant_ticket_','$precio_','$item_','$descripcion_','$nombre_','$orden_','$dato_','$fechaProg_','$placa_')";
                    
                }
  //              $sql = "INSERT into $parte1 values $parte2 ";
                //mysql_query($sql);

            }
            $sql = "INSERT into $parte1 values $parte2 ";
            $resultado1 = mysql_query($sql);

            if($resultado1){
                $result['success'] = "Pedidos guardados  exitosamente.";
                // echo "todo correcto";
            }
            else{
                $result['error'] = "ocurio un error en la terminal";
                // echo json_encode($result); 
                // break;
            }


            fclose($file);
            echo json_encode($result); 
            //echo 'Se Cargo correctamente instantaneas';
            //header('Location: carga.php');
        }
        else{
            $result['error'] = 'Pedidos: Formato no aceptado, solo .CSV'; 

            echo json_encode($result);
        }
            
             

    }



?>