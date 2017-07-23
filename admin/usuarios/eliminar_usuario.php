<?php 

include '../conexion/conexion.php';
include '../extend/permisos.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));

$del = $con->query("DELETE FROM usuarios WHERE id='$id'");

if($del) {
	header('location:../extend/alertas.php?msj=Usuario eliminado&c=us&p=in&t=success');
} else {
	header('location:../extend/alertas.php?msj=El usuario no pudo ser eliminado&c=us&p=in&t=error');
}

$con->close();


