<?php

include '../conexion/conexion.php';
include '../extend/permisos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = $con->real_escape_string(htmlentities($_POST['id']));
	$nivel = $con->real_escape_string(htmlentities($_POST['nivel']));

	$up = $con->query("UPDATE usuarios SET nivel='$nivel' WHERE id='$id'");
	if($up){
		header('location:../extend/alertas.php?msj=Nivel actualizado&c=us&p=in&t=success');
	} else {
		header('location:../extend/alertas.php?msj=No se pudo actualizar el nivel del usuario&c=us&p=in&t=error');
	}

} else {
	header('location:../extend/alertas.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}

$con->close();