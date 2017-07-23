<?php include '../extend/header.php'; 

  $sel = $con->prepare("SELECT propiedad,consecutivo,nombre_cliente,calle_num,barrio,provincia,departamento,precio,forma_pago,asesor,tipo_inmueble,operacion,mapa, foto_principal FROM inventario WHERE estatus = 'CANCELADO' ");

?>

<br>
<div class="row">
	<div class="col s12">
		<nav class="brown lighten-3">
			<div class="nav-wrapper">
				<div class="input-field">
					<input type="search" id="buscar" autocomplete="off">
					<label class="label-icon" for="buscar"><i class="material-icons">search</i></label>
					<i class="material-icons">close</i>
				</div>
			</div>
		</nav>
	</div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Propiedades</span>
        <table>
          <thead>
            <tr class="cabecera">
              <th><center>Vista</center></th>
              <th><center>Num</center></th>
              <th><center>Cliente</center></th>
              <th><center>Propiedad</center></th>
              <th><center>Precio</center></th>
              <th><center>Credito</center></th>
              <th><center>Asesor</center></th>
              <th><center>Tipo</center></th>
              <th><center>Operacion</center></th>
              <th colspan="2"><center>Opciones</center></th>
            </tr>
          </thead>
          <?php          
          $sel->execute();
          $res = $sel->get_result();
          while ($f =$res->fetch_assoc()) {?>
            <tr>
              <td><center><button data-target="modal1" id="mod" value="<?PHP echo $f['propiedad']?>" class="btn-floating"><i class="material-icons" title="Ver información">visibility</i></button></center></td>
              <td><center><?php echo $f['consecutivo'] ?></center></td>
              <td><center><?php echo $f['nombre_cliente'] ?></center></td>
              <td><center><?php echo $f['calle_num'].' '.$f['barrio'].' '.$f['provincia'].', '.$f['departamento'] ?></center></td>
              <td><center><?php echo "$". number_format($f['precio'], 2,",",".") ?></center></td>
              <td><center><?php echo $f['forma_pago'] ?></center></td>
              <td><center><?php echo $f['asesor'] ?></center></td>
              <td><center><?php echo $f['tipo_inmueble'] ?></center></td>
              <td><center><?php echo $f['operacion'] ?></center></td>
              <td><center><a href="cancelar_propiedad.php?id=<?php echo $f['propiedad'] ?>&accion=ACTIVO" class="btn-floating blue" title="Activar inmueble"><i class="material-icons">loop</i></a></center></td>
              <td><center>
                <a href="#" class="btn-floating red" title="Eliminar inmueble" onclick="swal({ title: '¿Está seguro que desea eliminar el inmueble?', text: 'No será posible revertir esta acción', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminarlo', cancelButtonText: 'Cancelar' }).then(function () {
                        location.href='eliminar_propiedad.php?id=<?PHP echo $f['propiedad']?>&foto=<?php echo $f['foto_principal'] ?>'})"><i class="material-icons">delete_forever</i></a>
              </center></td>
            </tr>
          <?php }
          $sel->close();
          $con->close();
           ?>
        </table>
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

<?php include '../extend/scripts.php'; ?>

<!-- inicializar el modal -->
<script>
	$('.modal').modal();
	$('#mod').click(function(){
	$.get('modal.php',{
		id:$('#mod').val(),
		beforeSend: function(){
			$('#res_modal').html("Espere un momento por favor...");
		}
	}, function(respuesta){
		$('#res_modal').html(respuesta);
	});
});

</script>

</body>
</html>