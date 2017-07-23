<?php include '../extend/header.php'; 
$id = htmlentities($_GET['id']);
$sel = $con->prepare("SELECT foto_principal FROM inventario WHERE propiedad = ? ");
$sel->bind_param('s', $id);
$sel->execute();
$res = $sel->get_result();
if ($f = $res->fetch_assoc()) {
  $foto = $f['foto_principal'];
}
$sel->close();
?>

<div class="row">
	<div class="col s6">
    <h2 class="header">Actualizar foto principal</h2>
		<div class="card horizontal">
 			<div class="card-image">
    		<img src="<?PHP echo $foto ?>" width="200" height="200">
  		</div>
  		<div class="card-stacked">
    		<div class="card-content">
      		<form action="up_foto_principal.php" class="form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?PHP echo $id ?>">
            <input type="hidden" name="anterior" value="<?PHP echo $foto ?>">
      			<div class="file-field input-field">
              <div class="btn">
						    <span>Foto</span>
						    <input type="file" name="foto">
		          </div>
				      <div class="file-path-wrapper">
						    <input class="file-path" type="text">
		          </div>
				    </div>
				    <button type="submit" class="btn">Actualizar</button>
      		</form>
    		</div>
  		</div>
		</div>
  </div>
  <div class="col s6">
    <h2 class="header">Cargar fotos</h2>
      <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
              <form action="ins_fotos_secundarias.php" class="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?PHP echo $id ?>">
                <div class="file-field input-field">
                  <div class="btn">
                    <span>Foto</span>
                    <input type="file" name="ruta[]" multiple title="Hasta 10 fotos">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path" type="text">
                  </div>
                </div>
                <button type="submit" class="btn">GUARDAR</button>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<div class="row cargador">
  <div class="col s12 center">
    <div class="preloader-wrapper big active">
      <div class="spinner-layer spinner-blue-only">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>  
  </div>
</div>

  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <?php  
            $sel_img = $con->prepare("SELECT * FROM fotos WHERE id_propiedad = ?");
            $sel_img->bind_param('s', $id);
            $sel_img->execute();
            $res_img = $sel_img->get_result();
            while ($f_img = $res_img->fetch_assoc()) { ?>
            
            <a href="#" onclick="swal({ title: '¿Está seguro que desea eliminar la foto?', text: 'No será posible revertir esta acción', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminarla', cancelButtonText: 'Cancelar' }).then(function () {
                        location.href='eliminar_foto.php?id=<?PHP echo $f_img['id'] ?>&ruta=<?PHP echo $f_img['ruta'] ?>&id_propiedad=<?PHP echo $id ?>'; })"><img title ="Click para eliminar" src="<?PHP echo $f_img['ruta']?>"></a>
            <?php 
            }
            $sel_img->close();
            $con->close();
             ?>
        </div>
      </div>
    </div>
  </div>

<?php include '../extend/scripts.php'; ?>
<script>
  $('.cargador').hide();
  $('.form').submit(function(event){
    $('.cargador').show();
  });
</script>
</body>
</html>