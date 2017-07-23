<?php @session_start(); 
if(isset($_SESSION['nick'])){
	header('location: inicio');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<link rel="stylesheet" href="css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>Acceso de usuarios</title>
</head>
<body class="grey lighten-2">
	<main>
		<div class="row">
			<div class="input-field col s12 center">
				<img src="img/logo.jpg" width="200">
			</div>
		</div>
		<div class="container" id="loginContainer">
			<div class="row">
				<div class="col s12">
					<div class="card z-depth-5">
						<div class="card-content">
							<span class="card-title"><center>Inicio de sesión</center></span>
							<form action="login/index.php" method="post" autocomplete="off">
								<div class="input-field">
									<i class="material-icons prefix">perm_identity</i>
									<input type="text" name="usuario" title="Nombre del usuario" id="usuario" pattern="[A-Za-z]{8,15}" required autofocus>
									<label for="usuario">Usuario</label>
								</div>
								<div class="input-field">
									<i class="material-icons prefix">vpn_key</i>
									<input type="password" name="contra" title="contraseña" id="contra" pattern="[A-Za-z0-9]{8,15}" required>
									<label for="contra">Contraseña</label>
								</div>
								<div class="input-field center">
									<button type="submit" class="btn waves-effect waves-light">Entrar</button>
								</div>
							</form>


						</div>
					</div>
				</div>
			</div>
		</div>
	
	
	</main>
	
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/materialize.min.js"></script>
</body>
</html>