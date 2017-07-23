<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	foreach ($_POST as $campo => $valor) {
  		$variable = "$" . $campo. "='" . htmlentities($valor). "';";
		eval($variable);
	}

	$sel = $con->prepare("SELECT provincia FROM provincias WHERE idprovincia = ? ");
	$sel->bind_param('i', $provincia);
	$sel->execute();
	$res = $sel->get_result();
		if ($f=$res->fetch_assoc()) {
			$nombre_provincia = $f['provincia'];
		}

		// $mapa = $calle_num ." ". $fraccionamiento. " ". $nombre_estado . ", ". $municipio;
	$up = $con->prepare("UPDATE inventario SET provincia=?, departamento=?, precio=?, barrio=?, calle_num=?, numero_int=?, m2t=?, banos=?, plantas=?, caracteristicas=?, m2c=?, dormitorios=?, cocheras=?, observaciones=?, forma_pago=?, asesor=?, tipo_inmueble=?, fecha_registro=?, comentario_web=?, operacion=?, mapa=? WHERE propiedad=? ");
	$up->bind_param("ssdssiiiisiiisssssssss", $nombre_provincia,$departamento,$precio,$barrio,$calle_num,$numero_int,$m2t,$banos,$plantas,$caracteristicas,$m2c,$dormitorios,$cocheras,$observaciones,$forma_pago,$asesor,$tipo_inmueble,$fecha_registro,$comentario_web,$operacion,$mapa,$id);
		if ($up->execute()) {
			header('location:../extend/alertas.php?msj=Datos guardados&c=prop&p=in&t=success');
		} else {
			header('location:../extend/alertas.php?msj=Los datos no se pudieron guardar&c=prop&p=in&t=error');
		}
	$up->close();
	$con->close();
  
} else {
   	header('location:../extend/alertas.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}

