<?php include '../extend/header.php'; 

?>

<div class="col s6">
	<h2 class="header">Cargar imágenes para Slider</h2>
    	<div class="row">
        	<div class="col s12">
          		<div class="card">
            		<div class="card-content">
              			<form action="ins_imgs_slider.php" class="form" method="post" enctype="multipart/form-data">
                			<div class="file-field input-field">
                  				<div class="btn">
                    				<span>Imágenes:</span>
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


<div class="row cargador">
	<div class="col s12 center">
    	<div class="preloader-wrapper big active">
      		<div class="spinner-layer spinner-blue-only">
        		<div class="circle-clipper left">
          			<div class="circle"></div>
        		</div>
        		<div class="gap-patch">
          			<div class="circle"></div>
        		</div>
        		<div class="circle-clipper right">
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
            	$sel_img = $con->prepare("SELECT * FROM slider ");
	            $sel_img->execute();
	            $res_img = $sel_img->get_result();
	            while ($f_img = $res_img->fetch_assoc()) { ?>
            
            	<a href="#" onclick="swal({ title: '¿Está seguro que desea eliminar la imagen?', text: 'No será posible revertir esta acción', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminarla', cancelButtonText: 'Cancelar' }).then(function () {
                        location.href='eliminar_img_slider.php?id=<?PHP echo $f_img['id'] ?>&ruta=<?PHP echo $f_img['ruta'] ?>'; })"><img title ="Click para eliminar" src="<?PHP echo $f_img['ruta']?>"></a>
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