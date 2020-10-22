<?php
require "include/conexion.php";
session_start();

$con=$_POST['contenido'];
$cam=$_POST['campo'];


$hst=date("Y-m-d");
$dsd=date("Y-m-d",strtotime($hasta."- 1 days")); 
$cmps="indice, fechaprog, cliente, distcliente, placa, documento, estado, producto, motivo";

$ordn="fechaprog, cliente";
$tabl="alcha.pedidos";
if (!empty($cam) && !empty($con)) {
	$cond="(fechaprog between '".$dsd."' and '".$hst."') and ".$cam." like '%".$con."%'" ;
}else{
	$cond="(fechaprog between '".$dsd."' and '".$hst."')" ;
}
$query="select ".$cmps." from ".$tabl." where ".$cond." order by ".$ordn.";";
$result=mysql_query($query);


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

    <title>Distrack, Sub Usuarios</title>
    <style type="text/css">
    	.ent{
    		background-color: #03C906;
    		color:white;
    	}
    	.noe{
    		background-color: #FC1D16;
    		color:white;
    	}
    	.par{
    		background-color: #FDCA2A;
    		color:white;
    	}
    	.otr{
    		background-color: #F9FC16;
    		color:black;
    	}

    </style>

  </head>
  <body>
    <div class="container">
    	<h1>Consulta tus Pedidos</h1>
    	<form method="POST">
	        <div class="form-group row">
    			<label for="desde" class="col-sm-1 col-form-label">Desde</label>
	            <div class="col-sm-2">
	              <?php echo "<input type='date' id='desde' name='desde' class='form-control' value='".$dsd."'>";?>              
	            </div>
    			<label for="hasta" class="col-sm-1 col-form-label">Hasta</label>
	            <div class="col-sm-2">
	              <?php echo "<input type='date' id='hasta' name='hasta' class='form-control' value='".$hst."'>";?>              
	            </div>
	            <div class="col-sm-6"></div>
	        </div>

	        <div class="form-group row">
    			<label for="campo" class="col-sm-1 col-form-label">Dato</label>
	            <div class="col-sm-2">
		          <select class="form-control" id="campo" name="campo">
		          	<?php echo "<option value='".$cam."' selected>".$cam."</option>";?>
		          	<option value="cliente">Destinatario</option>
		          	<option value="dist_cliente">Distrito</option>
		          	<option value="documento">Codigo</option>
		          	<option value="estado">Estado</option>
		          	<option value="producto">Cliente</option>
		          </select>          
	            </div>
    			<label for="contenido" class="col-sm-1 col-form-label">Contenido</label>
	            <div class="col-sm-2">
	              <?php echo "<input type='text' id='contenido' name='contenido' class='form-control' value='".$con."'>";?>              
	            </div>
	            <div class="col-sm-6"><button type="submit" class="btn btn-primary">Consulta</button> </div>
	        </div>
    	</form>
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Fecha</th>
		      <th scope="col">Codigo</th>
		      <th scope="col">Destinatario</th>
		      <th scope="col">Distrito</th>
		      <th scope="col">Cliente</th>
		      <th scope="col" align="center">Estado</th>
		      <th scope="col"></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
				$result=mysql_query($query);
	  	      	while ($reg=mysql_fetch_row($result)){
			        $num++;
			        
			        $ind=$reg[0];
			        $fec=$reg[1];
			        $cli=$reg[2];
			        $dis=$reg[3];
			        $pla=$reg[4];
			        $doc=$reg[5];
			        $est=$reg[6];
			        $pro=$reg[7];
			        $mot=$reg[8];
			        switch ($est) {
			        	case 'Entregado':
			        		$cls="class='ent'";
			        		break;		        	
			        	case 'Parcial':
			        		$cls="class='par'";
			        		break;
			        	case 'No Entregado':
			        		$cls="class='noe'";
			        		break;
						case 'En Ruta':
							$cls="";
							break;
			        	default:
			        		$cls="otr";
			        		break;
			        }
                echo "<tr>";
                $ubic = "getContent.php?var0=".$ind;
		        echo "<td>".$num."</td><td>".$fec."</td><td>".$doc."</td><td>".$cli."</td><td>".$dis."</td><td>".$pro."</td><td align='center'".$cls.">".$est."</td><td> <a href='".$ubic."'><i class='fa fa-info-circle' aria-hidden='true'></i></a></td>";
		        
		        echo "</tr>";
		    	}
			
		  	?>
		  </tbody>
		</table>




    </div>


	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </body>
</html>