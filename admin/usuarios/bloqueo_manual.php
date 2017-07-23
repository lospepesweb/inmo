<?php
include '../conexion/conexion.php';
include '../extend/permisos.php';

$id = $con->real_escape_string(htmlentities($_GET['us']));
$bloqueo = $con->real_escape_string(htmlentities($_GET['bl']));

if($bloqueo == 1) {
	$up = $con->query("UPDATE usuarios SET bloqueo=0 WHERE id='$id'");
	if ($up) {
		header('location:../extend/alertas.php?msj=Usuario bloqueado&c=us&p=in&t=success');
	} else {
		header('location:../extend/alertas.php?msj=El usuario no pudo ser bloqueado&c=us&p=in&t=error');
	}
} else {
	$up = $con->query("UPDATE usuarios SET bloqueo=1 WHERE id='$id'");
	if($up) {
		header('location:../extend/alertas.php?msj=Usuario desbloqueado&c=us&p=in&t=success');
	} else {
		header('location:../extend/alertas.php?msj=El usuario no pudo ser desbloqueado&c=us&p=in&t=error');
	}
}

$con->close();