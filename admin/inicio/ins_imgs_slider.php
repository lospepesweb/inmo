<?php include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$cont = 0;
foreach ($_FILES['ruta']['tmp_name'] as $key => $value) {
	$ruta = $_FILES['ruta']['tmp_name'][$key];
	$imagen = $_FILES['ruta']['name'][$key];
	
	$ancho = 1080;
	$alto = 250;
	$info = pathinfo($imagen);
	$tamano = getimagesize($ruta);
	$width = $tamano[0];
	$hight = $tamano[1];

	if ($info['extension'] == 'jpg' || $info['extension'] == 'JPG') {
		$imagenVieja = imagecreatefromjpeg($ruta);
		$imagenNueva = imagecreatetruecolor($ancho, $alto);
		imagecopyresampled($imagenNueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $hight);
		$cont++;
		$rand = rand(000,999);
		$renombrar = $rand.$cont;
		$copia="img/".$renombrar.'.jpg';
		imagejpeg($imagenNueva, $copia);
	} elseif ($info['extension'] == 'png' || $info['extension'] == 'PNG') {
		$imagenVieja = imagecreatefrompng($ruta);
		$imagenNueva = imagecreatetruecolor($ancho, $alto);
		imagecopyresampled($imagenNueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $hight);
		$cont++;
		$rand = rand(000,999);
		$renombrar = $rand.$cont;
		$copia="img/".$renombrar.'.png';
		imagepng($imagenNueva, $copia);
	} else {
		header('location:../extend/alertas.php?msj=El formato de la imagen debe ser jpg o png&c=home&p=sl&t=error&id=');
		exit;
	}

	$ins = $con->prepare("INSERT INTO slider VALUES (?,?) ");
	$ins->bind_param('is', $id_img, $copia);
	$id_img='';
	$ins->execute();
} //termina foreach

if ($ins) {
	header('location:../extend/alertas.php?msj=Las fotos de guardaron correctamente&c=home&p=sl&t=success&id=');
} else {
	header('location:../extend/alertas.php?msj=Las fotos no pudieron ser guardadas&c=home&p=sl&t=error&id=');
}

$ins->close();
$con->close();
} else {
	header('location:../extend/alertas.php?msj=Utiliza el formulario&c=home&p=sl&t=error');
}