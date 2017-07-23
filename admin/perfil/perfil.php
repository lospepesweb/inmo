<?php include '../extend/header.php'; ?>

	<div class="row">
		<div class="col s12">
			<div class="card">
	    		<div class="card-content">
	      			<h1>Editar perfil</h1>
	    		</div>
	    		<div class="card-tabs">
	      			<ul class="tabs tabs-fixed-width">
	        			<li class="tab"><a href="#datos" class="active">Datos</a></li>
	        			<li class="tab"><a href="#pass">Contraseña</a></li>
	      			</ul>
	    		</div>
			    <div class="card-content grey lighten-4">
					    <div id="datos">
					    	<form class="form" action="up_perfil.php" method="post" enctype="multipart/form-data">
								<div class="input-field">
									<input type="text" name="nombre" title="Nombre completo del usuario" id="nombre" onblur="may(this.value, this.id)" required pattern="[A-Z/s ]+" value="<?php echo $_SESSION['nombre']?>">
									<label for="nombre">Nombre y Apellido</label>
								</div>
								<div class="input-field">
									<input type="email" name="correo" title="Correo electrónico" id="correo" value="<?php echo $_SESSION['correo']?>">
									<label for="correo">Correo electrónico</label>
								</div>
								<button class="btn black waves-effect waves-light" type="submit" name="button">Actualizar <i class="material-icons right">send</i></button>
							</form>
					    </div>
					    <div id="pass">
					    	<form class="form" action="up_pass.php" method="post" enctype="multipart/form-data">
								<div class="input-field">
									<input type="password" name="pass1" title="Contraseña con números, mayúsculas y minúsculas. Entre 8 y 15 caracteres" pattern="[A-Za-z0-9]{8,15}" id="pass1">
									<label for="pass1">Contraseña</label>
								</div>
								<div class="input-field">
									<input type="password" title="Contraseña con números, mayúsculas y minúsculas. Entre 8 y 15 caracteres" pattern="[A-Za-z0-9]{8,15}" id="pass2">
									<label for="pass2">Repetir contraseña</label>
								</div>
								<button class="btn black waves-effect waves-light" type="submit" name="button" id="btn_guardar">Actualizar <i class="material-icons right">send</i></button>
							</form>
					    </div>
			    </div>
	  		</div>	
		</div>
	</div>

<?php include '../extend/scripts.php'; ?>
<script src="../js/validación_alta_usuario.js"></script>

</body>
</html>