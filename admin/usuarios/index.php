<?php 
	include '../extend/header.php';
	include '../extend/permisos.php';
?>

<!-- inicio del formulario-->

	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Alta de usuarios</span>
					<form class="form" action="ins_usuarios.php" method="post" enctype="multipart/form-data">
						<div class="input-field">
							<input type="text" name="nick" required autofocus title="Debe contener entre 8 y 15 caracteres. Solo letras." pattern="[A-Za-z]{8,15}" id="nick" onblur="may(this.value, this.id)">
							<label for="nick">Nombre de Usuario</label>
						</div>
						
						<div class="validacion"></div>
						
						<div class="input-field">
							<input type="password" name="pass1" title="Contraseña con números, mayúsculas y minúsculas. Entre 8 y 15 caracteres" pattern="[A-Za-z0-9]{8,15}" id="pass1">
							<label for="pass1">Contraseña</label>
						</div>

						<div class="input-field">
							<input type="password" title="Contraseña con números, mayúsculas y minúsculas. Entre 8 y 15 caracteres" pattern="[A-Za-z0-9]{8,15}" id="pass2">
							<label for="pass2">Repetir contraseña</label>
						</div>
						
						<select name="nivel" required>
							<option value="" disabled selected>Elige nivel de usuario</option>
							<option value="Admin">Admin</option>
							<option value="Asesor">Asesor</option>
						</select>

						<div class="input-field">
							<input type="text" name="nombre" title="Nombre completo del usuario" id="nombre" onblur="may(this.value, this.id)" required pattern="[A-Z/s ]+">
							<label for="nombre">Nombre y Apellido</label>
						</div>

						<div class="input-field">
							<input type="email" name="correo" title="Correo electrónico" id="correo">
							<label for="correo">Correo electrónico</label>
						</div>
						
						<div class="file-field input-field">
							<div class="btn">
								<span>Foto</span>
								<input type="file" name="foto">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path" type="text">
							</div>
						</div>
						
						<button class="btn black waves-effect waves-light" type="submit" name="button" id="btn_guardar">Guardar<i class="material-icons right">send</i></button>

					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- fin del formulario-->

	<!-- inicio del buscador-->

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

	<!-- fin del buscador-->

	<!-- inicio de la tabla-->

	<?php $sel = $con->query("SELECT * FROM usuarios"); 
	$row = mysqli_num_rows($sel);
	?>
	<div class="row">
		<div class="col s12">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Usuarios (<?php echo $row ?>)</span>
					<table>
						<thead>
						<tr class="cabecera">
							<th><center>Usuario</center></th>
							<th><center>Nombre</center></th>
							<th><center>Correo</center></th>
							<th><center>Nivel</center></th>
							<th><center></center></th>
							<th><center>Foto</center></th>
							<th><center>Bloqueo</center></th>
							<th><center>Eliminar</center></th>
						</tr>
						</thead>
						<?php while($f = $sel->fetch_assoc()){ ?>
						<tr>
							<td><center><?php echo $f['nick'] ?></center></td>
							<td><center><?php echo $f['nombre'] ?></center></td>
							<td><center><?php echo $f['correo'] ?></center></td>
							<td><center>
								<form action="up_nivel.php" method="post">
									<input type="hidden" name="id" value="<?PHP echo $f['id']?>">
									<select name="nivel" required>
										<option value="<?php echo $f['nivel'] ?>" ><?php echo $f['nivel'] ?></option>
										<option value="Admin">Admin</option>
										<option value="Asesor">Asesor</option>
									</select>
							</center></td>
							<td><center>
								<button type="submit" class="btn-floating"><i class="material-icons" title="Actualizar">repeat</i></button>
								</form>
							</center></td>
							<td><center><img src="<?php echo $f['foto'] ?>" width="50" class="circle"></td>
							<td><center>
							<?php if ($f['bloqueo'] == 1) : ?>
								<a href="bloqueo_manual.php?us=<?php echo $f['id'] ?>&bl=<?php echo $f['bloqueo'] ?>"><i class="material-icons green-text" title="Activo">lock_open</i></a>
							<?php else: ?>
								<a href="bloqueo_manual.php?us=<?php echo $f['id'] ?>&bl=<?php echo $f['bloqueo'] ?>"><i class="material-icons red-text" title="Bloqueado">lock_outline</i></a>
							<?php endif; ?>
							</center></td>
							<td><center>
								<a href="#" class="btn-floating red" onclick="swal({ title: '¿Está seguro que desea eliminar el usuario?', text: 'No será posible revertir esta acción', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminarlo', cancelButtonText: 'Cancelar' }).then(function () {
										location.href='eliminar_usuario.php?id=<?PHP echo $f['id']?>';})"><i class="material-icons">clear</i></a>
							</center></td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- fin de la tabla-->

<?php include '../extend/scripts.php' ?>

<script src="../js/validación_alta_usuario.js"></script>

</body>
</html>