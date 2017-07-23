<?php 
include '../conexion/conexion.php';
inclede '../extend/permisos.php';
$user = $_SESSION['nick'];

$up = $con->query("UPDATE usuarios SET bloqueo = 0 WHERE nick='$user'");
if($up) {
	$_SESSION = array();
	session_destroy();
	header('location: ../extend/alertas.php?msj=Usuario bloqueado por uso indebido del sistema. Contacte al administrador&c=salir&p=salir&t=error');
}

$con->close();