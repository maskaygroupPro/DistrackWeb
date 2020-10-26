<?php
require_once "include/conexion.php";
$sql="select b.numpedido,b.idpedido,b.documento,left(b.cliente,30) as cliente,b.volumen,left(b.distcliente,15),b.estado,b.fecentrega,b.horentrega,
left(b.localpedido,25) as localpedido,b.placa,b.latitud,b.longitud,b.ventanaini,b.ventanafin,b.fechaprog,b.peso,b.aux1,b.orden,b.aux3,b.aux1,
left(b.dircliente,30) as direccion,left(b.refcliente,25) as refcliente,b.observacion,b.fot_foto,b.motivo,b.indice as Id from intralot.pedidos b
where b.indice='".$_GET['indice']."' order by b.placa,b.orden;";
$indice_ = $_GET['indice'];
$result = mysql_query($sql);
$datos=array();
$j=0;
$placa_ = "";
//$fechaNew = $_POST["nuevaFecha"];




while($row = mysql_fetch_array($result)) {
		$datos[$j] = $row;
		$j++;
	} 

$sql="select p.placa, p.documento, e.estado, e.motivo, e.latitud, e.longitud, e.fecha, e.hora from intralot.pedidos p inner join appdistrack.reg_estados e on p.documento = e.documento where  p.indice='".$_GET['indice']."' order by e.hora ;";
$result = mysql_query($sql);
$tiempos=array();
$j=0;
while($row = mysql_fetch_array($result)) {
        $tiempos[$j] = $row;
        $j++;
    }     

//<button type="button" id="btn" class="btn btn-info" data-toggle="modal" data-target="#myModal" >Enivar Data</button>
?>
    <div class="page-body">
        <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-hover js-exportable dataTable" cellspacing="0" width="100%">
                            <tbody>
                                <?php foreach ($datos as $key => $value):
                                    $placa_ = $value['placa']; ?>
                                
                                    <tr><td>Ord</td><td><?=$value['orden']?></td><td>Placa</td><td><?=$value['placa']?></td></tr>
                                    <tr><td>Pedido</td><td><?=$value['numpedido']?></td><td>Placa</td><td><?=$value['placa']?></td></tr>
                                    <tr><td>Estado</td><td><?=$value['estado']?></td><td>Fecha</td><td><?=$value['fechaprog']?></td></tr>
                                    
                            	<?php endforeach;?>
                                <tr><td ><strong>Nueva Fecha</strong></td> 
                                    <td>
                                        <input class="fecha" type='date' id='fechaNueva'  value='<?php echo !empty($value['fechaprog']) ? $value['fechaprog'] : date("Y-m-d",time()-(0*24*3600)) ?>'>
                                    </td>
                                </tr>
                                <tr>
                                    <td ><strong>Placa</strong></td> 
                                    <td>
                                    <input class="placa" type='text' id='placaReprog'  value='<?php echo $value['placa'] ?> '>
                                    
                                    </td>
                                </tr>

                            </tbody>                      
                    </table>
                   
                    <div>
                        <input class="btn btn-primary pull-right" type="button" id="guardarReprog" href="javascript:;" 
                        onclick="reprogramarPedido($('#fechaNueva').attr('value'), $('#placaReprog').attr('value'), <?php echo $indice_ ?>);
                        return false;" value="Reprogramar"/>
                    
                   </div>


                </div>
                <div class="panel-footer">
                	<button type="button" class="btn btn-danger " data-dismiss="modal"><i class="fa fa-close"></i> Cerrar </button>
                    <div class="result text-info" id="resultado"></div>
                </div>
        </div>
    </div>

    <style>
    .myborder {
        border: 2px solid #fe4918;
    }

    </style>
    <script>

        $(document).on('blur','#fechaNueva',function(e){
            $("#fechaNueva").attr('value', e.target.value)
            console.log('reprogramado(F): ',  $("#fechaNueva").val() )
            $('.fecha').addClass('myborder');

        });

        $(document).on('blur','#placaReprog',function(e){
            $("#placaReprog").attr('value', e.target.value)
            console.log('reprogramado(P): ',  $("#placaReprog").val() )
            $('.placa').addClass('myborder');

        });
    </script>
    
    <script>
        function reprogramarPedido(fecha, placa, indice){
            var parametros = {
                    "fecha" : fecha,
                    "placa" : placa,
                    "indice": indice
            };
            console.log(parametros);
            if (confirm('¿Estas seguro de modificar los datos?')){

                $.ajax({

                    data:  parametros, 
                    url:   'reprogramarAjax.php', 
                    type:  'post', 
                    beforeSend: function () {
                        // console.log('beforeSend')
                        $('.result').text('Procesando, espere por favor...');
                        // $('.result').append('<img src="icons/loading.gif" /> ')
                            
                    },
                    success:  function (response) { 
                        console.log(response)
                        // alert(response)
                        $(".result").html(response);
                        $('.result').removeClass('text-info').removeClass('text-danger').addClass('text-success');
                        
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 4000); 
                        
                    },
                    error: function(xhr, textStatus, errorThrown) { 
                        // if (textStatus == 'timeout') { 
                        //     $('.result').text( "Error : Timeout for this call!");
                        //     $('.result').removeClass('text-info').removeClass('text-success').addClass('text-danger');
                        // }

                        $('.result').removeClass('text-info').removeClass('text-success').addClass('text-danger');

                        if (jqXHR.status === 0) {

                        // alert('Not connect: Verify Network.');
                            $('.result').text( 'Not connect: Verify Network.');

                        } else if (jqXHR.status == 404) {

                        // alert('Requested page not found [404]');
                            $('.result').text( 'Requested page not found [404]');

                        } else if (jqXHR.status == 500) {

                        // alert('Internal Server Error [500].');
                            $('.result').text('Internal Server Error [500].');

                        } else if (textStatus === 'parsererror') {

                        // alert('Requested JSON parse failed.');
                            $('.result').text( 'Requested JSON parse failed.');

                        } else if (textStatus === 'timeout') {

                        // alert('Time out error.');
                            $('.result').text('Time out error.');

                        } else if (textStatus === 'abort') {

                        // alert('Ajax request aborted.');
                            $('.result').text( 'Ajax request aborted.');

                        } else {

                        // alert('Uncaught Error: ' + jqXHR.responseText);
                            $('.result').text( 'Uncaught Error: ' + jqXHR.responseText);

                        }


                    },

                }).fail(function(jqXHR, textStatus, errorThrown){
                    $('.result').text('Fail: ' + errorThrown); 
                });
            }   

        }
</script>