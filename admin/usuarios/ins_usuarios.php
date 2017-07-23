<?php

include '../conexion/conexion.php';
include '../extend/permisos.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$nick = $con->real_escape_string(htmlentities($_POST['nick']));
	$pass1 = $con->real_escape_string(htmlentities($_POST['pass1']));
	$nivel = $con->real_escape_string(htmlentities($_POST['nivel']));
	$nombre = $con->real_escape_string(htmlentities($_POST['nombre']));
	$correo = $con->real_escape_string(htmlentities($_POST['correo']));
	$nick = $con->real_escape_string(htmlentities($_POST['nick']));

	if(empty($nick) || empty($pass1) || empty($nivel) || empty($nombre)){
		header('location: ../extend/alertas.php?msj=Completa correctamente todos los campos&c=us&p=in&t=error');
		exit;
	}

	if(!ctype_alpha($nick)){
		header('location: ../extend/alertas.php?msj=El nombre de usuario solo debe contener letras&c=us&p=in&t=error');
		exit;
	}

	if(!ctype_alpha($nivel)){
		header('location: ../extend/alertas.php?msj=El nivel de usuario solo debe contener letras&c=us&p=in&t=error');
		exit;
	}

	$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXZ ";
	for ($i=0; $i < strlen($nombre); $i++) {
		$buscar = substr($nombre,$i,1);
		if(strpos($caracteres,$buscar) === false){
			header('location: ../extend/alertas.php?msj=El Apellido y Nombre de usuario solo debe contener letras&c=us&p=in&t=error');
		exit;
		}
	}

	$usuario = strlen($nick);
	$contraseña = strlen($pass1);
	if ($usuario < 8 || $usuario > 15) {
		header('location: ../extend/alertas.php?msj=El nombre de usuario debe contener entre 8 y 15 caracteres&c=us&p=in&t=error');
		exit;
	}

	if ($contraseña < 8 || $contraseña > 15) {
		header('location: ../extend/alertas.php?msj=La contraseña debe contener entre 8 y 15 caracteres&c=us&p=in&t=error');
		exit;
	}

	if (!empty($correo)) {
		if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
			header('location: ../extend/alertas.php?msj=El correo electrónico no es correcto&c=us&p=in&t=error');
			exit;
		}
	}


	$extension = "";//formato del archivo de imagen
	$ruta = 'fotos_perfil';//ruta donde se guarda la imagen del usuario
	$archivo = $_FILES['foto']['tmp_name'];
	$nombreArchivo = $_FILES['foto']['name'];
	$info = pathinfo($nombreArchivo);
	if($archivo != ''){
		$extension = $info['extension'];
		if($extension == "png" || $extension == "PNG" || $extension == "jpg" || $extension == "JPG"){
			move_uploaded_file($archivo, 'fotos_perfil/'.$nick.'.'.$extension);
			$ruta = $ruta."/".$nick.'.'.$extension;
		} else {
			header('location: ../extend/alertas.php?msj=El formato de la imagen debe ser png o jpg&c=us&p=in&t=error');
			exit;
		}
	} else {
		$ruta = "fotos_perfil/perfil.jpg";
	}

	$pass1 = sha1($pass1);
	$ins = $con->query("INSERT INTO usuarios VALUES ('','$nick','$pass1','$nombre','$correo','$nivel',1,'$ruta')");
	if($ins){
		header('location: ../extend/alertas.php?msj=El usuario fue registrado con éxito&c=us&p=in&t=success');
	} else {
		header('location: ../extend/alertas.php?msj=El usuario no pudo ser registrado&c=us&p=in&t=error');
	}

	$con->close();

} else {
	header('location: ../extend/alertas.php?msj=Utilza el formulario&c=us&p=in&t=error');
}

$con->close();