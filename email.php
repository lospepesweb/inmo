<?php include 'admin/conexion/conexion_web.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	foreach ($_POST as $campo => $valor) {
		$variable = "$" . $campo . "='" .htmlentities($valor) . "';";
		eval($variable);
	}

	$header = "MIME-VERSION 1.0\r\n";
	$header .= "Content-Type: text/html; chartset=iso-8859-1 \r\n";
	$header .= "From: {$nombre} < {$correo} > \r\n";

	$mail = mail("hola@lospepesweb.com", $asunto,$mensaje,$header);
	if($mail) {
	 	echo "<h4 style='color:green;''>Su mensaje ha sido enviado</h4>";
	} else {
  		echo "<h4 style='color:red;'>Su mensaje no ha sido enviado</h4>";
	}

	$con->close();
} else {
	echo "<h4 style='color:red;'>Utiliza el formulario</h4>";
}