<?php 
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$nick = $_SESSION['nick'];
	$pass = $con->real_escape_string(htmlentities($_POST['pass']));
	$pass = sha1($pass);

	$up = $con->query("UPDATE usuarios SET pass = '$pass' WHERE nick = '$nick' ");
	if($up){
		header('location:../extend/alertas.php?msj=Contraseña actualizada&c=pe&p=perfil&t=success');
	} else {
		header('location:../extend/alertas.php?msj=No se pudo actualizar la contraseña&c=pe&p=perfil&t=error');
	}

$con->close();
} else {
	header('location:../extend/alertas.php?msj=Utiliza ek formulario&c=pe&p=perfil&t=error');
}