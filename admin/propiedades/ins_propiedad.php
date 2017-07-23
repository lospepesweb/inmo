<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	foreach ($_POST as $campo => $valor) {
		$variable = "$" . $campo . "='" . htmlentities($valor). "';";
		eval($variable);
	}
	$sel = $con->prepare("SELECT provincia FROM provincias WHERE idprovincia = ?");
	$sel->bind_param('i', $provincia);
	$sel->execute();
	$res = $sel->get_result();
	if ($f=$res->fetch_assoc()) {
		$nombre_provincia = $f['provincia'];
	}
	$id = sha1(rand(00000, 99999));
	$consecutivo = '';
	$foto_principal = "fotos/foto_principal.png";
	$marcado = '';
	$estatus = 'ACTIVO';

	$ins = $con->prepare("INSERT INTO inventario VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
	$ins->bind_param("siisssdssiiiisiiisssssssssss", $id,$consecutivo,$id_cliente,$nombre_provincia,$departamento, $nombre_cliente, $precio, $barrio, $calle_num, $numero_int, $m2t, $banos, $plantas, $caracteristicas, $m2c, $dormitorios, $cocheras, $observaciones, $forma_pago, $asesor, $tipo_inmueble, $fecha_registro, $comentario_web, $operacion, $foto_principal, $mapa, $marcado, $estatus);
	if ($ins->execute()) {
		header('location:../extend/alertas.php?msj=Se guardó la propiedad&c=prop&p=in&t=success');
	} else {
		header('location:../extend/alertas.php?msj=No se pudo guardar la propiedad&c=cli&p=in&t=error');
	}

	$con->close();
} else {
	header('location:../extend/alertas.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}
