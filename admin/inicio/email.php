<?php include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	foreach ($_POST as $campo => $valor) {
		$variable = "$" . $campo . "='" .htmlentities($valor) . "';";
		eval($variable);
	}

	$header = "MIME-VERSION 1.0\r\n";
	$header .= "Content-Type: text/html; chartset=iso-8859-1 \r\n";
	$header .= "From: {$asesor} < {$correo_asesor} > \r\n";

	$mail = mail($correo, $asunto,$mensaje,$header);
	 if($mail) {
	 	$up = $con-prepare("UPDATE comentarios SET estatus = 'CONTESTADO' WHERE id = ?");
	 	$up->bind_param('i', $id_mensaje);
	 	$up->execute();
	 	$up->close();
	 	header('location:../extend/alertas.php?msj=E-Mail enviado&c=home;&p=home&t=success');
	 } else {
	 	header('location:../extend/alertas.php?msj=No se puso enviar el E-Mail&c=home&p=home&t=error');
	 }

	$con->close();
} else {
	header('location:../extend/alertas.php?msj=Utiliza el formulario&c=home&p=home&t=error');
}