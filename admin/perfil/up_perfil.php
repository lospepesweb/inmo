<?php 
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$nick = $_SESSION['nick'];
	$nombre = $con->real_escape_string(htmlentities($_POST['nombre']));
	$correo = $con->real_escape_string(htmlentities($_POST['correo']));

	$up = $con->query("UPDATE usuarios SET nombre = '$nombre', correo = '$correo' WHERE nick = '$nick' ");
	if($up){
		$_SESSION['nombre'] = $nombre;
		$_SESSION['correo'] = $correo;
		header('location:../extend/alertas.php?msj=Perfil actualizado&c=pe&p=perfil&t=success');
	} else {
		header('location:../extend/alertas.php?msj=No se pudo actualizar el perfil&c=pe&p=perfil&t=error');
	}

$con->close();
} else {
	header('location:../extend/alertas.php?msj=Utiliza ek formulario&c=pe&p=perfil&t=error');
}

