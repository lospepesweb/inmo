<?php include '../extend/header.php';
$sel = $con->prepare("SELECT propiedad FROM inventario WHERE operacion = ?");
$sel->bind_param('s', $operacion);

?>

	<div class="row">
		<div class="col s12 m6 l6">
			<div class="card blue-grey darken-1">
				<div class="card-content">
					<span class="card-title white-text"><b>Inmuebles en venta: 
					<!-- <h2 class="white-text" align="center"> -->
						<?php 
						$operacion = 'VENTA';
						$sel->execute();
						$res_venta = $sel->get_result();
						echo mysqli_num_rows($res_venta);
						?>
					<!-- </h2> -->
					</b></span>
					<div class="card-action">
						<a href="../propiedades/index.php?ope=VENTA">Ver mas...</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col s12 m6 l6">
			<div class="card blue-grey darken-1">
				<div class="card-content">
					<span class="card-title white-text"><b>Inmuebles en alquiler: 
					<!-- <h2 class="white-text" align="center"> -->
						<?php 
						$operacion = 'ALQUILER';
						$sel->execute();
						$res_alq = $sel->get_result();
						echo mysqli_num_rows($res_alq);
						?>
					<!-- </h2> -->
					</b></span>
					<div class="card-action">
						<a href="../propiedades/index.php?ope=ALQUILER">Ver mas...</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col s12 m6 l6">
			<div class="card blue-grey darken-1">
				<div class="card-content">
					<span class="card-title white-text"><b>Inmuebles en traspaso: 
					<!-- <h2 class="white-text" align="center"> -->
						<?php 
						$operacion = 'TRASPASO';
						$sel->execute();
						$res_tra = $sel->get_result();
						echo mysqli_num_rows($res_tra);
						?>
					<!-- </h2> -->
					</b></span>
					<div class="card-action">
						<a href="../propiedades/index.php?ope=TRASPASO">Ver mas...</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col s12 m6 l6">
			<div class="card blue-grey darken-1">
				<div class="card-content">
					<span class="card-title white-text"><b>Inmuebles ocupados: 
					<!-- <h2 class="white-text" align="center"> -->
						<?php 
						$operacion = 'OCUPADO';
						$sel->execute();
						$res_ocu = $sel->get_result();
						echo mysqli_num_rows($res_ocu);
						?>
					<!-- </h2> -->
					</b></span>
					<div class="card-action">
						<a href="../propiedades/index.php?ope=OCUPADO">Ver mas...</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col s12 m6 l6">
			<div class="card red darken-5">
				<div class="card-content">
					<span class="card-title white-text"><b>Inmuebles cancelados: 
					<!-- <h2 class="white-text" align="center"> -->
						<?php 
						$operacion = 'CANCELADO';
						$sel->execute();
						$res_can = $sel->get_result();
						echo mysqli_num_rows($res_can);
						?>
					<!-- </h2> -->
					</b></span>
					<div class="card-action">
						<a href="../propiedades/index.php?ope=CANCELADO" class="white-text">Ver mas...</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col s12">
			<div class="card blue-grey darken-2">
			    <div class="card-content">
			      	<h4 align="center" class="white-text"><b>COMENTARIOS</b></h4>
			    </div>
		    	<div class="card-tabs">
			    	<ul class="tabs tabs-fixed-width tabs-transparent">
			        	<li class="tab"><a class="active" href="#nuevos">Nuevos</a></li>
			        	<li class="tab"><a href="#contestados">Contestados</a></li>
				    </ul>
		    	</div>
    			<div class="card-content white">
      				<div id="nuevos">
						<table>
			           		<th><center>Ver Inmueble</center></th>
			           		<th><center>Solicitante</center></th>
			           		<th><center>Telefono</center></th>
			           		<th><center>Correo</center></th>
			           		<th><center>Mensaje</center></th>
			           		<?php
			           		$sel_com = $con->prepare("SELECT * FROM comentarios WHERE estatus = ? ");
			           		$sel_com->bind_param('s', $estatus);
			           		$estatus = 'NUEVO';
			           		$sel_com->execute();
			           		$res_nuevo = $sel_com->get_result();
			           		while ($fn =$res_nuevo->fetch_assoc()) { ?>
			           		<tr>
			             		<td><center><button data-target="modal1" onclick="enviar(this.value)" value="<?PHP echo $fn['id_propiedad']?>" class="btn-floating"><i class="material-icons" title="Ver información">visibility</i></button></center></td>
			             		<td><center><?php echo $fn['nombre'] ?></center></td>
			             		<td><center><?php echo $fn['tel'] ?></center></td>
			             		<td><center><a href="correo.php?correo=<?php echo $fn['correo'] ?>&nombre=<?php echo $fn['nombre'] ?>&id_msj=<?php echo $fn['id'] ?>"><?php echo $fn['correo'] ?></a></center></td>
			             		<td><center><?php echo $fn['mensaje'] ?></center></td>
			           		</tr>
			           		<?php } ?>
			         	</table>
      				</div>
      				<div id="contestados">
      					<table>
			           		<th><center>Ver Inmueble</center></th>
			           		<th><center>Solicitante</center></th>
			           		<th><center>Telefono</center></th>
			           		<th><center>Correo</center></th>
			           		<th><center>Mensaje</center></th>
			           		<?php
			           		$estatus = 'CONTESTADO';
			           		$sel_com->execute();
			           		$res_visto = $sel_com->get_result();
			           		while ($fc =$res_visto->fetch_assoc()) { ?>
			           		<tr>
			             		<td><center><button data-target="modal1" onclick="enviar(this.value)" value="<?PHP echo $fc['id_propiedad']?>" class="btn-floating"><i class="material-icons" title="Ver información">visibility</i></button></center></td>
			             		<td><center><?php echo $fc['nombre'] ?></center></td>
			             		<td><center><?php echo $fc['tel'] ?></center></td>
			             		<td><center><?php echo $fc['correo'] ?></center></td>
			             		<td><center><?php echo $fc['mensaje'] ?></center></td>
			           		</tr>
			           		<?php } ?>
			         	</table>
      				</div>
    			</div>
  			</div>
		</div>
	</div>
	
<div id="modal1" class="modal">
	<div class="modal-content">
  		<h4>Informacion</h4>
  		<div id="res_modal">
  			
  		</div>
	</div>
	<div class="modal-footer">
  		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</div>

<?php include '../extend/scripts.php' ?>
<script>
	$('.modal').modal();
	function enviar(str){
		$.get('../propiedades/modal.php',{
			id:str,
			beforeSend: function(){
				$('#res_modal').html("Espere un momento por favor...");
			}
		}, function(respuesta){
			$('#res_modal').html(respuesta);
		});
	};

// $('.modal').modal();
//   function enviar(str){
//     $.get('modal.php',{
// 		  id:str,
// 		  beforeSend: function(){
//         $('#res_modal').html("Espere un momento por favor...");
// 		  }
//     }, function(respuesta){
// 		  $('#res_modal').html(respuesta);
//     });
//   };
</script>
</body>
</html>