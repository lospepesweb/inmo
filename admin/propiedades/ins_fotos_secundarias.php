<?php include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id = htmlentities($_POST['id']);
	$cont = 0;
foreach ($_FILES['ruta']['tmp_name'] as $key => $value) {
	$ruta = $_FILES['ruta']['tmp_name'][$key];
	$imagen = $_FILES['ruta']['name'][$key];
	
	$ancho = 500;
	$alto = 400;
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
		$renombrar = $id.$rand.$cont;
		$copia="fotos/".$renombrar.'.jpg';
		imagejpeg($imagenNueva, $copia);
	} elseif ($info['extension'] == 'png' || $info['extension'] == 'PNG') {
		$imagenVieja = imagecreatefrompng($ruta);
		$imagenNueva = imagecreatetruecolor($ancho, $alto);
		imagecopyresampled($imagenNueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $hight);
		$cont++;
		$rand = rand(000,999);
		$renombrar = $id.$rand.$cont;
		$copia="fotos/".$renombrar.'.png';
		imagepng($imagenNueva, $copia);
	} else {
		header('location:../extend/alertas.php?msj=El formato de la imagen debe ser jpg o png&c=prop&p=img&t=error&id='.$id.'');
		exit;
	}

	$ins = $con->prepare("INSERT INTO fotos VALUES (?,?,?) ");
	$ins->bind_param('iss', $id_img, $id, $copia);
	$id_img='';
	$ins->execute();
} //termina foreach

if ($ins) {
	header('location:../extend/alertas.php?msj=Las fotos de guardaron correctamente&c=prop&p=img&t=success&id='.$id.'');
} else {
	header('location:../extend/alertas.php?msj=Las fotos no pudieron ser guardadas&c=prop&p=img&t=error&id='.$id.'');
}

$ins->close();
$con->close();
} else {
	header('location:../extend/alertas.php?msj=Utiliza el formulario&c=prop&p=img&t=error&id='.$id.'');
}