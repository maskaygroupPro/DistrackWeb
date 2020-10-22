<?php
require_once "include/conexion.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$head="<img align='center' width='90%' src='http://190.12.73.86/ddaryza/images/medio.jpg'>";
$salto="</tr><tr>";

$cmps="indice, estado, motivo, placa, documento, aux3, nombre, peso, volumen, horentrega, conductor, observacion, email_1, email_2, cliente, numpedido, u_transportista,localpedido,latitud, longitud, refcliente";
$tabl="ddaryza.pedidos";
$cond="f_email<>'1' and fechaprog=current_date and estado in ('Entregado','No Entregado','Parcial')";
$qery="select ".$cmps." from ".$tabl." where ".$cond." order by indice limit 5;";
#echo $qery;
$resu=mysql_query($qery);
if (!$resu) {
    die('Error query: ' . mysql_error());
    $num_rows = mysql_num_rows($resu);
    echo "$num_rows Rows\n";
}
$NO=0;
while ($row = mysql_fetch_array($resu)) {
    $NO++;
    $INDI[$NO]     =$row[0];
    $ESTA[$NO]     =$row[1];
    $MOTI[$NO]     =$row[2];
    $PLAC[$NO]     =$row[3];
    $DOCU[$NO]     =$row[4];
    $AUX3[$NO]     =$row[5];
    $NOMB[$NO]     =$row[6];
    $PESO[$NO]     =$row[7];
    $VOLU[$NO]     =$row[8];
    $HORE[$NO]     =$row[9];
    $CHOF[$NO]     =$row[10];
    $OBSE[$NO]     =$row[11];
    $EMA1[$NO]     =$row[12];
    $EMA2[$NO]     =$row[13];    
    $CLIE[$NO]     =$row[14];    
    $NPED[$NO]     =$row[15];    
    $USUA[$NO]     =$row[16];    
    $LOCA[$NO]     =$row[17];
    $LATI[$NO]     =$row[18];
    $LONG[$NO]     =$row[19];
    $REFC[$NO]     =$row[20];


    #$LENG[$NO]     =$row[12];
}
if ($NO > 0){
    for ($i=1;$i<=$NO;$i++){
        $message="<center><i>".$head;
        switch ($ESTA[$i]) {
            case 'Entregado':
                $message.= "<H2>SU PEDIDO HA SIDO ENTREGADO\n\n SATISFACTORIAMENTE</H2>";
                $message.= "Nos complace informarle que su pedido ha sido entregado de manera exitosa";
                break;
            case 'No Entregado':
                $message.= "<H2>SU PEDIDO NO HA SIDO RECIBIDO\n\n </H2>";
                $message.= "Se encontro una observacion durante el proceso de entrega";
                break;
            case 'Parcial':
                $message.= "<H2>SU PEDIDO HA SIDO ENTREGADO\n\n DE FORMA PARCIAL</H2>";
                $message.= "Le informamos que su pedido ha sido entregado de manera parcial";
                break;
        }
        $message.= "<H3>Detalle del Pedido</H3>";
        $message.="<table width='90%'>";
        $message.="<tr>";
        $message.="<th>CLIENTE</th>"."<td colspan='5'>".$CLIE[$i]."</td>".$salto;
        $message.="<th>SUCURSAL</th>"."<td colspan='5'>".$LOCA[$i]."</td>".$salto;
        $message.="<th>SEDE</th>"."<td colspan='5'>".$REFC[$i]."</td>".$salto;
        $message.="<th>PEDIDO</th>"."<td colspan='2' >".$NPED[$i]."</td>"."<th>O.COMPRA</th>"."<td colspan='2'>".$AUX3[$i]."</td>".$salto;
        $message.="<th>VENDEDOR</th>"."<td colspan='5' >".$NOMB[$i]."</td>".$salto;
        $message.="<th>DOCUMENTO</th>"."<td >".$DOCU[$i]."</td>"."<th>PESO</th>"."<td >".$PESO[$i]."</td>"."<th>VOLUMEN</th>"."<td >".$VOLU[$i]."</td>".$salto;
        $message.="<th>ESTADO</th>"."<td colspan='2' >".$ESTA[$i]." - ".$MOTI[$i]."</td>"."<th>HORA</th>"."<td colspan='2'>".$HORE[$i]."</td>".$salto;
        $message.="<th>PLACA</th>"."<td>".$PLAC[$i]."</td>"."<th>CHOFER</th>"."<td colspan='3'>".$CHOF[$i]."</td>".$salto;
        $message.="<th>OBSERVACION</th>"."<td colspan='4' >".$OBSE[$i]."</td>";
        $message.="<td align='center' ><a href='http://maps.google.es/?q=".$LATI[$i]."%20".$LONG[$i]."'><img width='150%' src='http://190.12.73.86/ddaryza/images/ubicacion.png'></a></td>";
        $message.="</tr>";
        $message.="</table>";
        $qfoto="select ruta, documento from appdistrack.reg_fotos where documento='".$DOCU[$i]."' and fecha=current_date and usuario='".$USUA[$i]."' order by id_log_fotos limit 6 ;";
        $resul=mysql_query($qfoto);
    
        if (!$resul) {
            die('Error query: ' . mysql_error());
            $num_rows = mysql_num_rows($resul);
            echo "$num_rows Rows\n";
        }else{
            $dto=$DOCU[$i];
            $message.="<br><H3>Imagenes de Despacho</H3>";
            $message.="<table width='20%'>";
            $message.="<tr>";
            while ($fil = mysql_fetch_array($resul)) {
                $message.="<td align='center'>";
                $message.="<a href='http://tracklogservice.com:3010/".$fil[0]."'><img width='80%' src='http://tracklogservice.com:3010/".$fil[0]."'></a>";   
                #echo "<img width='30%' src='http://tracklogservice.com:3010/".$fil[0]."'>";    
                $message.="</td>";
            }
            $message.="</tr>";
            $message.="</table>";
            
            $message.="Si no logra ver las imagenes <a href='http://190.12.73.86/ddaryza/show_galeria_app.php?var0=".$dto."'>Haga click aqui</a>";
            #echo $dto;
            $message.="<H3>Gracias por su preferencia en Daryza</H3>";
            $message.="<table width='90%'><tr><td><h6>Por favor no responder este correo. Si no desea recibir publicidad ni informacion de Daryza en su correo, por favor enviar un mail a su asesor designado. Si tuviera alguna consulta, por favor comuniquese con la central telefonica: (01) 315-3600. Si este correo omite vocales con tilde, letras n o estas son cambiadas por otros caracteres, esto puede originarse por la configuracion del servidor de su correo o la version de su navegador. El sistema de correo electronico de Daryza esta destinado unicamente para fines de negocio; cualquier otro uso contraviene las politicas de Daryza. Toda la informacion del negocio contenida en este mensaje es confidencial y de uso exclusivo de Daryza. Su divulgacion, copia y/o adulteracion estan prohibidas y solo debe ser conocida por la persona a quien se dirige este mensaje. Esta informacion se envía de acuerdo a la legislacion sobre correo electronico no solicitado - SPAM segun leyes 28493 y 29426.</h6></td></tr></table>";
        }    

        $message.="</i></center>";
        
           	$body = "<html>\n"; 

           	$body .= "<head>";
           	$body .= "<style>\n";
        	$body.="
        		  table {
        		    border-collapse: collapse;
        		  }
        		  	th {
        		    background-color: #05BB20;
        		    color: white;
        		    border: 1px solid white;
        		    padding: 8px;
        		    text-align: left;
                    font-family:Arial, Arial, Verdana, sans-serif;
                    font-size: 12px;
                    font-style: italic;
        		  }
        		    td {
        		    background-color: #F1F1F1;
        		    color: #878886;
        		    border: 1px solid white;
        		    padding: 8px;
        		    text-align: left;
                    font-family:Arial, Arial, Verdana, sans-serif;
                    font-size: 12px;
                    font-style: italic;
        		  }
          		    ts {
        		    background-image: linear-gradient(-90deg, green, white);
        		    color: #878886;
        		    border: 1px solid white;
        		    padding: 8px;
        		    text-align: left;
        		  }";
        		
          
           	$body .="</style>";
           	$body .= "</head>";
            $body .= "<body style=\"font-family:Arial, Arial, Verdana, sans-serif;\">\n"; 
            $body .= $message; 
            $body .= "</body>\n"; 
            $body .= "</html>\n"; 

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
        #    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.tracklog.info';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'alertas@tracklog.info';                     // SMTP username
            $mail->Password   = 'Passalertas123';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('alertas@tracklog.info', 'Distrack');
            #$mail->addAddress('jcescalantep@gmail.com');     // Add a recipient

            $arr_to=array();
            $arr_to= (explode(" ",str_ireplace(";","",$EMA1[$i])));
            for ($g=0; $g < count($arr_to); $g++) { 
                $mail->addAddress($arr_to[$g]);    
            }
            if ($ESTA[$i]<>'Entregado') {
                $arr_cc=array();
                $arr_cc= (explode(" ",str_ireplace(";","",$EMA2[$i])));
                for ($f=0; $f < count($arr_cc); $f++) { 
                    $mail->addCC($arr_cc[$f]);    
                }
            }

            #$mail->addAddress('jescalante@daryza.pe');     // Add a recipient
            $mail->addReplyTo('alertas@tracklog.info', 'Distrack Alertas');
            #$mail->addCC('dvarela@daryza.pe');
            #$mail->addBCC('cfuentes@tracklog.pe');
            #$mail->addBCC('epicentro0@gmail.com');

            // Attachments
            #$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "Distrack, Doc: ".$DOCU[$i]." | ".$CLIE[$i]." | ".$ESTA[$i] ;
            $mail->Body    = $body;
            #$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            #echo 'Message has been sent';
            #echo $message;
            mysql_query("update ddaryza.pedidos set f_email='1' where indice=".$INDI[$i].";");
            echo $HORE[$i]." | ".$DOCU[$i]." | ".$CLIE[$i]." >>> ".$ESTA[$i]." - ".$MOTI[$i]."<br>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
}
}
header("refresh: 30");
?>