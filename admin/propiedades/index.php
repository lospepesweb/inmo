<?php include '../extend/header.php'; 
if (isset($_GET['ope'])) {
  $operacion = $con->real_escape_string(htmlentities($_GET['ope']));
  $sel = $con->prepare("SELECT propiedad,consecutivo,nombre_cliente,calle_num,barrio,provincia,departamento,precio,forma_pago,asesor,tipo_inmueble,operacion,mapa,marcado FROM inventario WHERE estatus = 'ACTIVO' AND operacion = ?");
  $sel->bind_param('s', $operacion);
} else {
  $sel = $con->prepare("SELECT propiedad,consecutivo,nombre_cliente,calle_num,barrio,provincia,departamento,precio,forma_pago,asesor,tipo_inmueble,operacion,mapa,marcado FROM inventario WHERE estatus = 'ACTIVO' ");
}

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
        <form action="excel.php" method="post" target="_blank" id="exportar">
          <span class="card-title">Propiedades
          <button class="btn-floating green botonExcel" title="Exportar a excel"><i class="material-icons">grid_on</i></button>
            <input type="hidden" name="datos" id="datos">
          </span>
        </form>
        <table class="excel" border="1">
          <thead>
            <tr class="cabecera">
              <th class="borrar"><center>Vista</center></th>
              <th></th>
              <th><center>Num</center></th>
              <th><center>Cliente</center></th>
              <th><center>Propiedad</center></th>
              <th><center>Precio</center></th>
              <th><center>Credito</center></th>
              <th><center>Asesor</center></th>
              <th><center>Tipo</center></th>
              <th><center>Operacion</center></th>
              <th colspan="5" class="borrar"><center>Opciones</center></th>
            </tr>
          </thead>
          <?php          
          $sel->execute();
          $res = $sel->get_result();
          while ($f =$res->fetch_assoc()) {?>
            <tr>
              <td class="borrar"><center><button data-target="modal1" onclick="enviar(this.value)" value="<?PHP echo $f['propiedad']?>" class="btn-floating"><i class="material-icons" title="Ver información">visibility</i></button></center></td>
              <td>
                <?php if ($f['marcado'] == ''): ?>
                  <a href="marcado.php?id=<?PHP echo $f['propiedad']?>&marcado=SI" title="Marcar como destacado"><i class="small grey-text material-icons">grade</i></a>
                <?php else: ?>
                  <a href="marcado.php?id=<?PHP echo $f['propiedad']?>&marcado=" title="Desmarcar como destacado"><i class="small green-text material-icons">grade</i></a>
                <?php endif ?>
              </td>
              <td><center><?php echo $f['consecutivo'] ?></center></td>
              <td><center><?php echo $f['nombre_cliente'] ?></center></td>
              <td><center><?php echo $f['calle_num'].' '.$f['barrio'].' '.$f['provincia'].', '.$f['departamento'] ?></center></td>
              <td><center><?php echo "$". number_format($f['precio'], 2,",",".") ?></center></td>
              <td><center><?php echo $f['forma_pago'] ?></center></td>
              <td><center><?php echo $f['asesor'] ?></center></td>
              <td><center><?php echo $f['tipo_inmueble'] ?></center></td>
              <td><center><?php echo $f['operacion'] ?></center></td>
              <td class="borrar"><center><a href="imagenes.php?id=<?php echo $f['propiedad'] ?>" class="btn-floating pink" title="Agregar fotos"><i class="material-icons">image</i></a></center></td>
              <td class="borrar"><center><a href="mapa.php?mapa=<?php echo $f['mapa'] ?>" class="btn-floating orange" title="Ver ubicación" target="_blank"><i class="material-icons">room</i></a></center></td>
              <td class="borrar"><center><a href="pdf.php?id=<?php echo $f['propiedad'] ?>" class="btn-floating green" title="Generar PDF" target="_blank"><i class="material-icons">picture_as_pdf</i></a></center></td>
              <td class="borrar"><center><a href="editar_propiedad.php?id=<?php echo $f['propiedad'] ?>" class="btn-floating blue" title="Modificar datos"><i class="material-icons">loop</i></a></center></td>
              <td class="borrar"><center>
                <a href="#" class="btn-floating red" title="Cancelar propiedad" onclick="swal({ title: '¿Está seguro que desea cancelar el inmueble?', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, cancelarlo', cancelButtonText: 'Cancelar' }).then(function () {
                        location.href='cancelar_propiedad.php?id=<?PHP echo $f['propiedad']?>&accion=CANCELADO'})"><i class="material-icons">delete</i></a>
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
  function enviar(str){
    $.get('modal.php',{
		  id:str,
		  beforeSend: function(){
        $('#res_modal').html("Espere un momento por favor...");
		  }
    }, function(respuesta){
		  $('#res_modal').html(respuesta);
    });
  };

$('.botonExcel').click(function(){
  $('.borrar').remove();
  $('#datos').val( $("<div>").append($('.excel').eq(0).clone()).html());
  $('#exportar').submit();
  setInterval(function(){location.reload();}, 3000);
});

</script>

</body>
</html>