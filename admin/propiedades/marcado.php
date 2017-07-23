<?php include '../conexion/conexion.php';

$id = htmlentities($_GET['id']);
$marcado = htmlentities($_GET['marcado']);

if ($marcado == '') {
	$marc = 'desmarcado';
} else {
	$marc = 'marcado';
}

$up = $con->prepare("UPDATE inventario SET marcado = ? WHERE propiedad = ?");
$up->bind_param('ss', $marcado, $id);
if ($up->execute()) {
	header('location:../extend/alertas.php?msj=Inmueble ' .$marc. ' como destacado&c=prop&p=in&t=success');
} else {
	header('location:../extend/alertas.php?msj=No se pudo marcar el inmueble&c=prop&p=in&t=error');
}

$up->close();
$con->close();

