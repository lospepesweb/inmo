<?php include '../conexion/conexion.php';

$id = htmlentities($_GET['id']);
$foto = htmlentities($_GET['foto']);

$del = $con->prepare("DELETE FROM inventario WHERE propiedad = ?");
$del->bind_param('s', $id);
if($del->execute()){
	unlink($foto);
	$sel = $con->prepare("SELECT * FROM fotos WHERE id_propiedad = ?");
	$sel->bind_param('s', $id);
	$sel->execute();
	$res = $sel->get_result();
	while ($f = $res->fetch_assoc()) {
		unlink($f['ruta']);
	}
	$del_foto = $con->prepare("DELETE FROM fotos WHERE id_propiedad = ?");
	$del_foto->bind_param('s', $id);
	$del_foto->execute();
	$del_foto->close();
	header('location:../extend/alertas.php?msj=Inmueble eliminado&c=prop&p=can&t=success');
} else {
	header('location:../extend/alertas.php?msj=El inmueble no se pudo eliminar&c=prop&p=can&t=error');
}

$del->close();
$con->close();