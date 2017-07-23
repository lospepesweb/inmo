<?php include '../conexion/conexion.php';

$id = htmlentities($_GET['id']);
$ruta = htmlentities($_GET['ruta']);
$id_propiedad = htmlentities($_GET['id_propiedad']);

$del = $con->prepare("DELETE FROM fotos WHERE id = ?");
$del->bind_param('s', $id);

if ($del->execute()) {
	unlink($ruta);
	header('location:../extend/alertas.php?msj=La foto fue borrada correctamente&c=prop&p=img&t=success&id='.$id_propiedad.'');
} else {
	header('location:../extend/alertas.php?msj=La foto no pudo ser borrada&c=prop&p=img&t=error&id='.$id_propiedad.'');

}

$del->close();
$con->close();
